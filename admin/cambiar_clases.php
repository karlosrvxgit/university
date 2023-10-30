<?php
session_start();
require_once('config.php'); // Configuración de la base de datos

// Verificar si el usuario tiene el rol de alumno
if ($_SESSION['user_rol'] !== 'alumno') {
    header('Location: acceso_denegado.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nuevas_clases'])) {
    // Obtener la ID del alumno desde la sesión
    $alumno_id = $_SESSION['user_id'];

    // Obtener las clases seleccionadas por el alumno
    $nuevas_clases = $_POST['nuevas_clases'];

    // Eliminar las relaciones anteriores del alumno con las clases
    $stmt = $pdo->prepare("DELETE FROM alumnos_clases WHERE id_alumno = ?");
    $stmt->execute([$alumno_id]);

    // Establecer nuevas relaciones entre el alumno y las clases seleccionadas
    foreach ($nuevas_clases as $clase_id) {
        $stmt = $pdo->prepare("INSERT INTO alumnos_clases (id_alumno, id_clase) VALUES (?, ?)");
        $stmt->execute([$alumno_id, $clase_id]);
    }

    echo "Tus clases han sido actualizadas correctamente.";
} else {
    echo "No se han seleccionado nuevas clases.";
}
?>

