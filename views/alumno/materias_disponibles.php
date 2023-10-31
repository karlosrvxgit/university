<?php
session_start();
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
    <title>Document</title>
    <link href="/dist/output.css" rel="stylesheet">
    
</head>

<body class="bg-gray-100 p-4">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Materias Disponibles:</h2>

        <?php if (count($faltantes) !== 0) { ?>
            <form action="/handle_db/alumno/inscribir_materia.php" method="post" class="mb-4">
                <label class="block mb-2">Escoge tus materias:</label>
                <select multiple name="materias[]" class="w-full border p-2 rounded">
                    <?php foreach ($faltantes as $key => $faltante) { ?>
                        <option value="<?= $faltante["materia_id"] ?>"><?= $faltante["materia_nombre"] ?></option>
                    <?php } ?>
                </select>
                <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Inscribirse</button>
            </form>
        <?php } else { ?>
            <p>Estás inscrito a todas las materias</p>
        <?php } ?>
    </div>
</body>
</html>

