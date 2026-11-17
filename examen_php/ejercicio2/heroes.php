<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ejercicio2.php");
    exit;
}
$usuario = $_SESSION["usuario"];
$editorial = "";

if ($usuario == "DC") {
    $editorial = "DC Comics";
} else {
    $editorial = "Marvel Comics";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos.css">
    <title>heroes</title>
</head>
<body>
<h1><?= $editorial ?></h1>
<p>
    Usuario conectado: <strong><?= $usuario ?></strong>
</p>
<p>
    <a href="cerrar.php">Cerrar sesión</a>
</p>
<hr>
<?php
$fichero = fopen("heroes.csv", "r");
if ($fichero) {
    fgetcsv($fichero, 0, ";");
    while (($datos = fgetcsv($fichero, 0, ";")) !== false) {
        if (count($datos) < 6) {
            continue;
        }
        if ($datos[1] == $editorial) {
            echo "<div style='margin-bottom:30px'>";
            echo "<h2>" . $datos[0] . "</h2>";
            echo "<p><strong>Alter Ego:</strong> " . $datos[2] . "</p>";
            echo "<p><strong>Aparición:</strong> " . $datos[3] . "</p>";
            echo "<p><strong>Personajes:</strong> " . $datos[4] . "</p>";
            echo "<img src='" . $datos[5] . "' width='200'>";
            echo "</div>";
        }
    }
    fclose($fichero);
}
?>
</body>
</html>