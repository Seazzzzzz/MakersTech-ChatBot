from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
import mysql.connector
from rapidfuzz import fuzz
import re

# ==== CONFIGURA TU CONEXIÓN A MYSQL (XAMPP) ====
DB_CFG = dict(
    host="localhost",
    user="root",
    password="",          # pon tu pass si tienes
    database="tienda"     # <-- cambia si tu BD tiene otro nombre
)

app = FastAPI()

# Permite llamadas desde tu sitio en XAMPP
app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://localhost", "http://127.0.0.1"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

class ChatIn(BaseModel):
    message: str

def get_conn():
    return mysql.connector.connect(**DB_CFG)

def limpiar(texto: str) -> str:
    return re.sub(r"\s+", " ", texto).strip().lower()

# ===== MAPA DE SINÓNIMOS =====
ALIASES = {
    "apple": ["macbook", "mac"],
    "hp": ["hp", "hewlett"],
    "samsung": ["samsung", "galaxy"]
}

def expandir_tokens(tokens):
    extra = []
    for t in tokens:
        if t in ALIASES:
            extra.extend(ALIASES[t])
    return tokens + extra

@app.post("/chat")
def chat(req: ChatIn):
    q = limpiar(req.message)
    if not q or len(q) < 2:
        return {"answer": "¿Qué producto buscas? Puedes decir 'HP', 'MacBook', 'Samsung', etc."}

    # Extrae tokens simples
    tokens = [t.lower() for t in re.findall(r"[a-zA-Z0-9]+", q) if len(t) > 1]
    tokens = expandir_tokens(tokens)

    if not tokens:
        return {"answer": "No entendí la consulta. Intenta con el nombre o la marca del producto."}

    # Construye WHERE con LIKE para varios tokens
    where = " OR ".join([f"LOWER(nombre) LIKE %s" for _ in tokens])
    params = [f"%{t.lower()}%" for t in tokens]

    conn = get_conn()
    cur = conn.cursor(dictionary=True)

    try:
        # Busca por coincidencias de nombre
        cur.execute(f"""
            SELECT id, nombre, precio, stock, especificaciones
            FROM productos
            WHERE {where}
            ORDER BY stock DESC, precio ASC
            LIMIT 10
        """, params)
        rows = cur.fetchall()

        if not rows:
            # Fuzzy matching por si LIKE no encontró nada
            cur.execute("SELECT id, nombre, precio, stock, especificaciones FROM productos")
            all_rows = cur.fetchall()
            scored = []
            for r in all_rows:
                score = max(
                    fuzz.partial_ratio(q, r["nombre"].lower()),
                    fuzz.token_set_ratio(q, r["nombre"].lower())
                )
                scored.append((score, r))
            scored.sort(key=lambda x: x[0], reverse=True)
            rows = [r for s, r in scored if s >= 60][:5]

        if not rows:
            return {"answer": "No encontré productos que coincidan. Prueba con otra marca o modelo."}

        # === Detectar si el usuario pide especificaciones ===
        pide_specs = any(palabra in q for palabra in [
            "especificaciones", "caracteristicas", "características", "detalles", "informacion", "información"
        ])

        # === Generar respuesta natural ===
        # Caso con un solo producto encontrado
        if len(rows) == 1:
            r = rows[0]
            if pide_specs:
                if r['especificaciones']:
                    texto = f"Estas son las especificaciones del {r['nombre']}:\n{r['especificaciones']}"
                else:
                    texto = f"El {r['nombre']} no tiene especificaciones registradas todavía."
            elif any(palabra in q for palabra in ["precio", "cuesta", "vale"]):
                if r['stock'] > 0:
                    texto = (
                        f"El {r['nombre']} cuesta ${int(r['precio']):,} "
                        f"y tenemos {r['stock']} unidades disponibles."
                    ).replace(",", ".")
                else:
                    texto = (
                        f"El {r['nombre']} cuesta ${int(r['precio']):,}, "
                        f"pero actualmente no está disponible 😔 (stock: 0)."
                    ).replace(",", ".")
            else:
                if r['stock'] > 0:
                    texto = (
                        f"Sí 👍, tenemos disponible el {r['nombre']} "
                        f"a un precio de ${int(r['precio']):,} "
                        f"y quedan {r['stock']} unidades en stock."
                    ).replace(",", ".")
                else:
                    texto = (
                        f"Sí, tenemos el {r['nombre']} en catálogo, "
                        f"pero ahora mismo no está disponible 😔 (stock: 0)."
                    )
        else:
            # Si hay varios productos y el usuario escribió un nombre exacto
            for r in rows:
                if r['nombre'].lower() in q:
                    if pide_specs:
                        if r['especificaciones']:
                            return {"answer": f"Estas son las especificaciones del {r['nombre']}:\n{r['especificaciones']}"}
                        else:
                            return {"answer": f"El {r['nombre']} no tiene especificaciones registradas todavía."}
                    elif any(palabra in q for palabra in ["precio", "cuesta", "vale"]):
                        if r['stock'] > 0:
                            return {"answer": (
                                f"El {r['nombre']} cuesta ${int(r['precio']):,} "
                                f"y tenemos {r['stock']} unidades disponibles."
                            ).replace(",", ".")}
                        else:
                            return {"answer": (
                                f"El {r['nombre']} cuesta ${int(r['precio']):,}, "
                                f"pero actualmente no está disponible 😔 (stock: 0)."
                            ).replace(",", ".")}
                    else:
                        if r['stock'] > 0:
                            return {"answer": (
                                f"Sí 👍, tenemos disponible el {r['nombre']} "
                                f"a un precio de ${int(r['precio']):,} "
                                f"y quedan {r['stock']} unidades en stock."
                            ).replace(",", ".")}
                        else:
                            return {"answer": (
                                f"Sí, tenemos el {r['nombre']} en catálogo, "
                                f"pero ahora mismo no está disponible 😔 (stock: 0)."
                            )}

            # Si no, mostrar lista de productos
            partes = []
            for r in rows:
                if r['stock'] > 0:
                    partes.append(
                        f"👉 {r['nombre']} por ${int(r['precio']):,}, quedan {r['stock']} unidades."
                    )
                else:
                    partes.append(
                        f"👉 {r['nombre']} está en catálogo pero no disponible ahora mismo (stock: 0)."
                    )
            texto = "Encontré varios productos que podrían interesarte:\n" + "\n".join(partes)

        return {"answer": texto}

    finally:
        cur.close()
        conn.close()
