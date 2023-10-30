<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded shadow-lg max-w-md">
        <h1 class="text-2xl font-bold mb-4 bg-blue-100">Registrarse</h1>
        <!-- Formulario de registro -->
        <form action="/register/register_process.php" method="post">

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Nombre:</label>
                <input type="text" name="name" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <div class="mb-4">
                <label for="rol" class="block text-sm font-medium text-gray-600">Rol:</label>
                <input type="text" name="rol" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <div class="mb-4">
                <label for="correo" class="block text-sm font-medium text-gray-600">Correo:</label>
                <input type="email" name="correo" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <div class="mb-4">
                <label for="contrasena" class="block text-sm font-medium text-gray-600">Contraseña:</label>
                <input type="password" name="contrasena" required class="mt-1 p-2 w-full border rounded-md">
            </div>

            <button type="submit" class="bg-blue-200 hover:bg-blue-300 text-blue-700 py-2 px-4 rounded">Registrarse</button>
        </form>

        <p class="mt-4"><a href="/cerrar_sesion.php" class="text-blue-500 hover:underline">Iniciar Sesión</a></p>
    </div>
    
</body>
</html>
