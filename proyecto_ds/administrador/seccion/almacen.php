<?php include('../template/cabecera.php'); ?>
<?php include('../config/bd.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Almacén</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Gestión de Almacén</h1>
    <form method="post" action="procesar_almacen.php">
        <div class="form-group mb-3">
            <label for="nombre_item">Nombre del Producto:</label>
            <input type="text" id="nombre_item" name="nombre_item" class="form-control" placeholder="Ejemplo: Saco de Maíz, Jeringas" required>
        </div>
        <div class="form-group mb-3">
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" class="form-select" required>
                <option value="materia_prima">Materia Prima</option>
                <option value="medicamento">Medicamento</option>
                <option value="aditamento">Aditamento</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" step="0.01" placeholder="Cantidad en kg, piezas, litros, etc." required>
        </div>
        <div class="form-group mb-3">
            <label for="unidad">Unidad:</label>
            <select id="unidad" name="unidad" class="form-select" required>
                <option value="kg">Kilogramos</option>
                <option value="pieza">Piezas</option>
                <option value="saco">Sacos</option>
                <option value="litro">Litros</option>
                <option value="otros">Otros</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Entrada</button>
    </form>

    <hr>
    <h3>Inventario Actual</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre del Producto</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Última Actualización</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Consulta para obtener el inventario
        $query = $conexion->query("SELECT * FROM almacen ORDER BY id ASC");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nombre_item']}</td>
                    <td>{$row['tipo']}</td>
                    <td>{$row['cantidad']}</td>
                    <td>{$row['unidad']}</td>
                    <td>{$row['fecha_actualizacion']}</td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
