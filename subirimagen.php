<?php
require("includes/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['imagen']['tmp_name']) && is_uploaded_file($_FILES['imagen']['tmp_name'])) {
        $nombre = $_POST['nombre']; // Obtén el nombre de otro campo del formulario si lo tienes

        // Obtener información de la imagen
        $imagen_array = getimagesize($_FILES['imagen']['tmp_name']);
        $ancho = $imagen_array[0]; // Ancho de la imagen
        $altura = $imagen_array[1]; // Altura de la imagen
        $tipo = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION); // Tipo de archivo

        // Leer el contenido del archivo y convertirlo en un formato que se pueda almacenar en la base de datos
        $imagencargada = file_get_contents($_FILES['imagen']['tmp_name']);
        $imagencargada = addslashes($imagencargada);

        // Preparar la consulta SQL
        $stmt = $conn->prepare("INSERT INTO imagenes (ancho, altura, tipo, imagen, nombre) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        // Vincular los parámetros
        $nombre_archivo = $_FILES['imagen']['name']; // Nombre original del archivo
        $stmt->bind_param("iisss", $ancho, $altura, $tipo, $imagencargada, $nombre_archivo);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Imagen subida e información guardada correctamente.";
        } else {
            echo "Error al guardar la información: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la subida del archivo.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="imagen">Selecciona la imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>

        <input type="submit" value="Subir Imagen">
    </form>
</body>
</html>
