<?php
session_start();
include('../config/bd.php'); // Archivo con conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['contraseña']);

    // Validación de campos vacíos
    if (empty($usuario) || empty($contraseña)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Consulta SQL para buscar el usuario con el nombre ingresado
        $sql = "SELECT * FROM usuarios WHERE `Nombre de Trabajador` = :usuario";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        // Recuperar datos del usuario
        $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Validación de usuario y contraseña
        if ($usuarioData && $contraseña == $usuarioData['Contraseña']) {
            // Guardar información en la sesión
            $_SESSION['usuario'] = $usuarioData['Nombre de Trabajador'];

            // Redirigir a la página de inicio
            header('Location: inicio.php');
            exit;
        } else {
            // Error de credenciales
            $error = "Usuario o contraseña incorrectos.";
            $mostrarRegistro = true; // Mostrar botón para registrar usuarios
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <style>
        .login-image {
            width: 100%; /* Ajusta el tamaño de la imagen */
            border-top-left-radius: 0.25rem; /* Redondeo superior izquierdo */
            border-top-right-radius: 0.25rem; /* Redondeo superior derecho */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <!-- Imagen en la parte superior -->
                    <img src="../../img/login-banner.jpg" alt="Imagen de inicio de sesión" class="login-image">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Inicio de sesión</h3>
                        <!-- Mensajes de error -->
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="usuario">Usuario:</label>
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese su usuario" required>
                            </div>
                            <div class="form-group">
                                <label for="contraseña">Contraseña:</label>
                                <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </form>
                        
                        <!-- Botón para registrar nuevo usuario si no existen credenciales válidas -->
                        <?php if (isset($mostrarRegistro) && $mostrarRegistro): ?>
                            <div class="text-center mt-4">
                                <a href="../template/registrar_usuarios.php" class="btn btn-secondary">Registrar Nuevo Usuario</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

