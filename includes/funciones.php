<?php
require("conexion.php");

// Iniciar sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inicializar variable de errores
$_SESSION['errors'] = array();

function validarDatos($nombre, $apellido, $email, $password, $tipo_usuario) {
    $errores = [];

    // Validar el nombre
    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    } elseif (strlen($nombre) > 20) {
        $errores[] = "El nombre no puede tener más de 20 caracteres.";
    }

    // Validar el apellido
    if (empty($apellido)) {
        $errores[] = "El apellido es obligatorio.";
    }

    // Validar el email
    if (empty($email)) {
        $errores[] = "El email es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no es válido.";
    }

    // Validar la contraseña
    if (empty($password)) {
        $errores[] = "La contraseña es obligatoria.";
    } elseif (strlen($password) < 8) {
        $errores[] = "La contraseña debe tener al menos 8 caracteres.";
    }

    // Validar el tipo de usuario
    $tiposValidos = ["freelancer", "cliente"];
    if (empty($tipo_usuario)) {
        $errores[] = "El tipo de usuario es obligatorio.";
    } elseif (!in_array($tipo_usuario, $tiposValidos)) {
        $errores[] = "El tipo de usuario no es válido.";
    }

    return $errores;
}

function insertar($nombre, $apellido, $email, $password, $tipo_usuario) {
    global $conn;

    // Validar datos
    $errores = validarDatos($nombre, $apellido, $email, $password, $tipo_usuario);

    if (!empty($errores)) {
        $_SESSION['errors'] = $errores;
        $_SESSION['datos'] = $_POST; // Guarda los datos del formulario para mantenerlos en caso de errores
        header('Location: ../usuarios.php');
        exit;
    }

    // Preparar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, email, password, tipo_usuario) VALUES (?, ?, ?, ?, ?)");

    if ($stmt === false) {
        $_SESSION['errors'][] = "Error al preparar la consulta: " . $conn->error;
        header('Location: ../usuarios.php');
        exit;
    }

    // Hash de la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Vincular los parámetros
    $stmt->bind_param("sssss", $nombre, $apellido, $email, $passwordHash, $tipo_usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['success'] = "Datos insertados exitosamente";
    } else {
        $_SESSION['errors'][] = "Error al ejecutar la consulta: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();

    // Redirigir a la página del formulario
    header('Location: ../usuarios.php');
    exit;
}

function listarUsuarios() {
    global $conn;

    $sql = "SELECT * FROM usuarios"; // Consulta SQL

    $resultado = $conn->query($sql);

    if (!$resultado) {
        die("Error en la consulta: " . $conn->error);
    }

    // Obtener los datos en un array asociativo
    $usuarios = [];
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }

    return $usuarios;
}


// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario'];

    insertar($nombre, $apellido, $email, $password, $tipo_usuario);
}
?>
