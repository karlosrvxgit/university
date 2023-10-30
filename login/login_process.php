<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupera los datos del formulario
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    require_once($_SERVER["DOCUMENT_ROOT"] . "../config/database.php");

    try {
        // Verifica los valores recibidos (solo para depuración)
        echo "contrasena: $contrasena, Rol: $rol";

        $query = "SELECT id, nombre, rol, username, contrasena FROM usuarios WHERE username = :username AND rol = :rol";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $email);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['contrasena'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_username'] = $user['username'];
            $_SESSION['user_rol'] = $user['rol'];

            // Redirige al usuario a la página correspondiente según el rol
            if ($user['rol'] === 'admin') {
                header('Location: admin_panel.php');
            } elseif ($user['rol'] === 'maestro') {
                header('Location: maestro_panel.php');
            } elseif ($user['rol'] === 'alumno') {
                header('Location: alumno_panel.php');
            }
            exit;
        } else {
            echo 'Credenciales incorrectas. <a href="/login/login.php">Volver a intentar</a>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Se requieren datos de inicio de sesión. <a href='/login/login.php'>Volver a intentar</a>";
}
?>
