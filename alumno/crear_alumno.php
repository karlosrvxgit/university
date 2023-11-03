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
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $clasesRegistradas = $_POST['clases_registradas'];

    // Insertar el nuevo alumno en la base de datos
    $stmt = $pdo->prepare("INSERT INTO alumnos (nombre, apellidos, clases_registradas) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $apellidos, $clasesRegistradas]);

    echo "Alumno creado exitosamente.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Alumno</title>
    <link href="../dist/output.css" rel="stylesheet">
</head>
<body>
    <h1>Crear Alumno</h1>
    <!-- Formulario para crear un nuevo alumno -->
    <form action="/alumno/crear_alumno.php" method="POST" class="max-w-xs mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
    <div class="mb-4">
        <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre:</label>
        <input type="text" name="nombre" required class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-indigo-300">
    </div>

    <div class="mb-4">
        <label for="apellidos" class="block text-sm font-medium text-gray-600">Apellidos:</label>
        <input type="text" name="apellidos" required class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-indigo-300">
    </div>

    <div class="mb-4">
        <label for="clases_registradas" class="block text-sm font-medium text-gray-600">Clases Registradas:</label>
        <input type="text" name="clases_registradas" required class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-indigo-300">
    </div>

    <div class="text-center">
        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Crear Alumno
        </button>
    </div>
</form>


    <br>
    <a href="/admin/admin_panel.php">Volver al Panel de Administrador</a>
</body>
</html>
