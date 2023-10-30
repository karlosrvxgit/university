<?php
require_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Obtener el ID de la materia a eliminar desde la URL y sanitizarlo
    $materia_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Verificar si el ID es un número entero válido
    if (!filter_var($materia_id, FILTER_VALIDATE_INT)) {
        // Redirigir a una página de error o mostrar un mensaje de error
        echo "ID de materia no válido";
        exit;
    }

    // Eliminar la materia de la base de datos
    $stmt = $pdo->prepare("DELETE FROM materias WHERE materia_id = ?");
    $stmt->execute([$materia_id]);

    // Redirigir de vuelta a la página de listar_materias.php 
    header('Location: listar_materias.php');
    exit;
}
?>
