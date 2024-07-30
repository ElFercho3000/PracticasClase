<?php
require("conexion.php");

// Obtener los datos de los usuarios de la base de datos
$query = "SELECT nombre, apellido, email, tipo_usuario FROM usuarios";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Crear un array para almacenar los usuarios
    $usuarios = array();

    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
} else {
    $usuarios = [];
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(33.333% - 20px); /* Tres tarjetas por fila */
            box-sizing: border-box;
        }
        .card h3 {
            margin-top: 0;
            color: #007BFF;
        }
        .card p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <div class="card-container">
        <?php if (!empty($usuarios)): ?>
            <?php foreach ($usuarios as $usuario): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($usuario['nombre']) . ' ' . htmlspecialchars($usuario['apellido']); ?></h3>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
                    <p><strong>Tipo de Usuario:</strong> <?php echo htmlspecialchars($usuario['tipo_usuario']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay usuarios registrados.</p>
        <?php endif; ?>
    </div>
</body>
</html>
