<?php

require_once('../config/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $alumno_id = $_GET['id'];

    // Obtener datos del alumno desde la base de datos
    $stmt = $pdo->prepare("SELECT * FROM alumnos WHERE id = ?");
    $stmt->execute([$alumno_id]);
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Alumno</title>
</head>
<body>
    <h1>Editar Alumno</h1>
    <form action="actualizar_alumno.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $alumno_id; ?>">
        <label for="nombre">Nombre del alumno:</label>
        <input type="text" name="nombre" value="<?php echo $alumno['nombre']; ?>"><br>
        
        <label for="apellidos">Apellidos del alumno:</label>
        <input type="text" name="apellidos" value="<?php echo $alumno['apellidos']; ?>"><br>

        <label for="clases_registradas">Clases Registradas:</label>
        <input type="text" name="clases_registradas" value="<?php echo $alumno['clases_registradas']; ?>"><br>
        
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>
