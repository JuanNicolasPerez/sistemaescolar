<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL NIVEL A TRAVES DE LA URL
$id_nivel = $_GET['id'];

// INCLUIMOS EL CONTROLLER DE NIVELES
include('../../app/controller/niveles/showController.php');
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
                        <li class="breadcrumb-item active">Panel Nivel Escolar</li>
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
                    <div class="card card-outline card-info" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Vista datos del Nivel</h3>
                            <div class="card-tools">

                            </div>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="gestion">Gestion Educativa</label>
                                        <select name="gestion_id" class="form-control" disabled>
                                            <option value=""><?= $gestion; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nivel">Nivel Educativo</label>
                                        <select name="nivel" class="form-control" disabled>
                                            <option value=""><?= $nivel_edu; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="turno">Turno</label>
                                        <select name="turno" class="form-control" disabled>
                                            <option value=""><?= $turno; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fyh_creacion">Fecha y hora de creacion</label>
                                        <input type="text" name="fyh_creacion" class="form-control" value="<?= $fyh_creacion; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        <select name="estado" class="form-control" disabled>
                                            <?php
                                            if ($estado == 1) {
                                            ?>
                                                <option>ACTIVO</option>
                                            <?php
                                            } else {
                                            ?>
                                                <option>INACTIVO</option>
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
                                            <a href="<?= APP_URL; ?>/admin/niveles" type="button" class="btn btn-secondary">Volver</a>
                                        </center>
                                    </div>
                                </div>
                            </div>

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