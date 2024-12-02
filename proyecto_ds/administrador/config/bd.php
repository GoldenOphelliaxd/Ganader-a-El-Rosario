<?php
$host = 'localhost'; 
$usuario = 'root'; 
$contraseña = '';  
$base_datos = 'mi_proyecto'; 

try {
    $conexion = new PDO("mysql:host=$host;dbname=$base_datos", $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    exit();
}

?>
