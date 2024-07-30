<?php
// Iniciar sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('includes/funciones.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Usuario</title>
    <style>
        /* Estilos generales del cuerpo */
        body {
            font-family: Arial, sans-serif;
            background: url('https://th.bing.com/th/id/R.57f497e786e7c3286be6d42e7ae564e6?rik=ZOaoWxxO3OEsEw&riu=http%3a%2f%2fwww.solofondos.com%2fwp-content%2fuploads%2f2015%2f04%2ffotos-de-paisajes-para-fondo-de-pantalla-gratis-en-hd.jpg&ehk=0bVTgA8BQ4QSl5n9evUKS2qOySmnACMo4lYrcL%2f0hsg%3d&risl=&pid=ImgRaw&r=0') no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Contenedor principal */
        main {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semi-transparente */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }

        /* Encabezado */
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #007BFF; /* Color azul para el encabezado */
        }

        /* Estilos del formulario */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            position: relative; /* Para la colocación de errores */
        }

        /* Estilos de las etiquetas */
        label {
            font-weight: bold;
            color: #555;
            text-align: left; /* Alinea el texto de las etiquetas a la izquierda */
        }

        /* Estilos de los campos de entrada */
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%; /* Hace que los campos de entrada ocupen todo el ancho disponible */
            box-sizing: border-box; /* Asegura que el padding y el borde se incluyan en el ancho total */
        }

        /* Estilo para el botón de envío */
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF; /* Color de fondo del botón */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Color del botón al pasar el mouse */
        }

        /* Estilos para los mensajes de error */
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: left;
        }

        /* Estilos para los mensajes de éxito */
        .success-message {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <main>
        <h1>Crear Usuario</h1>
        <?php
        // Mostrar mensajes de error y éxito
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<div class='error-message'>$error</div>";
            }
            // Limpiar errores después de mostrarlos
            unset($_SESSION['errors']);
        }

        if (isset($_SESSION['success'])) {
            echo "<div class='success-message'>" . $_SESSION['success'] . "</div>";
            // Limpiar el mensaje de éxito después de mostrarlo
            unset($_SESSION['success']);
        }
        ?>
        <form action="includes/funciones.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" maxlength="20" value="<?php echo $_SESSION['datos']['nombre'] ?? ''; ?>" required>
            
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $_SESSION['datos']['apellido'] ?? ''; ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['datos']['email'] ?? ''; ?>" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" minlength="8" required>
            
            <label for="tipo_usuario">Tipo de Usuario:</label>
            <select id="tipo_usuario" name="tipo_usuario" required>
                <option value="freelancer" <?php echo (isset($_SESSION['datos']['tipo_usuario']) && $_SESSION['datos']['tipo_usuario'] == 'freelancer') ? 'selected' : ''; ?>>Cliente pasivo</option>
                <option value="cliente" <?php echo (isset($_SESSION['datos']['tipo_usuario']) && $_SESSION['datos']['tipo_usuario'] == 'cliente') ? 'selected' : ''; ?>>Cliente activo</option>
            </select>
            
            <input type="submit" value="Crear Usuario">
        </form>
    </main>
</body>
</html>
