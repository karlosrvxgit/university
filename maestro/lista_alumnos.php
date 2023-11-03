<?php
session_start();

// Verificar si el usuario tiene el rol de maestro
if (!isset($_SESSION["user_data"]) || $_SESSION["user_data"]["role_id"] !== 4) {
    header('Location: acceso_denegado.php');
    exit;
}

require_once('../config/database.php'); // Configuración de la base de datos

// Obtener la ID del maestro desde la sesión
$maestro_id = $_SESSION['user_data']['id'];

// Consultar la materia asignada al maestro
$stmt = $pdo->prepare("SELECT m.materia_id, m.materia_nombre FROM materias m 
                       JOIN maestros_materias mm ON m.materia_id = mm.materia_id
                       WHERE mm.maestro_id = ?");
$stmt->execute([$maestro_id]);
$materia = $stmt->fetch(PDO::FETCH_ASSOC);

// Consultar la lista de alumnos en la materia asignada al maestro
$alumnos = [];
if ($materia) {
    $materia_id = $materia['materia_id'];
    $stmt = $pdo->prepare("SELECT a.nombre AS alumno_nombre FROM alumnos a
                           JOIN alumnos_materias am ON am.alumno_id = am.alumno_id
                           WHERE am.materia_id = ?");
    $stmt->execute([$materia_id]);
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Alumnos</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8 text-center">
    <h2 class="text-3xl font-semibold mb-4">Lista de Alumnos</h2>
    <?php if ($alumnos) : ?>
        <ul class="list-disc list-inside mb-4">
            <?php foreach ($alumnos as $alumno) : ?>
                <li class="text-green-600"><?php echo $alumno['alumno_nombre']; ?></li>
                
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p class="text-red-600">No hay alumnos en esta materia o no estás asignado a ninguna materia.</p>
    <?php endif; ?>
</body>

</html>

        

