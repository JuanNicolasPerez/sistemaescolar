<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ADMINISTRATIVOS
include('../../app/controller/administrativos/listado_de_administrativos.php');

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
                        <li class="breadcrumb-item active">Panel Administrativo</li>
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
                    <h3 class="card-title">Personal administrativo</h3>
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
                            <tr style="text-align: center">
                                <th>Nro</th>
                                <th>Cargo</th>
                                <th>Apellido y nombre</th>
                                <th>Documento</th>
                                <th>Profesión</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $contador_administrativo = 0;
                            foreach ($administrativos as $administrativo) {
                                $contador_administrativo++;
                                $id_administrativo = $administrativo['id_administrativo'];
                            ?>
                                <tr>
                                    <td style="text-align: center"><?= $contador_administrativo; ?></td>
                                    <td style="text-align: center"><?= $administrativo['nombres_rol']; ?></td>
                                    <td style="text-align: center"><?= $administrativo['apellidos'].", ".$administrativo['nombres']; ?></td>
                                    <td style="text-align: center"><?= $administrativo['dni']; ?></td>
                                    <td style="text-align: center"><?= $administrativo['profesion']; ?></td>
                                    <td style="text-align: center"><?= $administrativo['email']; ?></td>
                                    <?php if($administrativo['estado'] == "1"){ ?>
                                        <td style="text-align: center">ACTIVO</td>
                                    <?php } ?>

                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            <!-- {{-- MOSTRAR --}} -->
                                            <a type="button" class="btn btn-info" href="show.php?id=<?= $id_administrativo; ?>">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>

                                            <!-- {{-- EDITAR --}} -->
                                            <a type="button" class="btn btn-success" href="edit.php?id=<?= $id_administrativo; ?>">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>

                                            <!-- {{-- ELIMINAR --}} -->
                                            <!-- <form action="<?= APP_URL; ?>/app/controller/administrativos/deleteController.php" method="post"
                                            onclick="preguntar<?= $id_administrativo; ?>(event)" id="miformulario<?=$id_administrativo;?>">
                                                <input type="text" name="id_administrativo" value="<?= $id_administrativo; ?>" hidden>
                                                <button type="submit" class="btn btn-danger" style="border-radius: 0px 5px 5px 0px">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function preguntar<?= $id_administrativo; ?>(event) {
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
                                                            var form = $('#miformulario<?=$id_administrativo;?>');
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
                                    "sInfo": "Mostrando  _START_ a _END_ de _TOTAL_ administrativos",
                                    "sInfoEmpty": "Mostrando 0 a 0 de 0 administrativos",
                                    "sInfoFiltered": "(filtrado de _MAX_ total administrativos)",
                                    "sInfoPostFix": "",
                                    "thousands": ",",
                                    "sLengthMenu": "Mostrar _MENU_ administrativos",
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