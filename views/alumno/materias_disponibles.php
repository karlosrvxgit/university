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

<h2>Materias disponibles:</h2>

<?php
if (count($faltantes) !== 0) {
?>
    <form action="/handle_db/alumno/inscribir_materia.php" method="post">
        <label>Escoge tus materias</label>
        <select multiple name="materias[]">

            <?php
            foreach ($faltantes as $key => $faltante) {
            ?>
                <option value="<?= $faltante["materia_id"] ?>">
                    <?= $faltante["materia_nombre"] ?>
                </option>
            <?php
            }
            ?>
        </select>
        <button type="submit">Inscribirse</button>
    </form>
<?php
} else {
    echo "<p>Estás inscrito a todas las materias</p>";
}
?>