<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>ChatBot de Productos</title>
<link rel="stylesheet" href="chatbot.css">
</head>
<body>
<div class="container">
    
    <div class="left">
        <img src="/MakersTech-ChatBot/chatbot.png" alt="Chatbot">
    </div>
    <div class="right">
        <h1>ChatBot de Productos</h1>
        <div id="chat"></div>

        <div id="row">
            <input id="q" type="text" placeholder="Escribe: HP, MacBook, Samsung..." />
            <button id="send">Enviar</button>
        </div>

        <p><a href="/MakersTech-ChatBot/index.php">Volver</a></p>
    </div>
</div>

<script>
    const chat = document.getElementById('chat');
    const q = document.getElementById('q');
    const send = document.getElementById('send');

    function addMsg(text, cls){
        const div = document.createElement('div');
        div.className = 'msg ' + cls;
        const pre = document.createElement('pre');
        pre.textContent = text;
        div.appendChild(pre);
        chat.appendChild(div);
        chat.scrollTop = chat.scrollHeight;
    }

    async function ask(){
        const text = q.value.trim();
        if(!text) return;
        addMsg(text, 'user');
        q.value = '';
        try{
            const res = await fetch('http://127.0.0.1:8000/chat', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({message: text})
            });
            const data = await res.json();
            addMsg(data.answer || 'Sin respuesta', 'bot');
        }catch(e){
            addMsg('Error conectando con el servicio de IA. ¿Está corriendo en el puerto 8000?', 'bot');
        }
    }

    send.onclick = ask;
    q.addEventListener('keydown', (e)=>{ if(e.key==='Enter') ask(); });

    // === Mensaje inicial del bot ===
    document.addEventListener("DOMContentLoaded", () => {
        addMsg("👋 Hola, soy tu asistente de Makers Tech.\nPuedes preguntarme por precios o disponibilidad de productos.\nEjemplo: '¿Cuánto cuesta el HP Pavilion?'", "bot");
    });
</script>
</body>
</html>
