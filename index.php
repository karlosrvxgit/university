<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIVERSITY</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body class="min-h-screen flex flex-col items-center justify-center bg-yellow-100">
    <div class="flex-initial w-80 mb-2">
        <img src="/imagenes/logo.jpg" alt="Logo" class="w-full">
    </div>
    <form action="/login/login.php" method="post" class="bg-white rounded-lg shadow-lg max-w-xs w-full p-8">
        <div class="mb-4 ">
            <div class="mb='4' flex justify-center text-sm text-gray-600">
            <p>Bienvenido ingresa con tu cuenta</p>
            <div>
            <span></span>
            </div>
            <span></span>
            </div>
            
            <label for="correo" class="block text-sm text-gray-600">Correo</label>
            <input type="email" name="correo" id="correo"
                class="w-full py-2 px-4 rounded-full border-2 text-sm focus:outline-none focus:border-violet-700"
                required>
        </div>
        <div class="mb-4">
            <label for="contrasena" class="block text-sm text-gray-600">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena"
                class="w-full py-2 px-4 rounded-full border-2 text-sm focus:outline-none focus:border-violet-700"
                required>
        </div>
        <div class="mb-4 flex items-center justify-between">
            <button type="submit"
                class="w-32 py-2 bg-yellow-500 hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500 rounded-full text-white">
                Ingresar
            </button>
            <a href="/register/register.php" class="text-sm text-blue-500 hover:underline">Registrarse</a>
        </div>
    </form>
</body>

</html>



