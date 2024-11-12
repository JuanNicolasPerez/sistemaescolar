<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER DOCENTES
include('../../app/controller/docentes/listado_de_docentes.php');
include('../../app/controller/docentes/listado_de_asignaciones.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER NIVELES
include('../../app/controller/niveles/listado_de_niveles.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER GRADOS
include('../../app/controller/grados/listado_de_grados.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER MATERIAS
include('../../app/controller/materias/listado_de_materias.php');

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
                        <li class="breadcrumb-item active">Panel de docentes</li>
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
                    <h3 class="card-title">Personal de docentes asignados a las materias</h3>
                    <div class="card-tools">
                        <!-- MODAL ASIGNAR MATERIA -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Asignar materias
                            <i class="fa fa-fw bi bi-plus-square"></i>
                        </button>
                        <!-- MODAL ASIGNAR MATERIA -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #0c84FF;">
                                        <h5 class="modal-title" id="exampleModalLabel">Asignación de materias</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= APP_URL; ?>/app/controller/docentes/createAsignaciones.php" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Docentes</label>
                                                        <select name="id_docente" id="" class="form-control">
                                                            <?php
                                                            foreach ($docentes as $docente) {
                                                                $id_docente = $docente['id_docente'];
                                                            ?>
                                                                <option value="<?= $id_docente; ?>">
                                                                    <?= $docente['apellidos'] . ", " . $docente['nombres']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Niveles</label>
                                                        <select name="id_nivel" id="" class="form-control">
                                                            <?php
                                                            foreach ($niveles as $nivel) {
                                                                $id_nivel = $nivel['id_nivel'];
                                                            ?>
                                                                <option value="<?= $id_nivel; ?>">
                                                                    <?= $nivel['nivel'] . ", " . $nivel['turno']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Grados</label>
                                                        <select name="id_grado" id="" class="form-control">
                                                            <?php
                                                            foreach ($grados as $grado) {
                                                                $id_grado = $grado['id_grado'];
                                                            ?>
                                                                <option value="<?= $id_grado; ?>">
                                                                    <?= $grado['curso'] . ", " . $grado['paralelo']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Materias</label>
                                                        <select name="id_materia" id="" class="form-control">
                                                            <?php
                                                            foreach ($materias as $materia) {
                                                                $id_materia = $materia['id_materia'];
                                                            ?>
                                                                <option value="<?= $id_materia; ?>">
                                                                    <?= $materia['nombre_materia']; ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead class="thead">
                            <tr style="text-align: center">
                                <th>Nro</th>
                                <th>Apellido y nombre</th>
                                <th>Documento</th>
                                <th>Fecha de nacimiento</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Materias asignadas</th>
                            </tr>
                        </thead>
                        <!-- LISTADO DOCENTES -->
                        <tbody>
                            <?php
                            $contador_docentes = 0;
                            foreach ($docentes as $docente) {
                                $contador_docentes++;
                                $id_docente = $docente['id_docente'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><?= $contador_docentes; ?></td>
                                    <td style="text-align: center"><?= $docente['apellidos'] . ", " . $docente['nombres']; ?></td>
                                    <td style="text-align: center"><?= $docente['dni']; ?></td>
                                    <td style="text-align: center"><?= $docente['fecha_nacimiento']; ?></td>
                                    <td style="text-align: center"><?= $docente['email']; ?></td>

                                    <?php if ($docente['estado'] == "1") { ?>
                                        <td style="text-align: center">ACTIVO</td>
                                    <?php } ?>

                                    <td>
                                        <center>
                                            <!-- MODAL VER MATERIA -->
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalMaterias<?= $id_docente; ?>">
                                                Ver materias
                                                <i class="fa fa-fw bi bi-postcard"></i>
                                            </button>
                                        </center>
                                        <!-- MODAL VER MATERIA -->
                                        <div class="modal fade" id="modalMaterias<?= $id_docente; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #0c84FF;">
                                                        <h5 class="modal-title" id="exampleModalLabel">Materias asignadas</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="background: #d3d2d2">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table table-bordered table-striped table-sm">
                                                                    <caption>
                                                                        Docente:
                                                                        <b>
                                                                            <?= $docente['apellidos'] . ", " . $docente['nombres']; ?>
                                                                        </b>
                                                                    </caption>
                                                                    <thead class="thead">
                                                                        <tr style="text-align: center">
                                                                            <th>Nro</th>
                                                                            <th>Nivel</th>
                                                                            <th>Turno</th>
                                                                            <th>Grado</th>
                                                                            <th>Paralelo</th>
                                                                            <th>Materia</th>
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <!-- LISTADO DE MATERIAS ASIGNADAS -->
                                                                    <tbody>
                                                                        <?php
                                                                        $contador_asignaciones = 0;
                                                                        foreach ($asignaciones as $asignacion) {
                                                                            $id_asignacion = $asignacion['id_asignacion'];
                                                                            if ($asignacion['docente_id'] == $id_docente) {
                                                                                $contador_asignaciones++;
                                                                        ?>
                                                                                <tr>
                                                                                    <td style="text-align: center"><?= $contador_asignaciones; ?></td>
                                                                                    <td style="text-align: center"><?= $asignacion['nivel']; ?></td>
                                                                                    <td style="text-align: center"><?= $asignacion['turno']; ?></td>
                                                                                    <td style="text-align: center"><?= $asignacion['curso']; ?></td>
                                                                                    <td style="text-align: center"><?= $asignacion['paralelo']; ?></td>
                                                                                    <td style="text-align: center"><?= $asignacion['nombre_materia']; ?></td>
                                                                                    <td>
                                                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                                                            <center>
                                                                                                <!-- {{-- EDITAR --}} -->
                                                                                                <!-- MODAL EDITAR MATERIA -->
                                                                                                <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_editar<?= $id_asignacion; ?>">
                                                                                                    <i class="fa fa-fw fa-edit"></i>
                                                                                                </a>
                                                                                            </center>
                                                                                            <!-- MODAL EDITAR MATERIA-->
                                                                                            <div class="modal fade" id="modal_editar<?= $id_asignacion; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog">
                                                                                                    <div class="modal-content" style="background: #d3d2d2">
                                                                                                        <div class="modal-header" style="background-color: green;">
                                                                                                            <h5 class="modal-title" id="exampleModalLabel">Editar Materias asignadas</h5>
                                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                                <span aria-hidden="true">&times;</span>
                                                                                                            </button>
                                                                                                        </div>
                                                                                                        <form action="<?= APP_URL; ?>/app/controller/docentes/update_asignaciones.php" method="post">
                                                                                                            <div class="modal-body">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="form-group">
                                                                                                                            <input type="text" class="form-control" name="id_asignacion" value="<?= $id_asignacion; ?>" hidden>
                                                                                                                            <label for="">Niveles</label>
                                                                                                                            <select name="id_nivel" id="" class="form-control">
                                                                                                                                <?php
                                                                                                                                foreach ($niveles as $nivel) {
                                                                                                                                    $id_nivel = $nivel['id_nivel'];
                                                                                                                                ?>
                                                                                                                                    <option value="<?= $id_nivel; ?>"
                                                                                                                                        <?php if ($nivel['id_nivel'] == $asignacion['nivel_id']) { ?>
                                                                                                                                        selected="selected"
                                                                                                                                        <?php } ?>>
                                                                                                                                        <?= $nivel['nivel'] . ", " . $nivel['turno']; ?>
                                                                                                                                    </option>
                                                                                                                                <?php
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="">Grados</label>
                                                                                                                            <select name="id_grado" id="" class="form-control">
                                                                                                                                <?php
                                                                                                                                foreach ($grados as $grado) {
                                                                                                                                    $id_grado = $grado['id_grado'];
                                                                                                                                ?>
                                                                                                                                    <option value="<?= $id_grado; ?>"
                                                                                                                                        <?php if ($grado['id_grado'] == $asignacion['grado_id']) { ?>
                                                                                                                                        selected="selected"
                                                                                                                                        <?php } ?>>
                                                                                                                                        <?= $grado['curso'] . ", " . $grado['paralelo']; ?>
                                                                                                                                    </option>
                                                                                                                                <?php
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="form-group">
                                                                                                                            <label for="">Materias</label>
                                                                                                                            <select name="id_materia" id="" class="form-control">
                                                                                                                                <?php
                                                                                                                                foreach ($materias as $materia) {
                                                                                                                                    $id_materia = $materia['id_materia'];
                                                                                                                                ?>
                                                                                                                                    <option value="<?= $id_materia; ?>"
                                                                                                                                        <?php if ($materia['id_materia'] == $asignacion['materia_id']) { ?>
                                                                                                                                        selected="selected"
                                                                                                                                        <?php } ?>>
                                                                                                                                        <?= $materia['nombre_materia']; ?>
                                                                                                                                    </option>
                                                                                                                                <?php
                                                                                                                                }
                                                                                                                                ?>
                                                                                                                            </select>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-12">
                                                                                                                        <div class="form-group">
                                                                                                                            <center>
                                                                                                                                <button type="submit" class="btn btn-success">Modificar</button>
                                                                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                                                                                    Volver
                                                                                                                                </button>
                                                                                                                            </center>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- {{-- ELIMINAR --}} -->
                                                                                            <form action="<?= APP_URL; ?>/app/controller/docentes/delete_asignacion.php" method="post"
                                                                                                onclick="preguntar<?= $id_asignacion; ?>(event)" id="miformulario<?= $id_asignacion; ?>">
                                                                                                <input type="text" name="id_asignacion" value="<?= $id_asignacion; ?>" hidden>
                                                                                                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px">
                                                                                                    <i class="fa fa-fw fa-trash"></i>
                                                                                                </button>
                                                                                            </form>
                                                                                            <script>
                                                                                                function preguntar<?= $id_asignacion; ?>(event) {
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
                                                                                                            var form = $('#miformulario<?= $id_asignacion; ?>');
                                                                                                            form.submit();
                                                                                                        }
                                                                                                    });
                                                                                                }
                                                                                            </script>
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
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <center>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                            Volver
                                                                        </button>
                                                                    </center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
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
                                    "sInfo": "Mostrando  _START_ a _END_ de _TOTAL_ docentes",
                                    "sInfoEmpty": "Mostrando 0 a 0 de 0 docentes",
                                    "sInfoFiltered": "(filtrado de _MAX_ total docentes)",
                                    "sInfoPostFix": "",
                                    "thousands": ",",
                                    "sLengthMenu": "Mostrar _MENU_ docentes",
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