<?php
session_start();

session_destroy();

header("Location: ejercicio2.php");
exit;
?>