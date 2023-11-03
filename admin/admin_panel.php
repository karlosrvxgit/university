
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="../dist/output.css" rel="stylesheet">
    <style>
        /* Estilos adicionales si es necesario */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 20%;
        }

        .content {
            margin-left: 20%;
            /* Ancho del sidebar */
            padding: 20px;
        }
    </style>
</head>

<body class="flex bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar bg-gray-800 text-white p-4">
        <img src="/imagenes/logo.jpg" alt="logo" width="40" class="flex justify-center">
        <h2 class="text-2xl font-semibold mb-4">Admin Panel</h2>
        <ul>
            <li class="mb-2">
                <a href="#" class="hover:text-yellow-400">Inicio</a>
            </li>
            <li class="mb-2">
                <a href="#" class="hover:text-yellow-400">Gestión de Maestros</a>
                <ul class="ml-4 group-hover:block #">
                    <li> <a href="#" class="hover:text-yellow-400" onclick="loadContent('/admin/crear_maestro.php')">Crear Maestro</a></li>
                    <li><a href="#" class="hover:text-yellow-400" onclick="loadContent('/admin/listar_maestros.php')">Listar Maestros</a></li>
                </ul>
            </li>
            <li class="mb-2">
                <a href="#" class="hover:text-yellow-400">Gestión de Alumnos</a>
                <ul class="ml-4 group-hover:block #">
                    <li> <a href="#" class="hover:text-yellow-400" onclick="loadContent('/alumno/crear_alumno.php')">Crear Alumno</a></li>
                    <li><a href="#" class="hover:text-yellow-400" onclick="loadContent('/alumno/listar_alumnos.php')">Listar Alumno</a></li>
                </ul>
            </li>
            <li class="mb-2">
                <a href="#" class="hover:text-yellow-400">Gestión de Materias</a>
                <ul class="ml-4 group-hover:block #">
                    <li> <a href="#" class="hover:text-yellow-400" onclick="loadContent('/admin/crear_materia.php')">Crear Materia</a></li>
                    <li><a href="#" class="hover:text-yellow-400" onclick="loadContent('/admin/listar_materias.php')">Listar Materia</a></li>
                </ul>
            </li>
            <li class="mb-2">
                <a class="hover:text-yellow-400">Relacionar Maestro y Clase</a>
                <ul class="ml-4 group-hover:block #">
                    <li><a href="#" class="hover:text-yellow-400" onclick="loadContent('/admin/relacionar_maestro_clase.php')">Relacionar Maestro y Clases</a></li>
                </ul>
            </li>
            <li class="mb-2">
                <a class="hover:text-yellow-400">Cambio de Rol de Usuario</a>
                <ul class="ml-4 group-hover:block #">
                    <li><a href="#" class="hover:text-yellow-400" onclick="loadContent('/admin/cambio_rol_usuario.php')">Cambio de Rol de Usuario</a></li>
                    <li class="hover:bg-gray-700 py-2"><a href="/cerrar_sesion.php">cerrar_sesion</a></li>

                </ul>
            </li>
           
        </ul>
    </div>


    <div class="content w-80 p-4">
        <div id="dynamic-content">
            
        </div>
    </div>

    <script>
        function loadContent(page) {
           
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Inserta el contenido cargado en el div con id "dynamic-content"
                    document.getElementById("dynamic-content").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", page, true);
            xhttp.send();
        }
    </script>
</body>

</html>