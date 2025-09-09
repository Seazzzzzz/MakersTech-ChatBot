# MakersTech-ChatBot

Proyecto que integra una **tienda online de laptops y dispositivos tecnológicos** con un **ChatBot** hecho en **FastAPI** para consultar productos en tiempo real.

---

## Estructura del proyecto

MakersTech-ChatBot/
│── frontend/ -> Archivos PHP, CSS, JS e imágenes de la página web
│── ai_service/ -> Backend con FastAPI (inteligencia del ChatBot)
│── productos/ -> Imágenes de los productos
│── README.md -> Este archivo de documentación

---

##  Requisitos

- Tener **Python 3.10+** instalado
- Tener instalado **XAMPP** (para ejecutar PHP y MySQL si se usa)
- Tener **pip** disponible en la terminal

---

##  Instalación y ejecución

### 1. Clonar el repositorio
```bash
git clone https://github.com/TU_USUARIO/MakersTech-ChatBot.git
cd MakersTech-ChatBot

#Configurar el backend (FastAPI)

cd ai_service
python -m venv .venv
.venv\Scripts\activate   # En Windows
# source .venv/bin/activate   # En Linux/Mac

pip install -r requirements.txt

uvicorn main:app --reload --host 127.0.0.1 --port 8000

Esto levanta el servidor de IA en FastAPI en:
- http://127.0.0.1:8000/chat

3. Configurar el frontend (PHP)

Copiar la carpeta frontend/ dentro de la carpeta htdocs de XAMPP.

Arrancar Apache desde el panel de XAMPP.

Abrir en el navegador:
- http://localhost/frontend/index.php
 

USO

Escribe en el ChatBot el nombre de un producto (ej: HP, MacBook, Samsung)

El backend responderá con información del producto disponible.

