<?php
include('../template/cabecera.php');
include('../config/bd.php');

// Obtener todas las dietas
$query = $conexion->prepare("SELECT * FROM dietas");
$query->execute();
$dietas = $query->fetchAll(PDO::FETCH_ASSOC);

// Procesar el registro de una mezcla nueva
if ($_POST && isset($_POST['registrar_mezcla'])) {
    $dieta_id = $_POST['dieta_id'];
    $cantidad_preparada = 1000; // Mezcla fija de 1000 kg
    $corral = $_POST['corral'];
    $fecha = date('Y-m-d'); // Fecha actual

    // Registrar mezcla en la base de datos
    $stmt = $conexion->prepare("INSERT INTO mezclas (dieta_id, cantidad_preparada, corral, fecha) VALUES (:dieta_id, :cantidad_preparada, :corral, :fecha)");
    $stmt->bindParam(':dieta_id', $dieta_id);
    $stmt->bindParam(':cantidad_preparada', $cantidad_preparada);
    $stmt->bindParam(':corral', $corral);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->execute();

    // Redirigir para evitar re-envío de formulario
    header("Location: dietas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Dietas</title>
</head>
<body>
    <h1>Gestión de Dietas</h1>

    <!-- Formulario para registrar una mezcla -->
    <h2>Registrar Mezcla para un Corral</h2>
    <form method="POST">
        <label for="dieta_id">Seleccione la Dieta:</label>
        <select name="dieta_id" required>
            <?php foreach ($dietas as $dieta): ?>
                <option value="<?= $dieta['id']; ?>"><?= $dieta['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="corral">Corral o Lote:</label>
        <input type="text" name="corral" placeholder="Ej: Lote 1, Corral A" required>

        <button type="submit" name="registrar_mezcla">Registrar Mezcla</button>
    </form>

    <!-- Mostrar historial de mezclas registradas -->
    <h2>Historial de Mezclas</h2>
    <?php
    $mezclas_query = $conexion->prepare("
        SELECT m.*, d.nombre AS dieta_nombre 
        FROM mezclas m 
        JOIN dietas d ON m.dieta_id = d.id 
        ORDER BY m.fecha DESC
    ");
    $mezclas_query->execute();
    $mezclas = $mezclas_query->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>Dieta</th>
                <th>Cantidad (Kg)</th>
                <th>Corral</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mezclas as $mezcla): ?>
                <tr>
                    <td><?= $mezcla['dieta_nombre']; ?></td>
                    <td><?= $mezcla['cantidad_preparada']; ?> Kg</td>
                    <td><?= $mezcla['corral']; ?></td>
                    <td><?= $mezcla['fecha']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include('../template/pie.php'); ?>
</body>
</html>
