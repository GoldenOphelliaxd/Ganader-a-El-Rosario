<?php
include('../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_arete = $_POST['numero_arete'];
    $tratamiento = $_POST['tratamiento'];
    $detalle = $_POST['detalle'];

    $sql = "INSERT INTO tratamientos (numero_arete, tratamiento, detalle, fecha) VALUES (:numero_arete, :tratamiento, :detalle, NOW())";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':numero_arete', $numero_arete);
    $stmt->bindParam(':tratamiento', $tratamiento);
    $stmt->bindParam(':detalle', $detalle);

    if ($stmt->execute()) {
        header("Location: tratamiento.php?mensaje=Tratamiento registrado correctamente");
    } else {
        header("Location: tratamiento.php?mensaje=Error al registrar el tratamiento");
    }
}
?>
