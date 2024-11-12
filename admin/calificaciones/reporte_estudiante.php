<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

$id_estudiante = $_GET['id_estudiante'];


//TRAEMOS LOS DATOS DESDE EL CONTROLLER ESTUDIANTES
include('../../app/controller/estudiantes/listado_de_estudiantes.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER CALIFICACIONES
include('../../app/controller/calificaciones/listado_de_calificaciones.php');

$curso = 0;
$paralelo = 0;
foreach ($estudiantes as $estudiante) {
    if ($id_estudiante == $estudiante['id_estudiante']) {
        $curso = $estudiante['curso'];
        $paralelo = $estudiante['paralelo'];
        $nombres = $estudiante['nombres'];
        $apellidos = $estudiante['apellidos'];
    }
}
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
                        <li class="breadcrumb-item active">Panel de estudiantes</li>
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
                    <h3 class="card-title">Calificaciones del estudiantes</h3>
                    <div class="card-tools">
                        <!-- {{-- VOLVER --}} -->
                        <a type="button" class="btn btn-secondary" href="../index.php">
                            Volver
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped table-sm">
                        <caption>
                            Curso asignado:
                            <b>
                                <?= $curso . ", " . $paralelo ?>
                            </b>
                        </caption>
                        <thead class="thead">
                            <tr style="text-align: center">
                                <th>Nro</th>
                                <th>Apellido y nombre</th>
                                <th>Materia</th>
                                <th>1er trimestre</th>
                                <th>2do trimestre</th>
                                <th>3er trimestre</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $contador_estudiantes = 0;
                            foreach ($calificaciones as $calificacion) {
                                if ($id_estudiante == $calificacion['estudiante_id']) {
                                    $contador_estudiantes++;
                            ?>
                                    <tr>
                                        <td style="text-align: center">
                                            <?= $contador_estudiantes; ?>
                                        </td>
                                        <td style="text-align: center"><?= $apellidos . ", " . $nombres ?></td>
                                        <td style="text-align: center"><?= $calificacion['nombre_materia'] ?></td>

                                        <td style="text-align: center">
                                            <input style="text-align: center" type="number" value="<?=$calificacion['nota1']?>" class="form-control" disabled>
                                        </td>
                                        <td style="text-align: center">
                                            <input style="text-align: center" type="number" value="<?=$calificacion['nota2']?>" class="form-control" disabled>
                                        </td>
                                        <td style="text-align: center">
                                            <input style="text-align: center" type="number" value="<?=$calificacion['nota3']?>" class="form-control" disabled>
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
                                    "sInfo": "Mostrando  _START_ a _END_ de _TOTAL_ calificaciones",
                                    "sInfoEmpty": "Mostrando 0 a 0 de 0 calificaciones",
                                    "sInfoFiltered": "(filtrado de _MAX_ total calificaciones)",
                                    "sInfoPostFix": "",
                                    "thousands": ",",
                                    "sLengthMenu": "Mostrar _MENU_ calificaciones",
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