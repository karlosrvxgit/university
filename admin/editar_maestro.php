<?php

require_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $maestro_id = $_GET['id'];

    // Obtener datos del maestro desde la base de datos
    $stmt = $pdo->prepare("SELECT * FROM maestros WHERE id = ?");
    $stmt->execute([$maestro_id]);
    $maestro = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Maestro</title>
</head>
<body>
    <h1>Editar Maestro</h1>
    <form action="actualizar_maestro.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $maestro_id; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $maestro['nombre']; ?>"><br>
        <label for="clases_asignadas">Clases Asignadas:</label>
        <input type="text" name="clases_asignadas" value="<?php echo $maestro['clases_asignadas']; ?>"><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
