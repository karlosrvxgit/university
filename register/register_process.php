<?php
session_start();

// Verifica si se enviaron datos de registro
if (
    isset($_POST['name']) &&
    isset($_POST['rol']) &&
    isset($_POST['correo']) &&
    isset($_POST['contrasena'])
) {
    // Recupera los datos del formulario
    $name = $_POST['name'];
    $rol = $_POST['rol'];
    $correo = $_POST['correo'];
    $password = $_POST['contrasena'];

    // Hash de la contraseña 
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "uni";
    
        $mysqli = new mysqli($hostname, $username, $password, $dbname);
        
        // Verifica la conexión
        if ($mysqli->connect_error) {
            die("La conexión falló: " . $mysqli->connect_error);
        }

        // Consulta SQL para insertar un nuevo usuario
        $query = "INSERT INTO usuario (nombre, rol, correo, contrasena) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssss', $name, $rol, $correo, $hashed_password);

        if ($stmt->execute()) {
            // Registro exitoso, establece las variables de sesión
            $_SESSION['user_id'] = $mysqli->insert_id;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_correo'] = $correo;

            // Redirige al usuario a la página de inicio de sesión
            echo 'Credenciales correctas. ';
            // header('Location: /login/login.php');
            echo " <a href='/register/register.php'>inniciar</a>";
        
           
            // exit();
        } else {
            // Error al registrar al usuario, muestra un mensaje de error
            echo "Error al registrar al usuario. <a href='/register/register.php'>Volver a intentar</a>";
        }

        // Cierra la conexión a la base de datos
        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si no se enviaron datos de registro, muestra un mensaje de error
    echo "Se requieren datos de registro. <a href='/cerrar_sesion.php'>Volver a intentar</a>";
}
?>
