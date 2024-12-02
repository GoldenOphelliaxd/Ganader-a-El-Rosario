<?php
include('../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $n_remision = $_POST['n_remision'];
    $motivo = $_POST['motivo'];
    $comprador = $_POST['comprador'];

    $stmt = $conexion->prepare("INSERT INTO ventas (n_remision, motivo, comprador_id, fecha) VALUES (:n_remision, :motivo, :comprador, NOW())");
    $stmt->execute([
        ':n_remision' => $n_remision,
        ':motivo' => $motivo,
        ':comprador' => $comprador
    ]);

    $venta_id = $conexion->lastInsertId();

    if (!empty($_POST['numero_arete'])) {
        $stmtBovino = $conexion->prepare("INSERT INTO bovinos_vendidos (venta_id, numero_arete, peso, precio) VALUES (:venta_id, :numero_arete, :peso, :precio)");
        foreach ($_POST['numero_arete'] as $index => $arete) {
            $stmtBovino->execute([
                ':venta_id' => $venta_id,
                ':numero_arete' => $arete,
                ':peso' => $_POST['peso'][$index],
                ':precio' => $_POST['precio'][$index]
            ]);
        }
    }
    echo "Venta registrada exitosamente.";
}
?>
