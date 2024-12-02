<?php include('../template/cabecera.php'); ?>
<?php include('../config/bd.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tratamiento del Ganado</title>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h1>Tratamiento del Ganado</h1>
    <form method="post" action="procesar_tratamiento.php">
        <div class="form-group mb-3">
            <label for="numero_arete">Número de Arete:</label>
            <input type="text" id="numero_arete" name="numero_arete" class="form-control" placeholder="Número de arete del animal" required>
        </div>
        <div class="form-group mb-3">
            <label for="tratamiento">Tratamiento Suministrado:</label>
            <select id="tratamiento" name="tratamiento" class="form-select" required>
                <option value="vitamina">Vitamina (1 cm / 50 kg)</option>
                <option value="vacuna">Vacuna (5 cm por cabeza)</option>
                <option value="desparasitante">Desparasitante (1 cm / 50 kg)</option>
                <option value="otro">Otro (especificar abajo)</option>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="detalle">Detalle del Tratamiento:</label>
            <textarea id="detalle" name="detalle" class="form-control" placeholder="Especifica detalles del tratamiento si seleccionaste 'Otro'"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Tratamiento</button>
    </form>

    <hr>
    <h3>Historial de Tratamientos</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Número de Arete</th>
            <th>Tratamiento</th>
            <th>Detalle</th>
            <th>Fecha</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Consulta para obtener el historial de tratamientos
        $query = $conexion->query("SELECT * FROM tratamientos ORDER BY fecha DESC");
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['numero_arete']}</td>
                    <td>{$row['tratamiento']}</td>
                    <td>{$row['detalle']}</td>
                    <td>{$row['fecha']}</td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
