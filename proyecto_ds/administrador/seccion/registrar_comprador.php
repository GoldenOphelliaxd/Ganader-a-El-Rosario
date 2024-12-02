<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "mi_proyecto");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

// Insertar en la tabla compradores
$query = "INSERT INTO compradores (nombre, direccion, telefono, email) 
          VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ssss", $nombre, $direccion, $telefono, $email);

if ($stmt->execute()) {
    echo "Comprador registrado con éxito.";
} else {
    echo "Error al registrar el comprador: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Comprador</title>
</head>
<body>
    <h1>Registrar Comprador</h1>
    <form action="registrar_comprador.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion"><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono"><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>

        <button type="submit">Registrar Comprador</button>
    </form>
</body>
</html>
