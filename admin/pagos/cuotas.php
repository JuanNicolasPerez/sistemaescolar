<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL ESTUDIANTE A TRAVES DE LA URL
$id_estudiante = $_GET['id'];

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ESTUDIANTES
include('../../app/controller/estudiantes/datos_estudiantes.php');
include('../../app/controller/pagos/datos_pago_estudiante.php');
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
                        <li class="breadcrumb-item active">Panel de aranceles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="container-fluid">
                    <div class="card card-outline card-primary" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Listado de los pagos</h3>
                            <div class="card-tools">
                                <!-- Button trigger modal REGISTRAR PAGO-->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Registrar Pago
                                </button>
                                <!-- Modal REGISTRAR PAGO-->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #0cd0e6;">
                                                <h5 class="modal-title" id="exampleModalLabel">Registrar pago</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= APP_URL; ?>/app/controller/pagos/createController.php" method="post">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Nombre del Estudiante</label>
                                                                <input type="text" name="nombre_estudiante" value="<?= $apellidos . ", " . $nombres; ?>" class="form-control" disabled>
                                                                <input type="text" name="estudiante_id" value="<?= $id_estudiante; ?>" class="form-control" hidden>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Documento del Estudiante</label>
                                                                <input type="text" name="dni" value="<?= $dni; ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Mes pagado</label>
                                                                <select name="mes_pagado" id="" class="form-control">
                                                                    <option value="ENERO">ENERO</option>
                                                                    <option value="FEBRERO">FEBRERO</option>
                                                                    <option value="MARZO">MARZO</option>
                                                                    <option value="ABRIL">ABRIL</option>
                                                                    <option value="MAYO">MAYO</option>
                                                                    <option value="JUNIO">JUNIO</option>
                                                                    <option value="JULIO">JULIO</option>
                                                                    <option value="AGOSTO">AGOSTO</option>
                                                                    <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                                                                    <option value="OCTUBRE">OCTUBRE</option>
                                                                    <option value="NOVIEMBRE">NOVIEMBRE</option>
                                                                    <option value="DICIEMBRE">DICIEMBRE</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Monto pagado</label>
                                                                <input type="text" name="monto_pagado" value="0" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Fecha de paga</label>
                                                                <input type="date" name="fecha_pagado" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <center>
                                                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                                                    <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                    <tr>
                                        <th style="text-align: center;">Nro</th>
                                        <th style="text-align: center;">Mes cancelado</th>
                                        <th style="text-align: center;">Monto</th>
                                        <th style="text-align: center;">Fecha de pago</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_pagos = 0;
                                    foreach ($pagos as $pago) {
                                        $contador_pagos++;
                                        $id_pago = $pago['id_pago'];
                                        $estudiante_id = $pago['estudiante_id'];
                                    ?>
                                        <tr>
                                            <td style="text-align: center"><?= $contador_pagos; ?></td>
                                            <td style="text-align: center"><?= $pago['mes_pagado']; ?></td>
                                            <td style="text-align: center"><?= $pago['monto_pagado']; ?></td>
                                            <td style="text-align: center"><?= $pago['fecha_pagado']; ?></td>

                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <!-- {{-- IMPRIMIR PAGO --}} -->
                                                    <a type="button" class="btn btn-warning" target="_blank" href="comprobante_pago.php?id=<?= $id_pago; ?>&&id_estudiante=<?= $estudiante_id; ?>">
                                                        <i class="fa fa-fw bi bi-printer"></i>
                                                    </a>

                                                    <!-- {{-- EDITAR --}} -->
                                                    <a type="button" class="btn btn-success" data-toggle="modal" data-target="#Modal_pagos<?= $id_pago; ?>">
                                                        <i class="fa fa-fw fa-edit"></i>
                                                    </a>
                                                    <!-- Modal  EDITAR-->
                                                    <div class="modal fade" id="Modal_pagos<?= $id_pago; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: green">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar pago</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="<?= APP_URL; ?>/app/controller/pagos/updateController.php" method="post">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Nombre del Estudiante</label>
                                                                                    <input type="text" name="nombre_estudiante" value="<?= $apellidos . ", " . $nombres; ?>" class="form-control" disabled>
                                                                                    <input type="text" name="estudiante_id" value="<?= $id_estudiante; ?>" class="form-control" hidden>
                                                                                    <input type="text" name="id_pago" value="<?= $id_pago; ?>" class="form-control" hidden>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Documento del Estudiante</label>
                                                                                    <input type="text" name="dni" value="<?= $dni; ?>" class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Mes pagado</label>
                                                                                    <select name="mes_pagado" id="" class="form-control">
                                                                                        <option value="ENERO" <?php $pago['mes_pagado'] == 'ENERO' ? 'selected' : '' ?>>ENERO</option>
                                                                                        <option value="FEBRERO" <?php $pago['mes_pagado'] == 'FEBRERO' ? 'selected' : '' ?>>FEBRERO</option>
                                                                                        <option value="MARZO" <?php $pago['mes_pagado'] == 'MARZO' ? 'selected' : '' ?>>MARZO</option>
                                                                                        <option value="ABRIL" <?php $pago['mes_pagado'] == 'ABRIL' ? 'selected' : '' ?>>ABRIL</option>
                                                                                        <option value="MAYO" <?php $pago['mes_pagado'] == 'MAYO' ? 'selected' : '' ?>>MAYO</option>
                                                                                        <option value="JUNIO" <?php $pago['mes_pagado'] == 'JUNIO' ? 'selected' : '' ?>>JUNIO</option>
                                                                                        <option value="JULIO" <?php $pago['mes_pagado'] == 'JULIO' ? 'selected' : '' ?>>JULIO</option>
                                                                                        <option value="AGOSTO" <?php $pago['mes_pagado'] == 'AGOSTO' ? 'selected' : '' ?>>AGOSTO</option>
                                                                                        <option value="SEPTIEMBRE" <?php $pago['mes_pagado'] == 'SEPTIEMBRE' ? 'selected' : '' ?>>SEPTIEMBRE</option>
                                                                                        <option value="OCTUBRE" <?php $pago['mes_pagado'] == 'OCTUBRE' ? 'selected' : '' ?>>OCTUBRE</option>
                                                                                        <option value="NOVIEMBRE" <?php $pago['mes_pagado'] == 'NOVIEMBRE' ? 'selected' : '' ?>>NOVIEMBRE</option>
                                                                                        <option value="DICIEMBRE" <?php $pago['mes_pagado'] == 'DICIEMBRE' ? 'selected' : '' ?>>DICIEMBRE</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Monto pagado</label>
                                                                                    <input type="text" name="monto_pagado" value="<?= $pago['monto_pagado']; ?>" class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="">Fecha de paga</label>
                                                                                    <input type="date" name="fecha_pagado" value="<?= $pago['fecha_pagado']; ?>" class="form-control" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <center>
                                                                                        <button type="submit" class="btn btn-success">Actualizar</button>
                                                                                        <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
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
                                                    <form action="<?= APP_URL; ?>/app/controller/pagos/deleteController.php" method="post"
                                                        onclick="preguntar<?= $id_pago; ?>(event)" id="miformulario<?= $id_pago; ?>">
                                                        <input type="text" name="id_pago" value="<?= $id_pago; ?>" hidden>
                                                        <button type="submit" class="btn btn-danger" style="border-radius: 0px 5px 5px 0px">
                                                            <i class="fa fa-fw fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <script>
                                                        function preguntar<?= $id_pago; ?>(event) {
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
                                                                    var form = $('#miformulario<?= $id_pago; ?>');
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
                                            "sInfo": "Mostrando  _START_ a _END_ de _TOTAL_ pagos",
                                            "sInfoEmpty": "Mostrando 0 a 0 de 0 pagos",
                                            "sInfoFiltered": "(filtrado de _MAX_ total pagos)",
                                            "sInfoPostFix": "",
                                            "thousands": ",",
                                            "sLengthMenu": "Mostrar _MENU_ pagos",
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
    </div>
</div>
<!-- /.content -->

<?php
//  PIE DE PAGINA 
include('../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../layout/mensajes.php');
?>