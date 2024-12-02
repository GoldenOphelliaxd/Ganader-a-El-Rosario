<?php include("../template/cabecera.php"); ?>
<?php include('../config/bd.php'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepción del Ganado</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   

</head>
<body>
<div class="container">
    <h2>Recepción del Ganado</h2>
    <div class="form-section">
        <h3>Datos de la Guía de Tránsito</h3>
        <form method="post" action="procesar_recepcion.php">
            <div class="form-group mb-3">
                <label for="n_reemo">N. REEMO:</label>
                <input type="text" id="n_reemo" name="n_reemo" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="motivo">Motivo:</label>
                <select id="motivo" name="motivo" class="form-select" required>
                    <option value="cria">Cría</option>
                    <option value="engorda">Engorda</option>
                    <option value="sacrificio">Sacrificio</option>
                </select>
            </div>

            <h3>Datos de Origen y Destino</h3>
            <div class="form-group mb-3">
                <label for="vendedor">Seleccionar Vendedor:</label>
                <select id="vendedor" name="vendedor" class="form-select" required>
                    <option value="">Seleccione un vendedor</option>
                    <?php
                    $query = $conexion->query("SELECT id, nombre, razon_social FROM vendedores");
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'>{$row['nombre']} - {$row['razon_social']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuevoVendedorModal">
                Agregar nuevo vendedor
            </button>

            <!-- Modal para agregar nuevo vendedor -->
            <div class="modal fade" id="nuevoVendedorModal" tabindex="-1" aria-labelledby="nuevoVendedorLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="nuevoVendedorLabel">Agregar Nuevo Vendedor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="nuevoVendedorForm">
                                <div class="form-group mb-3">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="razon_social">Razón Social:</label>
                                    <input type="text" id="razon_social" name="razon_social" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="domicilio">Domicilio:</label>
                                    <input type="text" id="domicilio" name="domicilio" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="localidad">Localidad:</label>
                                    <input type="text" id="localidad" name="localidad" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="municipio">Municipio:</label>
                                    <input type="text" id="municipio" name="municipio" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="estado">Estado:</label>
                                    <input type="text" id="estado" name="estado" class="form-control" required>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="guardarVendedor">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Datos de los Bovinos</h3>
            <table class="table table-bordered" id="tablaBovinos">
                <thead>
                <tr>
                    <th>Consecutivo</th>
                    <th>Número de Arete</th>
                    <th>Meses</th>
                    <th>Sexo</th>
                    <th>Peso</th>
                    <th>Clasificación</th>
                    <th>Estado</th>
                    <th>Fierro</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-add" id="agregarBovino">Agregar Bovino</button>
            <br><br>
            <button type="submit" class="btn btn-success">Registrar Recepción</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function () {
    // Agregar fila para datos de bovinos
    $("#agregarBovino").click(function () {
        const fila = `
            <tr>
                <td><input type="text" name="consecutivo[]" class="form-control" required></td>
                <td><input type="text" name="numero_arete[]" class="form-control" required></td>
                <td><input type="number" name="meses[]" class="form-control" min="1" required></td>
                <td>
                    <select name="sexo[]" class="form-select" required>
                        <option value="macho">Macho</option>
                        <option value="hembra">Hembra</option>
                    </select>
                </td>
                <td><input type="number" name="peso[]" class="form-control" required></td>
                <td>
                    <select name="clasificacion[]" class="form-select" required>
                        <option value="becerro/becerra">Becerro/Becerra</option>
                        <option value="torete/vacona">Torete/Vacona</option>
                        <option value="toro/vaca">Toro/Vaca</option>
                    </select>
                </td>
                <td>
                    <select name="estado[]" class="form-select" required>
                        <option value="sano">Sano</option>
                        <option value="golpeado">Golpeado</option>
                        <option value="enfermo">Enfermo</option>
                    </select>
                </td>
                <td><input type="text" name="fierro[]" class="form-control"></td>
                <td><input type="number" name="precio[]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger btn-sm borrarFila">Eliminar</button></td>
            </tr>
        `;
        $("#tablaBovinos tbody").append(fila);
    });

    // Eliminar fila
    $("#tablaBovinos").on("click", ".borrarFila", function () {
        $(this).closest("tr").remove();
    });

    // Guardar nuevo vendedor
    $("#guardarVendedor").click(function () {
        const formData = $("#nuevoVendedorForm").serialize();
        $.ajax({
            url: "insertar_vendedor.php",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message);
                    $.getJSON("obtener_vendedor.php", function (vendedores) {
                        let options = '<option value="">Seleccione un vendedor</option>';
                        vendedores.forEach(vendedor => {
                            options += `<option value="${vendedor.id}">${vendedor.nombre} - ${vendedor.razon_social}</option>`;
                        });
                        $("#vendedor").html(options);
                    });
                    $("#nuevoVendedorModal").modal("hide");
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("Error en la solicitud: " + error);
            }
        });
    });
});
</script>
</body>
</html>
