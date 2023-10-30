<?php
require_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['materia_id'])) {
    $materia_id = $_GET['materia_id'];

    // Obtener datos de la materia desde la base de datos
    $stmt = $pdo->prepare("SELECT * FROM materias WHERE materia_id = ?");
    $stmt->execute([$materia_id]);
    $materia = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtener el nombre de la materia
    $materia_nombre = $materia['materia_nombre'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Materia</title>
</head>
<body>
    <h1>Editar Materia</h1>
    <form action="actualizar_materia.php" method="POST">
        <input type="hidden" name="materia_id" value="<?php echo $materia_id; ?>">
        <label for="materia_nombre">Nombre de materia:</label>
        <input type="text" name="materia_nombre" value="<?php echo $materia_nombre; ?>"><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>

