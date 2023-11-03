<?php

require_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $alumno_id = $_GET['id'];

    // Eliminar el alumno de la base de datos
    $stmt = $pdo->prepare("DELETE FROM alumnos WHERE id = ?");
    $stmt->execute([$alumno_id]);

    // Redirigir de vuelta a la página de listar_alumnos.php 
    header('Location: /alumno/listar_alumnos.php');
    exit;
}
?>
