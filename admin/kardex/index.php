<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER DOCENTES
include('../../app/controller/docentes/listado_de_asignaciones.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ESTUDIANTES
include('../../app/controller/estudiantes/listado_de_estudiantes.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER KARDEX
include('../../app/controller/kardex/listado_de_kardex.php');
?>

<!-- CUERPO DE PAGINA -->
<div class="content-wrapper" style="background: #d7dfef">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Panel de asignaciones</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary" style="background: #d3d2d2">
                <div class="card-header">
                    <h3 class="card-title">Grados asignados para reportes de Kardex</h3>
                    <div class="card-tools">
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="thead">
                            <tr style="text-align: center">
                                <th>Nro</th>
                                <th>Nivel</th>
                                <th>Turno</th>
                                <th>Grado</th>
                                <th>Salon</th>
                                <th>Materia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador = 0;
                            foreach ($asignaciones as $asignacion) {
                                $id_grado = $asignacion['id_grado'];
                                if ($email_sesion == $asignacion['email']) {
                                    $id_asignacion = $asignacion['id_asignacion'];
                                    $docente_id = $asignacion['id_docente'];
                                    $contador = $contador + 1;
                            ?>
                                    <tr>
                                        <td style="text-align: center"><?= $contador; ?></td>
                                        <td style="text-align: center"><?= $asignacion['nivel']; ?></td>
                                        <td style="text-align: center"><?= $asignacion['turno']; ?></td>
                                        <td style="text-align: center"><?= $asignacion['curso']; ?></td>
                                        <td style="text-align: center"><?= $asignacion['paralelo']; ?></td>
                                        <td style="text-align: center"><?= $asignacion['nombre_materia']; ?></td>
                                        <td>
                                            <!-- Boton Modal -->
                                            <center>
                                                <a data-toggle="modal" data-target="#exampleModal<?= $id_asignacion; ?>" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-check2-square"></i>
                                                    Reporte
                                                </a>
                                            </center>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?= $id_asignacion; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="background: #d3d2d2;">
                                                        <div class="modal-header" style="background: red;">
                                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">
                                                                Reporte del <?= $asignacion['curso']; ?> - <?= $asignacion['paralelo']; ?>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= APP_URL; ?>/app/controller/kardex/createController.php" method="post">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="fecha">Fecha</label>
                                                                            <input type="text" name="docente_id" value="<?= $docente_id ?>" hidden>
                                                                            <input type="date" name="fecha" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="estudiante_id">Estudiante</label>
                                                                            <select name="estudiante_id" class="form-control">
                                                                                <?php
                                                                                foreach ($estudiantes as $estudiante) {
                                                                                    if ($estudiante['id_grado'] == $asignacion['grado_id']) {
                                                                                        $id_estudiante = $estudiante['id_estudiante'];
                                                                                ?>
                                                                                        <option value="<?= $id_estudiante; ?>">
                                                                                            <?= $estudiante['apellidos']; ?>, <?= $estudiante['nombres']; ?>
                                                                                        </option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="materia">Materia</label>
                                                                            <input type="text" name="materia" class="form-control" value="<?= $asignacion['nombre_materia']; ?>" disabled>
                                                                            <input type="text" name="materia_id" class="form-control" value="<?= $asignacion['materia_id']; ?>" hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="observacion">Observación</label>
                                                                            <select name="observacion" class="form-control">
                                                                                <option value="DICIPLINA">DICIPLINA</option>
                                                                                <option value="ASISTENCIA">ASISTENCIA</option>
                                                                                <option value="RENDIMINETO">RENDIMINETO ACADÉMICO</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="nota">Nota</label>
                                                                            <textarea name="nota" cols="3" rows="5" class="form-control">
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer" style="justify-content: center;">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-danger">Registrar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-outline card-info" style="background: #d3d2d2">
                <div class="card-header">
                    <h3 class="card-title">Reportes de Kardex</h3>
                    <div class="card-tools">
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead class="thead">
                            <tr style="text-align: center">
                                <th>Nro</th>
                                <th>Nivel</th>
                                <th>Turno</th>
                                <th>Grado</th>
                                <th>Salon</th>
                                <th>Materia</th>
                                <th>Estudiante</th>
                                <th>Fecha reporte</th>
                                <th>Observación</th>
                                <th>Nota</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $contador_resporte = 0;
                            foreach ($kardexs as $kardex) {
                                if ($email_sesion == $kardex['email']) {
                                    $id_kardex = $kardex['id_kardex'];
                                    $estudiante_id = $kardex['estudiante_id'];
                                    $grado_id = $kardex['grado_id'];
                                    $contador_resporte = $contador_resporte + 1;
                            ?>
                                    <tr>
                                        <td style="text-align: center"><?= $contador_resporte; ?></td>
                                        <?php
                                        foreach ($estudiantes as $estudiante) {
                                            if ($estudiante['estudiante_id'] == $estudiante_id) {
                                        ?>
                                                <td style="text-align: center"><?= $estudiante['nivel']; ?></td>
                                                <td style="text-align: center"><?= $estudiante['turno']; ?></td>
                                                <td style="text-align: center"><?= $estudiante['curso']; ?></td>
                                                <td style="text-align: center"><?= $estudiante['paralelo']; ?></td>
                                                <td style="text-align: center"><?= $kardex['nombre_materia']; ?></td>
                                                <td style="text-align: center"><?= $estudiante['apellidos']; ?>, <?= $estudiante['nombres']; ?></td>
                                                <td style="text-align: center"><?= $kardex['fecha']; ?></td>
                                                <td style="text-align: center"><?= $kardex['observacion']; ?></td>
                                                <td style="text-align: center"><?= $kardex['nota']; ?></td>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <td>
                                            <!-- Boton Modal -->
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                    <a data-toggle="modal" data-target="#modal_editarr<?= $id_kardex; ?>" class="btn btn-success btn-sm">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <!-- {{-- ELIMINAR --}} -->
                                                    <form action="<?= APP_URL; ?>/app/controller/kardex/deleteController.php" method="post"
                                                        onclick="preguntar<?= $id_kardex; ?>(event)" id="miformulario<?= $id_kardex; ?>">
                                                        <input type="text" name="id_kardex" value="<?= $id_kardex; ?>" hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px">
                                                            <i class="fa fa-fw fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <script>
                                                        function preguntar<?= $id_kardex; ?>(event) {
                                                            event.preventDefault();
                                                            Swal.fire({
                                                                title: "Eliminar registro",
                                                                text: "¿Desea eliminar este registro?",
                                                                icon: 'question',
                                                                showDenyButton: true,
                                                                confirmButtonText: "Eliminar",
                                                                confirmButtonColor: '#a5151d',
                                                                denyButtonColor: '#270a0a',
                                                                denyButtonText: 'Cancelar',
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    var form = $('#miformulario<?= $id_kardex; ?>');
                                                                    form.submit();
                                                                }
                                                            });
                                                        }
                                                    </script>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal_editarr<?= $id_kardex; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="background: #d3d2d2;">
                                                        <div class="modal-header" style="background: green;">
                                                            <h5 class="modal-title" id="exampleModalLabel" style="color: white;">
                                                                Modificación del reporte
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="<?= APP_URL; ?>/app/controller/kardex/updateController.php" method="post">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="fecha">Fecha</label>

                                                                            <input type="text" name="id_kardex" value="<?= $id_kardex ?>" hidden>
                                                                            <input type="text" name="docente_id" value="<?= $docente_id ?>" hidden>
                                                                            <input type="date" name="fecha" value="<?= $kardex['fecha']; ?>" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="estudiante_id">Estudiante</label>
                                                                            <select name="estudiante_id" class="form-control">
                                                                                <?php
                                                                                foreach ($estudiantes as $estudiante) {
                                                                                    if ($estudiante['id_grado'] == $grado_id) {
                                                                                        $id_estudiante = $estudiante['id_estudiante'];
                                                                                ?>
                                                                                        <option value="<?= $id_estudiante; ?>"
                                                                                            <?= $id_estudiante == $estudiante_id ? 'selected' : '' ?>>
                                                                                            <?= $estudiante['apellidos']; ?>, <?= $estudiante['nombres']; ?>
                                                                                        </option>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="materia">Materia</label>
                                                                            <input type="text" name="materia" class="form-control" value="<?= $kardex['nombre_materia']; ?>" disabled>
                                                                            <input type="text" name="materia_id" class="form-control" value="<?= $kardex['materia_id']; ?>" hidden>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="observacion">Observación</label>
                                                                            <select name="observacion" class="form-control">
                                                                                <option value="DICIPLINA"
                                                                                    <?= $kardex['observacion'] == "DICIPLINA" ? 'selected' : '' ?>>
                                                                                    DICIPLINA
                                                                                </option>
                                                                                <option value="ASISTENCIA"
                                                                                <?= $kardex['observacion'] == "ASISTENCIA" ? 'selected' : '' ?>>
                                                                                    ASISTENCIA
                                                                                </option>
                                                                                <option value="RENDIMINETO"
                                                                                    <?= $kardex['observacion'] == "RENDIMINETO" ? 'selected' : '' ?>>
                                                                                    RENDIMINETO ACADÉMICO
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="nota">Nota</label>
                                                                            <textarea name="nota" cols="3" rows="5" class="form-control"><?= $kardex['nota']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer" style="justify-content: center;">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-success">Modificar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Datatables Idioma Español-->
                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                "pageLenght": 10,
                                "language": {
                                    "semptyTable": "No hay informacion.",
                                    "sInfo": "Mostrando  _START_ a _END_ de _TOTAL_ reportes",
                                    "sInfoEmpty": "Mostrando 0 a 0 de 0 reportes",
                                    "sInfoFiltered": "(filtrado de _MAX_ total reportes)",
                                    "sInfoPostFix": "",
                                    "thousands": ",",
                                    "sLengthMenu": "Mostrar _MENU_ reportes",
                                    "sLoadingRecords": "Cargando...",
                                    "sProcessing": "Procesando...",
                                    "sSearch": "Buscar:",
                                    "sZeroRecords": "No se encontraron resultados",

                                    "paginate": {
                                        "sFirst": "Primero",
                                        "sLast": "Último",
                                        "sNext": "Siguiente",
                                        "sPrevious": "Anterior"
                                    }
                                },

                                "responsive": true,
                                "lengthChange": true,
                                "autoWidth": false,
                                buttons: [{
                                        text: 'Reportes',
                                        extend: 'collection',
                                        orientation: 'landscape',

                                        buttons: [{
                                            text: 'Copiar',
                                            extend: 'copy'
                                        }, {
                                            text: '<button class="btn btn-danger btn-sm btn-block"><i class="bi bi-file-earmark-pdf-fill"></i> PDF </button>',
                                            extend: 'pdf'
                                        }, {
                                            text: '<button class="btn btn-info btn-sm btn-block"><i class="bi bi-filetype-csv"></i> CSV </button>',
                                            extend: 'csv'
                                        }, {
                                            text: '<button class="btn btn-success btn-sm btn-block"><i class="bi bi-file-earmark-excel-fill"></i> EXCEL </button>',
                                            extend: 'excel'
                                        }, {
                                            text: '<button class="btn btn-warning btn-sm btn-block"><i class="bi bi-printer-fill"></i> IMPRIMIR </button>',
                                            extend: 'print'
                                        }],
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fidex three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->

<?php
//  PIE DE PAGINA 
include('../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../layout/mensajes.php');
?>