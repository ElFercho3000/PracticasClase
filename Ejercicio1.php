<?php 
if (isset($_POST['nombre']) && isset($_POST['password'])) {
    $nombre = "Galleta";
    $valor = $_POST['nombre'] . '|' . $_POST['password'];
    $fecha = time() + (60 * 60 * 24); // 24 horas

    if (isset($_POST['recordar'])) {
        setcookie($nombre, $valor, $fecha);
    } else {
        setcookie($nombre, "", time() - 3600); // Elimina la cookie
    }
} else {
    echo "Campos vacíos";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <form action="#" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo isset($_COOKIE['Galleta']) ? explode('|', $_COOKIE['Galleta'])[0] : ''; ?>">
        
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" value="<?php echo isset($_COOKIE['Galleta']) && isset($_POST['recordar']) ? explode('|', $_COOKIE['Galleta'])[1] : ''; ?>">
        
        <label for="recordar">Recordarme</label>
        <input type="checkbox" name="recordar" id="recordar" <?php echo isset($_COOKIE['Galleta']) ? 'checked' : ''; ?>>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
