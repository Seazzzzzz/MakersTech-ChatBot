<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/2af38560dd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login_register.css" />
    <title>Iniciar sesión / Registrarse </title>
</head>
<body>
    <div class="container">
        <div class="forms-container">
        <div class="signin-signup">
        <form action="procesar.php" method="POST" class="sign-in-form">
            <input type="hidden" name="accion" value="login">
            <h2 class="title">Iniciar Sesión</h2>
            <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="usuario" placeholder="Nombre de Usuario" required />
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Contraseña" required />
            </div>
            <input type="submit" value="Iniciar sesión" class="btn solid" />
            <p class="social-text">O inicia sesión con tus redes sociales.</p>
            <div class="social-media">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-x-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </form>
        <form action="procesar.php" method="POST" class="sign-up-form">
            <input type="hidden" name="accion" value="register">
            <h2 class="title">Registrate</h2>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="usuario" placeholder="Nombre de Usuario" required />
            </div>
            <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Correo" required />
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Contraseña" required />
            </div>
            <input type="submit" class="btn" value="Registrarse" />
            <p class="social-text">O registrate con tus redes sociales.</p>
            <div class="social-media">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </form>
    </div>
</div>

        <div class="panels-container">
            <div class="panel left-panel">
            <div class="content">
            <h3>Nuevo por aquí?</h3>
            <p>
                ¡Registrate dando un solo click y unete a la familia Makers Tech facil, adelante! 
            </p>
            <button class="btn transparent" id="sign-up-btn">
                Registrarse
            </button>
        </div>
            <img src="login.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
        <div class="content">
            <h3>Eres uno de nosotros?</h3>
            <p>
                Inicia sesión dando unicamente un par de clicks, coloca tu nombre de usuario y contraseña y accede a nuestros servicios.
            </p>
            <button class="btn transparent" id="sign-in-btn">
                Iniciar Sesión
            </button>
            </div>
            <img src="reg.svg" class="image" alt="" />
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>