<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

$id_materia_get = $_GET['id_materia'];
$id_docente_get = $_GET['id_docente'];
$id_grado_get = $_GET['id_grado'];

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ESTUDIANTES
include('../../app/controller/estudiantes/listado_de_estudiantes.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER CALIFICACIONES
include('../../app/controller/calificaciones/listado_de_calificaciones.php');

$curso = 0;
$paralelo = 0;
foreach ($estudiantes as $estudiante) {
    if ($id_grado_get == $estudiante['id_grado']) {
        $curso = $estudiante['curso'];
        $paralelo = $estudiante['paralelo'];
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
                    <h3 class="card-title">Listado de los estudiantes</h3>
                    <div class="card-tools">
                        <!-- {{-- CREAR --}} -->
                        <a type="button" class="btn btn-secondary" href="index.php">
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
                                <th>Nivel</th>
                                <th>Turno</th>
                                <th>Grado</th>
                                <th>Salon</th>
                                <th>1er trimestre</th>
                                <th>2do trimestre</th>
                                <th>3er trimestre</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $contador_estudiantes = 0;
                            foreach ($estudiantes as $estudiante) {
                                if ($id_grado_get == $estudiante['id_grado']) {
                                    $contador_estudiantes++;
                                    $id_estudiante = $estudiante['id_estudiante'];
                            ?>
                                    <tr>
                                        <td style="text-align: center">
                                            <input type="text" value="<?= $id_estudiante; ?>" id="estudiante_<?= $contador_estudiantes; ?>" hidden>
                                            <?= $contador_estudiantes; ?>
                                        </td>
                                        <td style="text-align: center"><?= $estudiante['apellidos'] . ", " . $estudiante['nombres']; ?></td>
                                        <td style="text-align: center"><?= $estudiante['nivel']; ?></td>
                                        <td style="text-align: center"><?= $estudiante['turno']; ?></td>
                                        <td style="text-align: center"><?= $estudiante['curso']; ?></td>
                                        <td style="text-align: center"><?= $estudiante['paralelo']; ?></td>

                                        <?php
                                            $nota1 = "";
                                            $nota2 = "";
                                            $nota3 = "";

                                            foreach ($calificaciones as $calificacion) {
                                                if (($calificacion['docente_id'] == $id_docente_get) &&
                                                    ($calificacion['estudiante_id'] == $id_estudiante) &&
                                                    ($calificacion['materia_id'] == $id_materia_get)) {

                                                    $nota1 = $calificacion['nota1'];
                                                    $nota2 = $calificacion['nota2'];
                                                    $nota3 = $calificacion['nota3'];
                                                }
                                            }
                                        ?>
                                        <td style="text-align: center">
                                            <input style="text-align: center" id="nota1_<?=$contador_estudiantes?>" type="number" value="<?=$nota1?>" class="form-control">
                                        </td>
                                        <td style="text-align: center">
                                            <input style="text-align: center" id="nota2_<?=$contador_estudiantes?>"  type="number" value="<?=$nota2?>" class="form-control">
                                        </td>
                                        <td style="text-align: center">
                                            <input style="text-align: center" id="nota3_<?=$contador_estudiantes?>"  type="number" value="<?=$nota3?>" class="form-control">
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <button type="submit" class="btn btn-primary" id="btn_guardar">
                                    Subir Notas
                                </button>
                                <script>
                                    $('#btn_guardar').click(function(){
                                        var n = '<?= $contador_estudiantes ?>';
                                        var i = 1;
                                        var id_docente = '<?= $id_docente_get ?>';
                                        var id_materia = '<?= $id_materia_get ?>';

                                        for ( i = 1; i <=n; i++) {
                                            var a = '#nota1_'+i;
                                            var nota1 = $(a).val();

                                            var b = '#nota2_'+i;
                                            var nota2 = $(b).val();

                                            var c = '#nota3_'+i;
                                            var nota3 = $(c).val();

                                            var d = '#estudiante_'+i;
                                            var id_estudiante = $(d).val();

                                            var url = "../../app/controller/calificaciones/createController.php";
                                            $.get(url, {id_docente:id_docente,id_materia:id_materia,id_estudiante:id_estudiante,nota1:nota1,nota2:nota2,nota3:nota3},function(datos){
                                                $('#respuesta').html(datos);                                                
                                            });
                                        }

                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "Se actualizo de manera correcta.",
                                            showConfirmButton: false,
                                            timer: 3500
                                        });
                                    })
                                </script>
                            </center>

                        </div>
                    </div>
                    <div id="respuesta"></div>

                    <!-- Datatables Idioma Español-->
                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                "pageLenght": 10,
                                "language": {
                                    "semptyTable": "No hay informacion.",
                                    "sInfo": "Mostrando  _START_ a _END_ de _TOTAL_ estudiantes",
                                    "sInfoEmpty": "Mostrando 0 a 0 de 0 estudiantes",
                                    "sInfoFiltered": "(filtrado de _MAX_ total estudiantes)",
                                    "sInfoPostFix": "",
                                    "thousands": ",",
                                    "sLengthMenu": "Mostrar _MENU_ estudiantes",
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