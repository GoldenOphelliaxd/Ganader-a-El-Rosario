<?php include('../template/cabecera.php'); ?>
<?php include('../config/bd.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Venta</title>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Registro de Venta</h1>
    <form method="post" action="procesar_venta.php">
        <div class="form-group mb-3">
            <label for="n_remision">Número de Remisión:</label>
            <input type="text" id="n_remision" name="n_remision" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="motivo">Motivo de la Venta:</label>
            <select id="motivo" name="motivo" class="form-select" required>
                <option value="comercializacion">Comercialización</option>
                <option value="sacrificio">Sacrificio</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="comprador">Seleccionar Comprador:</label>
            <select id="comprador" name="comprador" class="form-select" required>
                <option value="">Seleccione un comprador</option>
                <?php
                // Consulta para cargar compradores
                $query = $conexion->query("SELECT id, nombre FROM compradores");
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
                }
                ?>
            </select>
        </div>
        <h3>Bovinos Vendidos</h3>
        <table class="table table-bordered" id="tablaBovinosVenta">
            <thead>
            <tr>
                <th>Número de Arete</th>
                <th>Peso (kg)</th>
                <th>Precio ($)</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
        <button type="button" id="agregarBovinoVenta" class="btn btn-primary">Agregar Bovino</button>
        <button type="submit" class="btn btn-success">Registrar Venta</button>
    </form>
</div>

<script>
$(document).ready(function () {
    // Agregar una nueva fila a la tabla de bovinos
    $("#agregarBovinoVenta").click(function () {
        const fila = `
            <tr>
                <td><input type="text" name="numero_arete[]" class="form-control" required></td>
                <td><input type="number" name="peso[]" class="form-control" step="0.01" required></td>
                <td><input type="number" name="precio[]" class="form-control" step="0.01" required></td>
                <td><button type="button" class="btn btn-danger borrarFila">Eliminar</button></td>
            </tr>`;
        $("#tablaBovinosVenta tbody").append(fila);
    });

    // Eliminar una fila de la tabla de bovinos
    $("#tablaBovinosVenta").on("click", ".borrarFila", function () {
        $(this).closest("tr").remove();
    });
});
</script>
</body>
</html>
