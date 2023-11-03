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
    <title>Document</title>
    <link href="/dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="/DataTables/datatables.css" />
    <script src="/DataTables/datatables.js"></script>

</head>

<body class="bg-gray-100 p-4">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Materias Inscritas</h2>

        <table id="maestrosTable" class="w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-4 py-2">Materia</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscritas as $inscrita) { ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $inscrita['materia_nombre'] ?></td>
                        <td class="border px-4 py-2">
                            <form action="/handle_db/alumno/retirar_materia.php" method="post">
                                <input type="hidden" value="<?= $inscrita["materia_id"] ?>" name="materia_id">
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash-alt"></i>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#maestrosTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json" // Traducción al español
                    }
                });
            });
        </script>
    </div>
</body>

</html>