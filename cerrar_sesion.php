<?php
session_start();

// Destruye la sesión existente, eliminando todas las variables de sesión
session_destroy();

// Redirige al usuario a la página de inicio
header('Location: /index.php');
exit();
?>