<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");
$query = "
select 
    am.alumno_id,am.materia_id, m.materia_nombre, am.calificacion, am.mensaje
from 
    alumnos_materias am 
inner join materias m on
    am.materia_id = m.materia_id 
where 
am.alumno_id = :id;
";
$studentId = 4; //debe venir de la variable de sesion

$stmnt = $pdo->prepare($query);
$stmnt->bindParam(":id", $studentId, PDO::PARAM_INT);
$stmnt->execute();
$inscritas = $stmnt->fetchAll(PDO::FETCH_ASSOC);

$query = "
select
    m.materia_id, m.materia_nombre
from
    materias m
left join alumnos_materias am on
    m.materia_id = am.materia_id and am.alumno_id = :id
where
    am.am_id is null
";

$stmnt = $pdo->prepare($query);
$stmnt->bindParam(":id", $studentId, PDO::PARAM_INT);
$stmnt->execute();
$faltantes = $stmnt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body class="flex h-screen bg-gray-100">
    <!--Sidebar -->
    <div class="bg-gray-800 text-white h-screen w-1/5 sidebar p-4">
        <h2 class="text-2xl font-semibold mb-4">Alumno Panel</h2>
        <ul>
            <li class="mb-2">
                <label class="menu-item">Inicio</label>
            </li>
            <li class="mb-2">
                <label class="hover:text-yellow-400 menu-item">Materias Inscritas</label>
                <ul class="ml-8 group-hover:block #">
                <li><a href="#" class="menu-item" onclick="loadContent('/views/alumno/materias_inscritas.php')">Materias Inscritas</a></li>
                </ul>
            </li>
            <li class="mb-2">
                <label class="hover:text-yellow-400">Materias Disponibles</label>
                <ul class="ml-4 group-hover:block #">
                <li><a href="#" class="menu-item" onclick="loadContent('/views/alumno/materias_disponibles.php')">Materias Disponibles</a></li>
                    <!-- <li class="hover:bg-gray-700 py-2"><a href="/views/alumno/materias_disponibles.php">Materias Disponibles</a></li> -->

                </ul>
            </li>

        </ul>
        <a href="/cerrar_sesion.php">Cerrar Sesión</a>
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