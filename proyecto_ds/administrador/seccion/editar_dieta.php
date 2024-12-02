<?php
include('../config/bd.php');

// Obtener dieta y sus ingredientes
$dieta_id = $_GET['id'];
$query = $conexion->prepare("SELECT * FROM dietas WHERE id = :id");
$query->bindParam(':id', $dieta_id);
$query->execute();
$dieta = $query->fetch(PDO::FETCH_ASSOC);

$ingredientes_query = $conexion->prepare("SELECT * FROM ingredientes_dieta WHERE dieta_id = :id");
$ingredientes_query->bindParam(':id', $dieta_id);
$ingredientes_query->execute();
$ingredientes = $ingredientes_query->fetchAll(PDO::FETCH_ASSOC);

// Agregar ingrediente
if ($_POST && isset($_POST['agregar_ingrediente'])) {
    $ingrediente = $_POST['ingrediente'];
    $cantidad = $_POST['cantidad'];
    $stmt = $conexion->prepare("INSERT INTO ingredientes_dieta (dieta_id, ingrediente, cantidad) VALUES (:dieta_id, :ingrediente, :cantidad)");
    $stmt->bindParam(':dieta_id', $dieta_id);
    $stmt->bindParam(':ingrediente', $ingrediente);
    $stmt->bindParam(':cantidad', $cantidad);
    $stmt->execute();
    header("Location: editar_dieta.php?id=$dieta_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Dieta</title>
</head>
<body>
    <h1>Editar Dieta: <?= $dieta['nombre']; ?></h1>

    <!-- Formulario para agregar ingredientes -->
    <form method="POST">
        <label for="ingrediente">Ingrediente:</label>
        <input type="text" name="ingrediente" required>
        <label for="cantidad">Cantidad (Kg):</label>
        <input type="number" step="0.01" name="cantidad" required>
        <button type="submit" name="agregar_ingrediente">Agregar</button>
    </form>

    <!-- Listado de ingredientes -->
    <h2>Ingredientes</h2>
    <ul>
        <?php foreach ($ingredientes as $ing): ?>
            <li><?= $ing['ingrediente']; ?>: <?= $ing['cantidad']; ?> Kg</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
