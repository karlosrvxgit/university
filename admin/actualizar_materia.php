<?php
require_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['materia_id'])) {
    $materia_id = $_POST['materia_id'];
    $materia_nombre = $_POST['materia_nombre'];

    // Actualizar los datos de la materia en la base de datos
    $stmt = $pdo->prepare("UPDATE materias SET materia_nombre = ? WHERE materia_id = ?");
    $stmt->execute([$materia_nombre, $materia_id]);

    header('Location: listar_materias.php');
    exit;
}
?>

