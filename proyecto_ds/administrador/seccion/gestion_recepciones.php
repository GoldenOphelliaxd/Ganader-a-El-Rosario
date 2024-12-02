<?php
include('../template/cabecera.php');
include('../config/bd.php');

// Obtener todas las recepciones
$query = $conexion->query("
    SELECT r.id, r.n_reemo, r.motivo, r.fecha, v.nombre AS vendedor_nombre
    FROM recepciones r
    JOIN vendedores v ON r.vendedor_id = v.id
    ORDER BY r.fecha DESC
");
$recepciones = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h2>Gestión de Recepciones</h2>
    <?php if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'success'): ?>
        <div class="alert alert-success">¡Recepción registrada con éxito!</div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>N. REEMO</th>
                <th>Motivo</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recepciones as $recepcion): ?>
                <tr>
                    <td><?php echo $recepcion['id']; ?></td>
                    <td><?php echo $recepcion['n_reemo']; ?></td>
                    <td><?php echo $recepcion['motivo']; ?></td>
                    <td><?php echo $recepcion['vendedor_nombre']; ?></td>
                    <td><?php echo $recepcion['fecha']; ?></td>
                    <td>
                        <a href="detalle_recepcion.php?id=<?php echo $recepcion['id']; ?>" class="btn btn-info btn-sm">Ver Detalles</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include('../template/pie.php'); ?>
