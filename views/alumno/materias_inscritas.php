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
<h2>Materias Inscritas</h2>
<table border="1">
    <thead>
        <tr>
            <th>Materia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // session_start();
        foreach ($inscritas as $inscrita) {
        ?>
            <tr>
                <td><?= $inscrita['materia_nombre'] ?></td>
                <td>
                    <form action="/handle_db/alumno/retirar_materia.php" method="post">
                        <input type="number" hidden value="<?= $inscrita["materia_id"] ?>" name="materia_id">
                        <button type="submit">Darse de baja</button>
                    </form>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>