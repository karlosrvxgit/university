<?php
session_start();

// Verificar si el usuario tiene el rol de administrador
if ($_SESSION["user_data"]["role_id"] !== 3) {
    header('Location: acceso_denegado.php');
    exit;
}

require_once('../config/database.php'); // Configuración de la base de datos

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $clasesAsignadas = $_POST['clases_asignadas'];


    // Insertar el nuevo maestro en la base de datos
    $stmt = $pdo->prepare("INSERT INTO maestros (nombre, clases_asignadas) VALUES (?, ?)");
    $stmt->execute([$nombre, $clasesAsignadas]);



    echo "Maestro creado exitosamente.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crear Maestro</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body class="max-w-xl">
    <h1 class="text-blue-500">Crear Maestro</h1>
    <!-- Formulario para crear un nuevo maestro -->
    <form action="../admin/crear_maestro.php" method="POST" class="bg-gradient-to-r from-purple-400 via-yellow-500 to-orange-500 max-w-xl">
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-white">Nombre:</label>
            <input type="text" name="nombre" required class="mt-1 p-2 w-full bg-white bg-opacity-25 border rounded-md text-white placeholder-white::placeholder focus:outline-none focus:ring focus:border-indigo-300">
        </div>

        <div class="mb-4">
            <label for="clases_asignadas" class="block text-sm font-medium text-white">Clases asignadas:</label>
            <input type="text" name="clases_asignadas" required class="mt-1 p-2 w-full bg-white bg-opacity-25 border rounded-md text-white placeholder-white::placeholder focus:outline-none focus:ring focus:border-indigo-300">
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-white hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Crear Maestro</button>
        </div>
    </form>



    <br>
    <a href="../admin/admin_panel.php">Volver al Panel de Administrador</a>
</body>

</html>