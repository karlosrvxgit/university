<?php
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['user_id'])) {
    // Recupera los datos de la sesión
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $user_username = $_SESSION['user_username'];

    // Placeholder for role check, modify this based on your database structure
    $user_role = 'admin'; // Fetch the user role from the database

    if ($user_role === 'admin') {
        header('Location: admin_panel.php');
    } elseif ($user_role === 'maestro') {
        header('Location: maestro_panel.php');
    } elseif ($user_role === 'alumno') {
        header('Location: alumno_panel.php');
    } else {
        echo 'Rol de usuario no reconocido.';
    }
    exit;
} else {
    // Si el usuario no está autenticado, redirige a la página de inicio de sesión
    header('Location: /login/login.php');
    exit();
}
?>
