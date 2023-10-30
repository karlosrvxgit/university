<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // extract($_POST);
    require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

    $studentId = 4;//debe venir de la variable de sesion

    // header("Location: /views/dashboard.php");
    $materias = $_POST["materias"];

    foreach ($materias as $materiaId) {
        $stmnt = $pdo->prepare("INSERT INTO alumnos_materias(alumno_id, materia_id) VALUES (:alumno_id, :materia_id)");
        $stmnt->bindParam(":alumno_id", $studentId, PDO::PARAM_INT);
        $stmnt->bindParam(":materia_id", $materiaId, PDO::PARAM_INT);
        $stmnt->execute();
    }

    header("location: /views/dashboard.php");
}