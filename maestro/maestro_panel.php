<?php

// Verificar si el usuario tiene el rol de maestro
if (!isset($_SESSION["user_data"]) || $_SESSION["user_data"]["role_id"] !== 4) {
    header('Location: acceso_denegado.php');
    exit;
}

require_once('../config/database.php'); // Configuración de la base de datos

// Obtener la ID del maestro desde la sesión
$maestro_id = $_SESSION['user_data']['id'];

// Consultar la materia asignada al maestro
$stmt = $pdo->prepare("SELECT m.materia_nombre FROM materias m 
                       JOIN maestros_cursos mm ON m.materia_id = mm.id_curso
                       WHERE mm.id_maestro = ?");
$stmt->execute([$maestro_id]);
$materia = $stmt->fetch(PDO::FETCH_ASSOC);

// Consultar la lista de alumnos en la materia asignada al maestro
$alumnos = [];
if ($materia) {
    $materia_id = $materia['materia_id'];
    $stmt = $pdo->prepare("SELECT a.nombre AS alumno_nombre FROM alumnos a
                           JOIN alumnos_clases ac ON a.id = ac.id_alumno
                           WHERE ac.id_clase = ?");
    $stmt->execute([$materia_id]);
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Resto del código de la página de maestro
?>
<!DOCTYPE html>
<html>

<head>
    <title>Panel de Maestro</title>
    <link href="/dist/output.css" rel="stylesheet">

    <style>
        /* Estilos adicionales si es necesario */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 20%;
            background-color: #2d3748;
            color: #ffffff;
        }

        .content {
            margin-left: 20%; /* Ancho del sidebar */
            padding: 20px;
        }

        .dynamic-content {
            width: 80%; /* Ancho del contenido dinámico */
            margin-left: 20%;
            padding: 20px;
        }

        .menu-item:hover {
            background-color: #4a5568;
        }
    </style>
   
</head>

<body class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="sidebar p-4">
        <h2 class="text-2xl font-semibold mb-4">Maestro Panel</h2>
        <ul>
            <li class="mb-2">
                <label class="menu-item">Inicio</label>
            </li>
            <li class="mb-2">
                <label class="menu-item">Materia Asignada</label>
                <ul class="ml-8">
                    <li><a href="#" class="menu-item" onclick="loadContent('/maestro/materia_asignada.php')">Ver Materia Asignada</a></li>
                    <li><a href="#" class="menu-item" onclick="loadContent('/maestro/lista_alumnos.php')">Listar Alumnos</a></li>
                    <!-- <li><a href="/maestro/lista_alumnos.php" class="menu-item">Listar Alumnos</a></li> -->
                </ul>
            </li>
        </ul>

        <br>
        <a href="/cerrar_sesion.php" class="text-yellow-400">Cerrar sesión</a>
    </div>

    <!-- Contenido dinámico -->
    <div class="content">
        <div class="dynamic-content">
            <!-- Contenido dinámico cargado por JavaScript -->
        </div>
    </div>

    <script>
        function loadContent(page) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Inserta el contenido cargado en el contenedor "dynamic-content"
                    document.querySelector('.dynamic-content').innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", page, true);
            xhttp.send();
        }
    </script>
</body>


</html>