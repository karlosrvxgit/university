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
    $maestro_id = $_POST['maestro_id'];
    $clase_id = $_POST['clase_id'];

    // Insertar la relación maestro-clase en la base de datos
    $stmt = $pdo->prepare("INSERT INTO maestros_cursos (id_maestro, id_curso) VALUES (?, ?)");
    $stmt->execute([$maestro_id, $clase_id]);

    echo "Relación establecida exitosamente.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Relacionar Maestro a Clase</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>
<body>
    <h1>Relacionar Maestro a Clase</h1>
    <!-- Formulario para relacionar maestro a clase -->
    <form action="relacionar_maestro_clase.php" method="POST" class="max-w-xs mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
    <div class="mb-4">
        <label for="maestro_id" class="block text-sm font-medium text-gray-600">ID del Maestro:</label>
        <input type="text" name="maestro_id" required class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-indigo-300">
    </div>

    <div class="mb-4">
        <label for="clase_id" class="block text-sm font-medium text-gray-600">ID de la Clase:</label>
        <input type="text" name="clase_id" required class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-indigo-300">
    </div>

    <div class="text-center">
        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Relacionar Maestro a Clase
        </button>
    </div>
</form>


    <br>
    <a href="admin_panel.php">Volver al Panel de Administrador</a>
</body>
</html>

