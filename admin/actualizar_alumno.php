<?php

require_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $alumno_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $clasesRegistradas = $_POST['clases_registradas'];


    $stmt = $pdo->prepare("UPDATE alumnos SET nombre = ?, apellidos = ?, clases_registradas = ? WHERE id = ?");
    $stmt->execute([$nombre, $apellidos, $clasesRegistradas, $alumno_id]);

    header('Location: /alumno/listar_alumnos.php');
    exit;
}
?>
