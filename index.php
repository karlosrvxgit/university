<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIVERSITY</title>
    <link href="/dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,1,0" />
    <style>
        @keyframes fadeInOut {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        .animate-fade-in-out {
            animation: fadeInOut 6s infinite;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center bg-yellow-100">
    <div class="w-full md:w-80 mb-8 animate-fade-in-out">
        <img src="/imagenes/logo.jpg" alt="Logo" class="w-full">
    </div>
    <form action="/login/login.php" method="post" class="bg-white rounded-lg shadow-lg max-w-xs w-full p-8">
        <div class="mb-4">
            <p class="mb-4 text-center text-gray-600">Bienvenido, ingresa con tu cuenta</p>
            <div class="flex  mb-4  ">
                <input placeholder="Email" name="correo" id="correo" class="w-full py-2 px-4 rounded-full border-2 text-sm focus:outline-none focus:border-violet-700" required>
                <span class="material-symbols-outlined right-12 z-01 relative top-3 text-gray-300">
                    mail
                </span>
            </div>
            <div class="relative flex">
                <input type="password" placeholder="Password" name="contrasena" id="contrasena" class="w-full py-2 px-4 rounded-full border-2 text-sm focus:outline-none focus:border-violet-700" required>
                <span class="material-symbols-outlined right-12 z-01 relative top-3 text-gray-300">
                    lock
                </span>
            </div>
        </div>
        <div class="mb-4 flex items-center justify-between">
            <button type="submit" class="w-32 py-2 bg-yellow-500 hover:bg-blue-600 active:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500 rounded-full text-white">
                Ingresar
            </button>
        </div>
        <p class="text-sm text-center text-gray-600">¿No tienes cuenta? <a href="/register/register.php" class="text-blue-500 hover:underline">Regístrate aquí</a></p>
    </form>
</body>

</html>