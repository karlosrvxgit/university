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

    // Insertar la nueva clase en la base de datos
    $stmt = $pdo->prepare("INSERT INTO materias (materia_nombre) VALUES (?)");
    $stmt->execute([$nombre]);

    echo "Materia creada exitosamente.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Materia</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>
<body>
    <h1>Crear Materia</h1>
    <!-- Formulario para crear una nueva clase -->
    <form action="crear_materia.php" method="POST" class="max-w-xs mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
    <div class="mb-4">
        <label for="nombre" class="block text-sm font-medium text-gray-600">Nombre de la Materia:</label>
        <input type="text" name="nombre" required class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-indigo-300">
    </div>

    <div class="text-center">
        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Crear Materia
        </button>
    </div>
</form>


    <br>
    <a href="admin_panel.php">Volver al Panel de Administrador</a>
</body>
</html>
