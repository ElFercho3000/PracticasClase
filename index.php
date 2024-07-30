<?php
// Iniciar sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('includes/funciones.php');

// Obtener la lista de usuarios
$usuarios = listarUsuarios();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background: url('https://th.bing.com/th/id/R.57f497e786e7c3286be6d42e7ae564e6?rik=ZOaoWxxO3OEsEw&riu=http%3a%2f%2fwww.solofondos.com%2fwp-content%2fuploads%2f2015%2f04%2ffotos-de-paisajes-para-fondo-de-pantalla-gratis-en-hd.jpg&ehk=0bVTgA8BQ4QSl5n9evUKS2qOySmnACMo4lYrcL%2f0hsg%3d&risl=&pid=ImgRaw&r=0') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Estilos del encabezado */
        header {
            background-color: rgba(51, 51, 51, 0.8);
            color: #fff;
            padding: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        header .logo {
            margin-right: auto;
            margin-left: 20px;
        }

        header .logo img {
            height: 50px;
        }

        header nav {
            margin-right: auto;
        }

        header nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        header nav ul li {
            margin: 0 15px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        header nav ul li a:hover {
            text-decoration: underline;
        }
        
        /* Estilos del contenido principal */
        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            flex-grow: 1;
            background: rgba(255, 255, 255, 0.9); /* Fondo blanco semitransparente */
        }

        main h1 {
            text-align: center;
            color: black;
        }

        main p {
            text-align: center;
            color: black;
            line-height: 1.6;
        }

        /* Estilos para las tarjetas */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center; /* Centrar las tarjetas */
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: calc(33.333% - 20px); /* Tres tarjetas por fila */
            box-sizing: border-box;
            text-align: center;
        }

        .card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .card h3 {
            margin-top: 0;
            color: #007BFF;
        }

        .card p {
            margin: 5px 0;
        }

        /* Estilos del pie de página */
        footer {
            background-color: rgba(51, 51, 51, 0.8);
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        footer ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        footer ul li {
            margin: 0 15px;
        }

        footer ul li a {
            color: #fff;
            text-decoration: none;
        }

        footer ul li a:hover {
            text-decoration: underline;
        }

        footer p {
            margin: 10px 0 0;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <?php include 'encabezado.php'; ?>
    
    <!-- Contenido principal de la página -->
    <main>
        <h1>Lista de Usuarios</h1>
        <p>Aquí puedes ver la lista de todos los usuarios registrados.</p>

        <div class="card-container">
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <div class="card">
                        <?php if (!empty($usuario['imagen'])): ?>
                            <img src="<?php echo htmlspecialchars($usuario['imagen']); ?>" alt="<?php echo htmlspecialchars($usuario['nombre']) . ' ' . htmlspecialchars($usuario['apellido']); ?>">
                        <?php else: ?>
                            <img src="src/img/hombre.jpeg" alt="Avatar por defecto">
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($usuario['nombre']) . ' ' . htmlspecialchars($usuario['apellido']); ?></h3>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
                        <p><strong>Tipo de Usuario:</strong> <?php echo htmlspecialchars($usuario['tipo_usuario']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay usuarios registrados.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'pie.php'; ?>
</body>
</html>
