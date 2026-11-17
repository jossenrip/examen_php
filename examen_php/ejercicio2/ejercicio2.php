<?php
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = strtoupper(trim($_POST["usuario"]));
    $password = $_POST["password"];

    if (
        ($usuario == "DC" && $password == "1234") ||
        ($usuario == "MARVEL" && $password == "1234")
    ) {

        $_SESSION["usuario"] = $usuario;

        header("Location: heroes.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>Ejercicio 2</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <p>
            Usuario:
            <input type="text" name="usuario" required>
        </p>

        <p>
            Contraseña:
            <input type="password" name="password" required>
        </p>

        <button type="submit">Entrar</button>
    </form>
    <p style="color:red;">
        <?= $error ?>
    </p>
</body>
</html>