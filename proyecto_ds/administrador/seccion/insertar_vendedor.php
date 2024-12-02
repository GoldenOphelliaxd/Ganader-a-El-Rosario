<?php
// insertar_vendedor.php
include('../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $razon_social = $_POST['razon_social'] ?? '';
    $domicilio = $_POST['domicilio'] ?? '';
    $localidad = $_POST['localidad'] ?? '';
    $municipio = $_POST['municipio'] ?? '';
    $estado = $_POST['estado'] ?? '';

    try {
        // Validación básica
        if (empty($nombre) || empty($domicilio) || empty($localidad) || empty($municipio) || empty($estado)) {
            echo json_encode(['status' => 'error', 'message' => 'Todos los campos requeridos deben ser llenados.']);
            exit;
        }

        // Inserción en la base de datos
        $sql = "INSERT INTO vendedores (nombre, razon_social, domicilio, localidad, municipio, estado) 
                VALUES (:nombre, :razon_social, :domicilio, :localidad, :municipio, :estado)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':razon_social', $razon_social);
        $stmt->bindParam(':domicilio', $domicilio);
        $stmt->bindParam(':localidad', $localidad);
        $stmt->bindParam(':municipio', $municipio);
        $stmt->bindParam(':estado', $estado);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Vendedor agregado con éxito']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo agregar el vendedor.']);
        }
    } catch (Exception $e) {
        error_log("Error al agregar vendedor: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos.']);
    }
}
?>

