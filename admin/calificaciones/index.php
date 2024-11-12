<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER DOCENTES
include('../../app/controller/docentes/listado_de_asignaciones.php');
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
                    <h3 class="card-title">Grados asignados para calificaciones</h3>
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
                                        $contador = $contador + 1; 
                            ?>
                                        <tr>
                                            <td style="text-align: center"><?= $contador;?></td>
                                            <td style="text-align: center"><?= $asignacion['nivel'];?></td>
                                            <td style="text-align: center"><?= $asignacion['turno'];?></td>
                                            <td style="text-align: center"><?= $asignacion['curso'];?></td>
                                            <td style="text-align: center"><?= $asignacion['paralelo'];?></td>
                                            <td style="text-align: center"><?= $asignacion['nombre_materia'];?></td>
                                            <td style="text-align: center">
                                                <a href="create.php?id_grado=<?=$id_grado?>&&id_docente=<?= $asignacion['docente_id'];?>&&id_materia=<?= $asignacion['materia_id'];?>" 
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-check2-square"></i>
                                                    Subir notas
                                                </a>
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
</div>
<!-- /.content -->

<?php
//  PIE DE PAGINA 
include('../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../layout/mensajes.php');
?>