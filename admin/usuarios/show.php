<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL USUARIO A TRAVES DE LA URL
$id_usuario = $_GET['id'];

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ROLES
include('../../app/controller/usuarios/showController.php');
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
                        <li class="breadcrumb-item active">Panel usuarios</li>
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
                            <h3 class="card-title">Vista usuario</h3>
                            <div class="card-tools">

                            </div>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nombre del rol</label>
                                        <div class="form-inline">
                                            <select name="id_rol" id="" class="form-control" disabled>
                                                <option value=""><?= $nombre_rol; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo</label>
                                        <input type="email" name="email" class="form-control" value="<?= $correo; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fechayhoracreacion">Fecha y hora de creación</label>
                                        <input type="text" name="fechayhoracreacion" class="form-control" value="<?= $fechayhoracreacion; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        <?php
                                        if ($estado == '1') {
                                        ?>
                                            <input type="text" name="estado" class="form-control" value="ACTIVO" disabled>
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" name="estado" class="form-control" value="INACTIVO" disabled>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <center>

                                            <a href="<?= APP_URL; ?>/admin/usuarios" type="button" class="btn btn-secondary">Volver</a>
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