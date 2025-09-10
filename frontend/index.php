<!DOCTYPE html>
<html lang="es">
<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makers Tech</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="header">
        <div class="menu container">

            <a href="#" class="logo">Logo</a>
            <input type="checkbox" id="menu">
            <label for="menu">
                <img src="menu.png" class="menu-icono" alt="">
            </label>
            <nav class="navbar">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="#prod">Productos</a></li>
                    <li><a href="#recommended">Recomendados</a></li>
                    <li><a href="chatbot.php">ChatBot</a></li>
                </ul>
            </nav>
        </div>

        <div class="header-content container">
            <div class="header-txt">
                <h1>Makers Tech</h1>
                <span>Especialistas en Tecnología y E-Commerce</span>
                <p>
                    En Makers Tech te ofrecemos una experiencia de compra interactiva con productos de última generación. 
                    Nuestro objetivo es que encuentres rápido lo que buscas, con información clara sobre disponibilidad, 
                    precios y características en tiempo real.
                </p>
                <a href="#" class="btn-1">Conoce más</a>
            </div>
            <div class="header-dir">
                <div class="dir">
                <h3>Dirección</h3>
                <p>Cali, Colombia</p>
                </div>
                <div class="dir">
                    <h3>Teléfono</h3>
                    <p>+57 315 000 0000</p>
                </div>
                <div class="dir">
                    <h3>Atención</h3>
                    <p>Lunes a Viernes · 8am a 6pm</p>
                </div>
            </div>
        </div>
    </header>

    <section class="welcome">
        <div class="welcome-1"></div>
        <div class="welcome-2">
            <h2>Bienvenidos a Makers Tech</h2>
            <p class="b1">
                Tu tienda online de confianza en laptops y dispositivos tecnológicos.
            </p>
            <p>
                Con nuestro ChatBot podrás consultar en tiempo real precios, disponibilidad y características de cada producto. 
                Además, al iniciar sesión recibirás recomendaciones personalizadas de acuerdo a tus preferencias y lo más popular.
            </p>
            <a href="#" class="btn-1">Descubre más</a>
        </div>
    </section>

    <main id="prod" class="services container">
        <div class="services-txt">
            <h2>Productos</h2>
            <hr>
            <p>
                En Makers Tech nos especializamos en ofrecer laptops de las principales marcas como HP, Samsung y Apple. 
                Con nuestro sistema, podrás explorar el inventario actualizado, consultar precios y recibir recomendaciones personalizadas. 
            </p>
        </div>

        <div class="filter-buttons">
            <button class="btn-filter" data-brand="hp">HP</button>
            <button class="btn-filter" data-brand="samsung">Samsung</button>
            <button class="btn-filter" data-brand="apple">Apple</button>
        </div>

        <div class="services-group">
            <?php
            $db = new mysqli("localhost", "root", "", "tienda");
            if ($db->connect_error) {
                echo "<p>Error de conexión a la base de datos.</p>";
            } else {
                $sql = "SELECT id, nombre, precio, stock, imagen FROM productos ORDER BY id ASC";
                $res = $db->query($sql);

                if ($res && $res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $imgPath = !empty($row['imagen']) ? $row['imagen'] : "productos/default.jpg";
                        $nombre  = htmlspecialchars($row['nombre'], ENT_QUOTES);
                        $precio  = number_format($row['precio'], 0, ',', '.');
                        $stock   = intval($row['stock']);

                        $brand = "all";
                        if (stripos($nombre, "hp") !== false) $brand = "hp";
                        elseif (stripos($nombre, "samsung") !== false) $brand = "samsung";
                        elseif (stripos($nombre, "macbook") !== false || stripos($nombre, "apple") !== false) $brand = "apple";

                        echo "<div class='services-1' data-brand='{$brand}'>";
                        echo "  <img src='{$imgPath}' alt='{$nombre}'>";
                        echo "  <h3>{$nombre}</h3>";
                        echo "  <p>Precio: $ {$precio}</p>";
                        if ($stock > 0) {
                            echo "  <p>Disponible: {$stock} unidades</p>";
                        } else {
                            echo "  <p style='color:#888'>Agotado</p>";
                        }
                        echo "  <a href='producto.php?id={$row['id']}'>Saber más</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No hay productos cargados.</p>";
                }
                $res->free();
                $db->close();
            }
            ?>
        </div>

        <a href="#" class="btn-1">Información</a>
    </main>
        <section id="recommended" class="recommended">
        <div class="container">
            <div class="recommended-header">
                <div class="recommended-title">
                    <h2>Highly Recommended</h2>
                    <hr>
                    <p>Productos que te recomendamos especialmente.</p>
                </div>
            </div>
            <div class="recommended-grid">
                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo '<div class="recommended-msg">Inicia sesión para ver recomendaciones personalizadas. <a href="login_register.php">Iniciar sesión</a></div>';
                } else {
                    $db = new mysqli("localhost","root","","tienda");
                    if ($db->connect_error) {
                        echo '<div class="recommended-msg">Error de conexión a la base de datos.</div>';
                    } else {
                        $sql = "SELECT id, nombre, precio, stock, imagen FROM productos ORDER BY stock DESC, precio ASC LIMIT 4";
                        $res = $db->query($sql);

                        if ($res && $res->num_rows > 0) {
                            while ($row = $res->fetch_assoc()) {
                                
                                $imgPath = !empty($row['imagen']) ? $row['imagen'] : "productos/default.jpg";
                                
                                $nombre = htmlspecialchars($row['nombre'], ENT_QUOTES);
                                $precio = number_format($row['precio'], 0, ',', '.');
                                $stock  = intval($row['stock']);

                                echo '<article class="rec-card">';
                                echo "  <div class=\"rec-thumb\"><img src=\"{$imgPath}\" alt=\"{$nombre}\"></div>";
                                echo "  <div class=\"rec-body\">";
                                echo "    <h3>{$nombre}</h3>";
                                echo "    <p class=\"rec-desc\">Precio:  <span class=\"rec-price\"> $ {$precio}</span></p>";
                                if ($stock > 0) {
                                    echo "    <p class=\"rec-stock available\">Disponible: {$stock}</p>";
                                } else {
                                    echo "    <p class=\"rec-stock out\">Agotado</p>";
                                }
                                echo "    <div class=\"rec-actions\">";
                                echo "      <a class=\"btn-1\" href=\"producto.php?id={$row['id']}\">Saber más</a>";
                                if ($stock > 0) {
                                    echo "  <a class=\"btn-add\" href=\"cart_add.php?id={$row['id']}\">Agregar</a>";
                                }
                                echo "    </div>";
                                echo "  </div>";
                                echo "</article>";
                            }
                        } else {
                            echo '<div class="recommended-msg">No hay recomendaciones por ahora.</div>';
                        }
                        $res->free();
                        $db->close();
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <footer>
        <div class="footer-bg">
            <h2>Comentanos lo que piensas!</h2>
            <form action="">
                <div class="campo-1">
                    <input class="campo" type="text" placeholder="Nombre">
                    <input class="campo" type="number" placeholder="Telefono">
                </div>
                <div class="campo-1">
                    <input class="campo" type="text" placeholder="Dirección">
                    <input class="campo" type="email" placeholder="Correo">
                </div>
                <textarea class="campo" cols="30" rows="10" placeholder="Texto"></textarea>
                <input type="submit" value="Enviar" class="btn-1">
            </form>
        </div>
        <div class="footer-txt">
            <p>
                &copy; 2025 Makers Tech. Todos los derechos reservados. En Makers Tech valoramos tu opinión. Escríbenos para mejorar tu experiencia de compra o resolver cualquier inquietud. 
            </p>
        </div>
    </footer>
    <script src="script.js"></script>
    <script>
window.addEventListener("scroll", function() {
    const menu = document.querySelector(".menu");
    if (window.scrollY > 50) {
        menu.classList.add("scrolled");
    } else {
        menu.classList.remove("scrolled");
    }
});
</script>
</body>

</html>
