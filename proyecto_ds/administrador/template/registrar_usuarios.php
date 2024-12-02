<?php
session_start();
include('../config/bd.php'); // Archivo de conexión a la base de datos

// Comprueba si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: ../template/login.php");
    exit();
}

$mensaje = ""; // Inicializa el mensaje

// Procesa el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_trabajador = trim($_POST['nombre_trabajador']);
    $contrasena = trim($_POST['contrasena']);

    // Validar campos obligatorios
    if (empty($nombre_trabajador) || empty($contrasena)) {
        $mensaje = "Por favor, completa todos los campos obligatorios.";
    } else {
        try {
            // Verificar si ya existe el trabajador en la tabla 'usuarios'
            $sql = "SELECT * FROM usuarios WHERE `Nombre de Trabajador` = :nombre_trabajador";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':nombre_trabajador' => $nombre_trabajador]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                $mensaje = "El trabajador ya está registrado.";
            } else {
                // Insertar nuevo trabajador en la tabla 'usuarios'
                $sql = "INSERT INTO usuarios (`Nombre de Trabajador`, `Contraseña`) 
                        VALUES (:nombre_trabajador, :contrasena)";
                $stmt = $conexion->prepare($sql);

                // Guarda la contraseña tal como está, sin encriptarla
                $stmt->execute([
                    ':nombre_trabajador' => $nombre_trabajador,
                    ':contrasena' => $contrasena, // Contraseña sin encriptar
                ]);

                $mensaje = "Trabajador registrado exitosamente.";
            }
        } catch (PDOException $e) {
            $mensaje = "Error al registrar trabajador: " . $e->getMessage();
        }
    }
}
?>

<div class="container mt-5">
    <h2>Registrar Nuevo Trabajador</h2>
    <?php if (!empty($mensaje)) : ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="nombre_trabajador">Nombre del Trabajador:</label>
            <input type="text" class="form-control" id="nombre_trabajador" name="nombre_trabajador" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
    <!-- Botón que redirige al login -->
    <a href="../template/login.php" class="btn btn-secondary mt-3">Ir al Login</a>
</div>

<?php include('../template/pie.php'); // Incluye el pie ?>
