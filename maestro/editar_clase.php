<?php
// En editar_clase.php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $clase_id = $_GET['id'];

    // Obtener datos de la clase desde la base de datos
    $stmt = $pdo->prepare("SELECT * FROM clases WHERE id = ?");
    $stmt->execute([$clase_id]);
    $clase = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Clase</title>
</head>
<body>
    <h1>Editar Clase</h1>
    <form action="actualizar_clase.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $clase_id; ?>">
        <label for="nombre">Nombre de la Clase:</label>
        <input type="text" name="nombre" value="<?php echo $clase['nombre']; ?>"><br>
        <!-- Agrega más campos del formulario según tus necesidades -->
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
