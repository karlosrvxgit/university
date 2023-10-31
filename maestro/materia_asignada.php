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

// Consultar la materia y el nombre del maestro asignados
$stmt = $pdo->prepare("SELECT m.materia_nombre, ma.nombre AS nombre_maestro
                       FROM materias m 
                       JOIN maestros_materias mm ON m.materia_id = mm.materia_id
                       JOIN maestros ma ON mm.maestro_id = ma.id
                       WHERE mm.maestro_id = ?");
$stmt->execute([$maestro_id]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Materia y Maestro Asignados</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8 text-center ml-4">
    <h2 class="text-3xl font-semibold mb-4">Materia y Maestro Asignados</h2>
    <?php if ($resultado) : ?>
        <p class="text-green-600 mb-2">Tu materia asignada es: <span class="font-semibold"><?php echo $resultado['materia_nombre']; ?></span></p>
        <p class="text-green-600">El maestro asignado es: <span class="font-semibold"><?php echo $resultado['nombre_maestro']; ?></span></p>
    <?php else : ?>
        <p class="text-red-600 mt-4">No estás asignado a ninguna materia o no se encontró información del maestro.</p>
    <?php endif; ?>
</body>

</html>


