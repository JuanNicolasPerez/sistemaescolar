<?php
//CONEXION BASE DE DATOS 
include('../../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../../admin/layout/parte1.php');

// INCLUIMOS EL CONTROLLER DE GESTION
include('../../../app/controller/configuraciones/gestion/listado_de_gestiones.php');
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
                        <li class="breadcrumb-item active">Panel Gestion Escolar</li>
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
                    <h3 class="card-title">Gestion Escolar</h3>
                    <div class="card-tools">
                        <!-- {{-- CREAR --}} -->
                        <a type="button" class="btn btn-primary" href="create.php">
                            Crear
                            <i class="fa fa-fw bi bi-plus-square"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <thead class="thead">
                            <tr>
                                <th>Nro</th>
                                <th>Gestion</th>
                                <th>Fecha y hora de creacion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $contador_gestiones = 0;
                            foreach ($gestiones as $gestion) {
                                $contador_gestiones++;
                                $id_gestion  = $gestion['id_gestion'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><?= $contador_gestiones; ?></td>
                                    <td><?= $gestion['gestion']; ?></td>
                                    <td style="text-align: center"><?= $gestion['fyh_creacion']; ?></td>
                                    <td style="text-align: center">
                                        <?php
                                        if ($gestion['estado'] == '1') {
                                        ?>
                                            <button class="btn btn-success btn-sm" style="border-radius: 20px;">ACTIVO</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn btn-danger btn-sm" style="border-radius: 20px;">INACTIVO</button>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            <!-- {{-- MOSTRAR --}} -->
                                            <a type="button" class="btn btn-info" href="show.php?id=<?= $id_gestion; ?>">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>

                                            <!-- {{-- EDITAR --}} -->
                                            <a type="button" class="btn btn-success" href="edit.php?id=<?= $id_gestion; ?>">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>

                                            <!-- {{-- ELIMINAR --}} -->
                                            <!-- <form action="<?= APP_URL; ?>/app/controller/configuraciones/gestion/deleteController.php" method="post"
                                                onclick="preguntar<?= $id_gestion; ?>(event)" id="miformulario<?= $id_gestion; ?>">
                                                <input type="text" name="id_gestion" value="<?= $id_gestion; ?>" hidden>
                                                <button type="submit" class="btn btn-danger" style="border-radius: 0px 5px 5px 0px">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function preguntar<?= $id_gestion; ?>(event) {
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
                                                            var form = $('#miformulario<?= $id_gestion; ?>');
                                                            form.submit();
                                                        }
                                                    });
                                                }
                                            </script> -->
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
                                    "sInfo": "Mostrando  _START_ a _END_ de _TOTAL_ gestiones",
                                    "sInfoEmpty": "Mostrando 0 a 0 de 0 gestiones",
                                    "sInfoFiltered": "(filtrado de _MAX_ total gestiones)",
                                    "sInfoPostFix": "",
                                    "thousands": ",",
                                    "sLengthMenu": "Mostrar _MENU_ gestiones",
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
include('../../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../../layout/mensajes.php');
?>