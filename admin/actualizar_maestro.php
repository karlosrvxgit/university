<?php

require_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $maestro_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $clasesAsignadas = $_POST['clases_asignadas'];

   
    $stmt = $pdo->prepare("UPDATE maestros SET nombre = ?, clases_asignadas = ? WHERE id = ?");
    $stmt->execute([$nombre, $clasesAsignadas, $maestro_id]);

    
    header('Location: listar_maestros.php');
    exit;
}
?>
