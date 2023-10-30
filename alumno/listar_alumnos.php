<?php
session_start();

// Verificar si el usuario tiene el rol de administrador
if($_SESSION["user_data"]["role_id"] !== 3) {
    header('Location: acceso_denegado.php');
    exit;
}

require_once('../config/database.php'); // Configuración de la base de datos


// Obtener la lista de alumnos desde la base de datos
$stmt = $pdo->prepare("SELECT id, nombre, apellidos, clases_registradas FROM alumnos");
// $stmt = $pdo->prepare("SELECT id, nombre, email, telefono FROM alumnos");
$stmt->execute();
$alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Alumnos</title>
    <link href="/dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <h1>Listar Alumnos</h1>

    <!-- Mostrar la lista de alumnos -->
    <?php if ($alumnos) : ?>
        <table class="min-w-full bg-white border border-gray-200">
    <thead class="bg-gray-800 text-white">
        <tr>
            <th class="py-2 px-4">ID</th>
            <th class="py-2 px-4">Nombre</th>
            <th class="py-2 px-4">Apellidos</th>
            <th class="py-2 px-4">Clases Registradas</th>
            <th class="py-2 px-4">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alumnos as $alumno) : ?>
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4"><?php echo $alumno['id']; ?></td>
                <td class="py-2 px-4"><?php echo $alumno['nombre']; ?></td>
                <td class="py-2 px-4"><?php echo $alumno['apellidos']; ?></td>
                <td class="py-2 px-4"><?php echo $alumno['clases_registradas']; ?></td>
                <td class="py-2 px-4">
                    <a href="editar_alumno.php?id=<?php echo $alumno['id']; ?>" class="text-blue-500 hover:underline">
                        <i class="fas fa-pencil-alt"></i> <!-- Icono de lápiz -->
                    </a>
                    <a href="borrar_alumno.php?id=<?php echo $alumno['id']; ?>" class="text-red-500 hover:underline ml-2">
                        <i class="fas fa-trash-alt"></i> <!-- Icono de papelera de reciclaje -->
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <?php else : ?>
        <p>No hay alumnos registrados.</p>
    <?php endif; ?>

    <br>
    <a href="/admin/admin_panel.php">Volver al Panel de Administrador</a>
</body>
</html>
