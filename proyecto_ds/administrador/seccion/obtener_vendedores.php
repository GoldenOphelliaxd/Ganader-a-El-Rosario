<?php
// obtener_vendedores.php
include('../config/bd.php');

try {
    $query = $conexion->query("SELECT id, nombre, razon_social FROM vendedores");
    $vendedores = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($vendedores)) {
        echo json_encode(['status' => 'empty', 'message' => 'No hay vendedores registrados.']);
    } else {
        echo json_encode($vendedores);
    }
} catch (Exception $e) {
    error_log("Error al obtener vendedores: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Error al obtener los vendedores.']);
}
?>
