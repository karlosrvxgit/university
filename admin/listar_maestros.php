<?php
session_start();

// Verificar si el usuario tiene el rol de administrador
if ($_SESSION["user_data"]["role_id"] !== 3) {
    header('Location: acceso_denegado.php');
    exit;
}

require_once('../config/database.php'); // Configuración de la base de datos

// Obtener la lista de maestros desde la base de datos
$stmt = $pdo->prepare("SELECT id, nombre, clases_asignadas FROM maestros");
$stmt->execute();
$maestros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Listar Maestros</title>
    <link href="/dist/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="/DataTables/datatables.css" />
    <script src="/DataTables/datatables.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">

    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

</head>

<body>
    <h1>Listar Maestros</h1>

    <!-- Mostrar la lista de maestros -->
    <?php if ($maestros) : ?>
        <table id="maestrosTable" class="max-w-full bg-white border border-gray-200 display">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Nombre</th>
                    <th class="py-2 px-4">Clases asignadas</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($maestros as $maestro) : ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4"><?php echo $maestro['id']; ?></td>
                        <td class="py-2 px-4"><?php echo $maestro['nombre']; ?></td>
                        <td class="py-2 px-4"><?php echo $maestro['clases_asignadas']; ?></td>
                        <td class="py-2 px-4">
                            <a href="/admin/editar_maestro.php?id=<?php echo $maestro['id']; ?>" class="text-blue-500 hover:underline">
                                <i class="fas fa-pencil-alt"></i> <!-- Icono de lápiz -->
                            </a>
                            <a href="/admin/borrar_maestro.php?id=<?php echo $maestro['id']; ?>" class="text-red-500 hover:underline ml-2">
                                <i class="fas fa-trash-alt"></i> <!-- Icono de papelera de reciclaje -->

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
                    },
                    "dom": 'Bfrtip', // Botones de exportación
                    "buttons": [
                        'excel', 'pdf', 'print' // Opciones de exportación (Excel, PDF, Imprimir)
                    ]
                });
            });
        </script>

    <?php else : ?>
        <p>No hay maestros registrados.</p>
    <?php endif; ?>

    <br>
    <a href="/admin/admin_panel.php">Volver al Panel de Administrador</a>


</body>

</html>