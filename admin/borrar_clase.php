<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $clase_id = $_GET['id'];

    // Eliminar clase de la base de datos
    $stmt = $pdo->prepare("DELETE FROM clases WHERE id = ?");
    $stmt->execute([$clase_id]);

    // Redirigir de vuelta a la página de listar_maestros.php
    header('Location: listar_clases.php');
    exit;
}
?>