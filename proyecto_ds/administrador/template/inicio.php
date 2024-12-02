<?php include("cabecera.php"); ?>
    <style>
        /* Estilos generales */
        body {
            background: #002b36;
            color: #f8f9fa;
        }

        .bg-success {
            background: linear-gradient(90deg, #1e81b0, #1b6583); /* Azul degradado */
            text-align: center; /* Centrar el contenido */
        }

        .logo {
            max-width: 150px; /* Tamaño ajustado del logo */
            margin-bottom: 15px; /* Espacio entre el logo y el texto */
        }

        .section-btn {
            text-align: center;
            border: none;
            border-radius: 10px;
            padding: 20px;
            transition: transform 0.2s ease-in-out, background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: #1b3a4b;
            color: #fff;
            text-decoration: none;
            width: 180px; /* Ancho fijo para botones consistentes */
        }

        .section-btn:hover {
            transform: scale(1.1);
            background: #265a77;
        }

        .section-img {
            max-width: 100px;
            margin-bottom: 10px;
            border-radius: 12px; /* Esquinas redondeadas */
            border: 2px solid #ccc;
            display: block;
            margin: 0 auto; /* Centrar imágenes */
        }

        .navbar-nav .nav-link {
            font-size: 1.2em;
            color: #f8f9fa !important;
        }

        h2 {
            font-family: 'Poppins', sans-serif;
        }

        h4 {
            font-family: 'Roboto', sans-serif;
            margin-top: 10px; /* Espacio para evitar superposición */
        }

        /* Estilo para los contenedores de los botones */
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px; /* Espaciado entre botones */
            margin-top: 30px;
        }

        .row {
            display: flex;
            justify-content: center;
            gap: 40px; /* Espaciado entre filas */
        }
    </style>
</head>
<body>

    <!-- Contenido principal -->
    <div class="container mt-4">
        <!-- Encabezado principal con logo -->
        <div class="bg-success text-white p-4 rounded shadow">
            <img src="../../img/logouno.jpg" alt="Logo de la Ganadería El Rosario" class="logo">
            <h2 class="text-center mb-4">Bienvenido a La Ganadería El Rosario</h2>
            <p class="text-center mb-5">¡Vamos a trabajar!</p>
        </div>

        <!-- Sección de botones organizados en horizontal -->
        <div class="button-container">       
            <!-- Recepción -->
            <a href="../seccion/recepcion.php" class="section-btn">
                <img src="../../img/recepción.jpg" alt="Recepción" class="section-img">
                <h4>Recepción</h4>
            </a>

            <!-- Ventas -->
            <a href="../seccion/ventas.php" class="section-btn">
                <img src="../../img/venta.jpg" alt="Ventas" class="section-img">
                <h4>Ventas</h4>
            </a>
            <!-- Tratamiento -->
            <a href="../seccion/tratamiento.php" class="section-btn">
                <img src="../../img/tratamiento.jpg" alt="Ventas" class="section-img">
                <h4>Tratamiento</h4>
            </a>
            <!-- Almacén -->
            <a href="../seccion/almacen.php" class="section-btn">
                <img src="../../img/almacen.jpg" alt="Almacén" class="section-img">
                <h4>Almacén</h4>
            </a>
             <!-- Dietas -->
             <a href="../seccion/dietas.php" class="section-btn">
                <img src="../../img/clasificacion.jpg" alt="Dietas" class="section-img">
                <h4>Dietas</h4>
            </a>
        </div>
    </div> <!-- Fin del contenido principal -->

    <!-- Incluir el pie de página -->
    <?php include("pie.php"); ?>
</body>
</html>
