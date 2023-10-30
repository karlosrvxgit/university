<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();

    if(isset($_SESSION["user_data"])) {
        $role_id = $_SESSION["user_data"]["role_id"];

        if($role_id === 3) {
            include($_SERVER["DOCUMENT_ROOT"] . "/admin/admin_panel.php");
        } elseif($role_id === 4) {
            include($_SERVER["DOCUMENT_ROOT"] . "/maestro/maestro_panel.php");
        } elseif($role_id === 5) {
            include($_SERVER["DOCUMENT_ROOT"] . "/views/alumno/dashboard.php");
        } else {
            echo "No tienes permisos para acceder a esta página.";
        }
    } else {
        echo "Debes iniciar sesión primero.";
       
    }
    ?>
</body>
</html>
