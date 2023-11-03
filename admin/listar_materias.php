<?php
session_start();

// Verificar si el usuario tiene el rol de administrador
if ($_SESSION["user_data"]["role_id"] !== 3) {
    header('Location: acceso_denegado.php');
    exit;
}

require_once('../config/database.php'); // Configuración de la base de datos

// Obtener la lista de clases desde la base de datos
$stmt = $pdo->prepare("SELECT materia_id, materia_nombre FROM materias");
$stmt->execute();
$materias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Listar Materias</title>
    <link href="../dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="/DataTables/datatables.css" />
    <script src="/DataTables/datatables.js"></script>
</head>

<body>
    <h1>Listar Materias</h1>

    <!-- Mostrar la lista de clases -->

    <?php if ($materias) : ?>
        <table id="maestrosTable" class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4">Nombre</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($materias as $materia) : ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4"><?php echo $materia['materia_nombre']; ?></td>
                        <td class="py-2 px-4">
                            <a href="editar_materia.php?materia_id=<?php echo $materia['materia_id']; ?>" class="text-blue-500 hover:underline mx-2">
                                <i class="fas fa-edit"></i> <!-- Icono de lápiz para editar -->
                            </a>
                            <a href="borrar_materia.php?id=<?php echo $materia['materia_id']; ?>" class="text-red-500 hover:underline">
                                <i class="fas fa-trash-alt"></i> <!-- Icono de papelera de reciclaje para eliminar -->
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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

    <?php else : ?>
        <p>No hay materias registradas.</p>
    <?php endif; ?>

    <br>
    <a href="admin_panel.php">Volver al Panel de Administrador</a>
</body>

</html>