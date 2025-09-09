<?php
if (session_status() == PHP_SESSION_NONE) session_start();

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];

    if ($accion == "register") {
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Verificar si el correo ya existe
        $check = $conn->prepare("SELECT id FROM usuarios WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "El correo ya está registrado. <a href='login_register.php'>Volver</a>";
        } else {
            $stmt = $conn->prepare("INSERT INTO usuarios (usuario, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $usuario, $email, $password);

            if ($stmt->execute()) {
                // Redirigir al index.html
                header("Location: login_register.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $check->close();

    } elseif ($accion == "login") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario=?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Guardar sesión
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['email']   = $row['email'];

            header("Location: index.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
    $stmt->close();
}
}
$conn->close();
?>
