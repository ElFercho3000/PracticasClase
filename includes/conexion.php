<?php
$conn = new mysqli("localhost", "root", "", "plataforma_simple");

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>

