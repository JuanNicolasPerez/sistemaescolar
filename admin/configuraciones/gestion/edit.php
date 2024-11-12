<?php
//CONEXION BASE DE DATOS 
include('../../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../../admin/layout/parte1.php');

//RECEPCIONAMOS EL ID A TRAVES DE LA RUTA
$id_gestion = $_GET['id'];

// ENVIAMOS EL ID AL CONTROLLER DE GESTION
include('../../../app/controller/configuraciones/gestion/datosController.php');

?>

<!-- CUERPO DE PAGINA -->
<div class="content-wrapper" style="background: #d7dfef;">
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
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-success" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Modificar Gestión</h3>
                            <div class="card-tools">
                                <!-- VOLVER -->
                                <a type="button" class="btn btn-secondary" href="<?= APP_URL; ?>/admin/configuraciones/gestion">
                                    Volver
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controller/configuraciones/gestion/updateController.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="gestion">Gestion Educativa</label>
                                            <input type="text" name="id_gestion" value="<?= $id_gestion; ?>" hidden>
                                            <input type="text" name="gestion" class="form-control" value="<?= $gestion_dato; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select name="estado" class="form-control" required>
                                            <?php
                                                if ($estado == 1) {
                                            ?>
                                                    <option value="ACTIVO">ACTIVO</option>
                                                    <option value="INACTIVO">INACTIVO</option>
                                            <?php
                                                }else{
                                            ?>
                                                    <option value="INACTIVO">INACTIVO</option>
                                                    <option value="ACTIVO">ACTIVO</option>
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <center>
                                                <button type="submit" class="btn btn-success">Modificar</button>
                                                <a href="<?= APP_URL; ?>/admin/configuraciones/gestion" type="button" class="btn btn-secondary">Cancelar</a>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
include('../../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../../layout/mensajes.php');
?>