<?php
session_start();

// Verificar si el usuario tiene el rol de administrador
if($_SESSION["user_data"]["role_id"] !== 3) {
    header('Location: acceso_denegado.php');
    exit;
}

require_once('../config/database.php'); // Configuración de la base de datos

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_POST['usuario_id'];
    $nuevo_rol = $_POST['nuevo_rol'];

    // Actualizar el rol del usuario en la base de datos
    $stmt = $pdo->prepare("UPDATE usuario SET rol = ? WHERE id = ?");
    $stmt->execute([$nuevo_rol, $usuario_id]);

    echo "Rol del usuario actualizado correctamente.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cambiar Rol de Usuario</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>
<body>
<div class="max-w-md mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold mb-4">Cambiar Rol de Usuario</h1>
    
    <form action="cambio_rol_usuario.php" method="POST">
        <div class="mb-4">
            <label for="usuario_id" class="block text-sm font-medium text-gray-600">ID del Usuario:</label>
            <input type="text" name="usuario_id" required class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-indigo-300">
        </div>

        <div class="mb-4">
            <label for="nuevo_rol" class="block text-sm font-medium text-gray-600">Nuevo Rol:</label>
            <select name="nuevo_rol" class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-indigo-300">
                <option value="admin">Admin</option>
                <option value="maestro">Maestro</option>
                <option value="alumno">Alumno</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Cambiar Rol
            </button>
        </div>
    </form>
</div>


    <br>
    <a href="admin_panel.php">Volver al Panel de Administrador</a>
</body>
</html>
