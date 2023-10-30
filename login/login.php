<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>
<body>
    
<body>
    <?php
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        session_start();
        extract($_POST);

        require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

        try {
            $stmnt = $pdo->query("SELECT * FROM usuario WHERE correo='$correo'");
            // echo "correo: $correo, Rol: $rol";
            if ($stmnt->rowCount() === 1) {
                //después de corroborar el hash de la contraseña..

                $_SESSION["user_data"] = $stmnt->fetch(PDO::FETCH_ASSOC);
                header("Location: /views/dashboard.php");
            } else {
                echo "El correo no existe";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
</body>
</body>
</html>