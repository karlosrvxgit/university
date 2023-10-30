
<?php
session_start();
require_once('config.php'); // Configuración de la base de datos

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$rol = $_SESSION['user_rol'];

if ($rol === 'admin') {
   
    // CRUD de maestros
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['crear_maestro'])) {
        $nombre_maestro = $_POST['nombre_maestro'];
        // Insertar el nuevo maestro en la base de datos
        $stmt = $pdo->prepare("INSERT INTO maestros (nombre) VALUES (?)");
        $stmt->execute([$nombre_maestro]);
    } elseif (isset($_POST['editar_maestro'])) {
        $id_maestro = $_POST['id_maestro'];
        $nombre_maestro = $_POST['nombre_maestro'];
        // Actualizar el maestro en la base de datos
        $stmt = $pdo->prepare("UPDATE maestros SET nombre = ? WHERE id = ?");
        $stmt->execute([$nombre_maestro, $id_maestro]);
    } elseif (isset($_POST['eliminar_maestro'])) {
        $id_maestro = $_POST['id_maestro'];
        // Eliminar el maestro de la base de datos
        $stmt = $pdo->prepare("DELETE FROM maestros WHERE id = ?");
        $stmt->execute([$id_maestro]);
    }
}

// Mostrar la lista de maestros
$stmt = $pdo->prepare("SELECT * FROM maestros");
$stmt->execute();
$maestros = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($maestros as $maestro) {
    echo "ID: " . $maestro['id'] . " | Nombre: " . $maestro['nombre'] . " | <a href='editar_maestro.php?id=" . $maestro['id'] . "'>Editar</a> | <a href='eliminar_maestro.php?id=" . $maestro['id'] . "'>Eliminar</a><br>";
}
    // CRUD de alumnos 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['crear_alumno'])) {
        $nombre_alumno = $_POST['nombre_alumno'];
        // Insertar el nuevo alumno en la base de datos
        $stmt = $pdo->prepare("INSERT INTO alumnos (nombre) VALUES (?)");
        $stmt->execute([$nombre_alumno]);
    } elseif (isset($_POST['editar_alumno'])) {
        $id_alumno = $_POST['id_alumno'];
        $nombre_alumno = $_POST['nombre_alumno'];
        // Actualizar el alumno en la base de datos
        $stmt = $pdo->prepare("UPDATE alumnos SET nombre = ? WHERE id = ?");
        $stmt->execute([$nombre_alumno, $id_alumno]);
    } elseif (isset($_POST['eliminar_alumno'])) {
        $id_alumno = $_POST['id_alumno'];
        // Eliminar el alumno de la base de datos
        $stmt = $pdo->prepare("DELETE FROM alumnos WHERE id = ?");
        $stmt->execute([$id_alumno]);
    }
}


// Para agregar una relación entre un maestro y un curso
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['relacionar_maestro_curso'])) {
    $id_maestro = $_POST['id_maestro'];
    $id_curso = $_POST['id_curso'];
    // Insertar la relación en la tabla de relaciones
    $stmt = $pdo->prepare("INSERT INTO maestros_cursos (id_maestro, id_curso) VALUES (?, ?)");
    $stmt->execute([$id_maestro, $id_curso]);
}



    // CRUD de maestros, alumnos, clases, relaciones, cambio de rol, etc.
} elseif ($rol === 'maestro') {
  
    // Obtener la ID del maestro desde la sesión
$maestro_id = $_SESSION['user_id'];

// Consultar la clase asignada al maestro
$stmt = $pdo->prepare("SELECT c.nombre AS clase_nombre FROM clases c 
                       JOIN maestros_cursos mc ON c.id = mc.id_curso
                       WHERE mc.id_maestro = ?");
$stmt->execute([$maestro_id]);
$clase = $stmt->fetch(PDO::FETCH_ASSOC);

if ($clase) {
    echo "Estás asignado a la clase: " . $clase['clase_nombre'];
} else {
    echo "No estás asignado a ninguna clase.";
}

// Obtener la ID del maestro desde la sesión
$maestro_id = $_SESSION['user_id'];

// Consultar los alumnos asignados al maestro
$stmt = $pdo->prepare("SELECT a.nombre AS alumno_nombre FROM alumnos a
                       JOIN alumnos_clases ac ON a.id = ac.id_alumno
                       JOIN clases c ON ac.id_clase = c.id
                       JOIN maestros_cursos mc ON c.id = mc.id_curso
                       WHERE mc.id_maestro = ?");
$stmt->execute([$maestro_id]);
$alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($alumnos) {
    echo "Tus alumnos son:<br>";
    foreach ($alumnos as $alumno) {
        echo $alumno['alumno_nombre'] . "<br>";
    }
} else {
    echo "No tienes alumnos asignados.";
}


    // Ver la clase asignada y los datos de sus alumnos
} elseif ($rol === 'alumno') {
 
    // Obtener la ID del alumno desde la sesión
$alumno_id = $_SESSION['user_id'];

// Consultar las clases en las que está registrado el alumno
$stmt = $pdo->prepare("SELECT c.nombre AS clase_nombre FROM clases c
                       JOIN alumnos_clases ac ON c.id = ac.id_clase
                       WHERE ac.id_alumno = ?");
$stmt->execute([$alumno_id]);
$clases = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($clases) {
    echo "Estás registrado en las siguientes clases:<br>";
    foreach ($clases as $clase) {
        echo $clase['clase_nombre'] . "<br>";
    }
} else {
    echo "No estás registrado en ninguna clase.";
}

// Obtener la ID del alumno desde la sesión
$alumno_id = $_SESSION['user_id'];

// Consultar todas las clases disponibles
$stmt = $pdo->prepare("SELECT id, nombre FROM clases");
$stmt->execute();
$clases_disponibles = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($clases_disponibles) {
    echo "Selecciona las clases en las que quieres registrarte:<br>";
    echo "<form action='cambiar_clases.php' method='POST'>";
    
    foreach ($clases_disponibles as $clase) {
        echo "<input type='checkbox' name='clases[]' value='" . $clase['id'] . "'> " . $clase['nombre'] . "<br>";
    }
    
    echo "<input type='submit' value='Cambiar Clases'>";
    echo "</form>";
} else {
    echo "No hay clases disponibles en este momento.";
}


// Obtener la ID del alumno desde la sesión
$alumno_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clases'])) {
    // Obtener las clases seleccionadas por el alumno
    $clases_seleccionadas = $_POST['clases'];

    // Eliminar las relaciones anteriores del alumno con las clases
    $stmt = $pdo->prepare("DELETE FROM alumnos_clases WHERE id_alumno = ?");
    $stmt->execute([$alumno_id]);

    // Establecer nuevas relaciones entre el alumno y las clases seleccionadas
    foreach ($clases_seleccionadas as $clase_id) {
        $stmt = $pdo->prepare("INSERT INTO alumnos_clases (id_alumno, id_clase) VALUES (?, ?)");
        $stmt->execute([$alumno_id, $clase_id]);
    }

    echo "Tus clases han sido actualizadas correctamente.";
}

}
