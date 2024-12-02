<?php
include('../config/bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $n_reemo = $_POST['n_reemo'];
    $motivo = $_POST['motivo'];
    $vendedor_id = $_POST['vendedor'];
    $fecha_registro = date('Y-m-d H:i:s');

    try {
        // Insertar datos en la tabla 'recepciones'
        $stmt = $conexion->prepare("INSERT INTO recepciones (n_reemo, motivo, vendedor_id, fecha) VALUES (:n_reemo, :motivo, :vendedor_id, :fecha)");
        $stmt->bindParam(':n_reemo', $n_reemo);
        $stmt->bindParam(':motivo', $motivo);
        $stmt->bindParam(':vendedor_id', $vendedor_id);
        $stmt->bindParam(':fecha', $fecha_registro);

        $stmt->execute();

        // Obtener el ID de la recepción insertada
        $recepcion_id = $conexion->lastInsertId();

        // Insertar los datos de los bovinos en una tabla aparte
        if (isset($_POST['numero_arete'])) {
            foreach ($_POST['numero_arete'] as $key => $numero_arete) {
                $meses = $_POST['meses'][$key];
                $sexo = $_POST['sexo'][$key];
                $peso = $_POST['peso'][$key];
                $clasificacion = $_POST['clasificacion'][$key];
                $estado = $_POST['estado'][$key];
                $fierro = $_POST['fierro'][$key];
                $precio = $_POST['precio'][$key];

                $stmt_bovinos = $conexion->prepare("
                    INSERT INTO bovinos (recepcion_id, numero_arete, meses, sexo, peso, clasificacion, estado, fierro, precio)
                    VALUES (:recepcion_id, :numero_arete, :meses, :sexo, :peso, :clasificacion, :estado, :fierro, :precio)
                ");
                $stmt_bovinos->bindParam(':recepcion_id', $recepcion_id);
                $stmt_bovinos->bindParam(':numero_arete', $numero_arete);
                $stmt_bovinos->bindParam(':meses', $meses);
                $stmt_bovinos->bindParam(':sexo', $sexo);
                $stmt_bovinos->bindParam(':peso', $peso);
                $stmt_bovinos->bindParam(':clasificacion', $clasificacion);
                $stmt_bovinos->bindParam(':estado', $estado);
                $stmt_bovinos->bindParam(':fierro', $fierro);
                $stmt_bovinos->bindParam(':precio', $precio);

                $stmt_bovinos->execute();
            }
        }
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        exit;
        
        // Redirigir con éxito
        header('Location: gestion_recepcion.php?mensaje=success');
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "Acceso no permitido.";
    exit;
}
?>


