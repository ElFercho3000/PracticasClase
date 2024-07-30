<?php
require("includes/conexion.php");

$archivo = fopen("datos.csv", "r");
if (!$archivo) {
    die("Error al abrir el archivo CSV.");
}

$i = 0;
$bandera = true;

// Preparar la consulta SQL usando una declaración preparada
$stmt = $conn->prepare("INSERT INTO preguntas (descripcion, nombre, pais, acierto, estado) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

while (($data = fgetcsv($archivo)) !== false) {
    if ($bandera) {
        $bandera = false;
        continue;
    }

    // Asumir que los datos están en el orden correcto en el CSV
    $descripcion = $data[1];
    $nombre = $data[2];
    $pais = $data[3];
    $acierto = $data[4] === '1' ? true : false; // Convertir a booleano
    $estado = $data[5];

    // Vincular los parámetros y ejecutar la consulta
    $stmt->bind_param("sssss", $descripcion, $nombre, $pais, $acierto, $estado);

    if ($stmt->execute()) {
        echo "Registro $i insertado correctamente.<br>";
    } else {
        echo "Error al insertar el registro $i: " . $stmt->error . "<br>";
    }
    $i++;
}

fclose($archivo);
$stmt->close();
$conn->close();
?>
