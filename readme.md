# MakersTech-ChatBot

Proyecto que integra una **tienda online de laptops y dispositivos tecnológicos** con un **ChatBot** hecho en **FastAPI** para consultar productos en tiempo real.

---

##  Estructura del proyecto

MakersTech-ChatBot/
│── frontend/ -> Archivos PHP, CSS, JS e imágenes de la página web
│── ai_service/ -> Backend con FastAPI (inteligencia del ChatBot)
│── productos/ -> Imágenes de los productos
│── data/ -> Exportación de la base de datos MySQL (tienda.sql)
│── requirements.txt -> Dependencias de Python para FastAPI
│── README.md -> Este archivo de documentación

yaml
Copiar código

---

## Requisitos

- [XAMPP](https://www.apachefriends.org/es/index.html) (para MySQL y Apache)
- [Python 3.10+](https://www.python.org/downloads/)
- [FastAPI] + dependencias (se instalan desde `requirements.txt`)
- Navegador web (Chrome, Edge, etc.)

---

## Base de datos

El archivo `tienda.sql` contiene la estructura y datos iniciales de la base de datos.  
Para importarla:

1. Abre **phpMyAdmin** desde XAMPP.
2. Crea una base de datos llamada **`tienda`**.
3. Importa el archivo `data/tienda.sql`.

Esto creará la tabla `productos` con laptops y dispositivos de prueba.

---

## Backend (FastAPI)

1. Abre la terminal y muévete al backend:

   ```bash
   cd C:\xampp\htdocs\MakersTech-ChatBot\ai_service
Activa el entorno virtual:

bash
Copiar código
.venv\Scripts\activate
Instala dependencias (solo la primera vez):

bash
Copiar código
pip install -r requirements.txt
Inicia el servidor FastAPI:

bash
Copiar código
uvicorn main:app --reload --host 127.0.0.1 --port 8000
El backend quedará corriendo en:
http://127.0.0.1:8000

La documentación interactiva de la API estará en:
http://127.0.0.1:8000/docs

Frontend (PHP + JS)
Copia la carpeta frontend/ y productos/ dentro de:

makefile
Copiar código
C:\xampp\htdocs\MakersTech-ChatBot\
Inicia Apache desde XAMPP.

Abre en tu navegador:

http://localhost/MakersTech-ChatBot/frontend/

Desde aquí puedes usar la página y hablar con el ChatBot.

Funcionalidades
Consultar laptops por marca o modelo.

Verificar precio y stock disponible.

Pedir especificaciones técnicas de cada producto.

Respuestas con búsqueda exacta, parcial y fuzzy matching.

Imágenes de los productos integradas en la tienda.

Notas
El entorno virtual (.venv/) no se incluye en el repositorio.
Cada usuario debe crear el suyo y usar requirements.txt.

La base de datos se puede volver a importar en cualquier momento desde tienda.sql.

Desarrollado para MakersTech 
