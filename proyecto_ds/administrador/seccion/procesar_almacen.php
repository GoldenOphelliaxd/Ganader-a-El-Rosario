<?php
include('../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_item = $_POST['nombre_item'];
    $tipo = $_POST['tipo'];
    $cantidad = $_POST['cantidad'];
    $unidad = $_POST['unidad'];

    // Verificar si el producto ya existe en el almacén
    $sql_check = "SELECT * FROM almacen WHERE nombre_item = :nombre_item AND tipo = :tipo";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bindParam(':nombre_item', $nombre_item);
    $stmt_check->bindParam(':tipo', $tipo);
    $stmt_check->execute();

    if ($stmt_check->rowCount() > 0) {
        // Si el producto ya existe, actualizar la cantidad
        $sql_update = "UPDATE almacen SET cantidad = cantidad + :cantidad, fecha_actualizacion = NOW() WHERE nombre_item = :nombre_item AND tipo = :tipo";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bindParam(':cantidad', $cantidad);
        $stmt_update->bindParam(':nombre_item', $nombre_item);
        $stmt_update->bindParam(':tipo', $tipo);
        $stmt_update->execute();
    } else {
        // Si el producto no existe, insertar un nuevo registro
        $sql_insert = "INSERT INTO almacen (nombre_item, tipo, cantidad, unidad, fecha_actualizacion) VALUES (:nombre_item, :tipo, :cantidad, :unidad, NOW())";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bindParam(':nombre_item', $nombre_item);
        $stmt_insert->bindParam(':tipo', $tipo);
        $stmt_insert->bindParam(':cantidad', $cantidad);
        $stmt_insert->bindParam(':unidad', $unidad);
        $stmt_insert->execute();
    }

    header("Location: almacen.php?mensaje=Entrada registrada correctamente");
    exit;
}
?>
