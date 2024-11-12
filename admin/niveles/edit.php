<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL NIVEL A TRAVES DE LA URL
$id_nivel = $_GET['id'];

// INCLUIMOS EL CONTROLLER DE NIVELES
include('../../app/controller/niveles/showController.php');

// INCLUIMOS EL CONTROLLER DE GESTIONES
include('../../app/controller/configuraciones/gestion/listado_de_gestiones.php');
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
                    <div class="card card-outline card-success" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Modificar el Nivel</h3>
                            <div class="card-tools">

                            </div>
                        </div>

                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controller/niveles/updateController.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="gestion">Gestion Educativa</label>
                                            <input type="text" name="id_nivel" value="<?= $id_nivel; ?>" hidden>
                                            <select name="gestion_id" class="form-control" required>
                                                <?php
                                                foreach ($gestiones as $gestion) {
                                                    if ($gestion['estado'] == '1') {
                                                ?>
                                                        <option value="<?= $gestion['id_gestion'] ?>"
                                                            <?php if ($gestion_id == $gestion['id_gestion']) { ?>
                                                            <?php } ?> selected="selected">
                                                            <?= $gestion['gestion'] ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nivel">Nivel Educativo</label>
                                            <select name="nivel" class="form-control" required>
                                                <option value="INICIAL"
                                                    <?php if ($nivel_edu == 'INICIAL') { ?>
                                                    <?php } ?> selected="selected">
                                                    INICIAL
                                                </option>
                                                <option value="PRIMARIO" <?php if ($nivel_edu == 'PRIMARIO') { ?>
                                                    <?php } ?> selected="selected">
                                                    PRIMARIO
                                                </option>
                                                <option value="SECUNDARIO"
                                                    <?php if ($nivel_edu == 'SECUNDARIO') { ?>
                                                    <?php } ?> selected="selected">
                                                    SECUNDARIO
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="turno">Turno</label>
                                            <select name="turno" class="form-control" required>
                                                <option value="MAÑANA"
                                                    <?php if ($turno == 'MAÑANA') { ?>
                                                    <?php } ?> selected="selected">
                                                    MAÑANA
                                                </option>
                                                <option value="TARDE"
                                                    <?php if ($turno == 'TARDE') { ?>
                                                    <?php } ?> selected="selected">
                                                    TARDE
                                                </option>
                                                <option value="NOCHE"
                                                    <?php if ($turno == 'NOCHE') { ?>
                                                    <?php } ?> selected="selected">
                                                    NOCHE
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <center>
                                                <button type="submit" class="btn btn-success">Modificar</button>
                                                <a href="<?= APP_URL; ?>/admin/niveles" type="button" class="btn btn-secondary">Cancelar</a>
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
include('../../admin/layout/parte2.php');

// Mensajes de SESION
include('../../layout/mensajes.php');
?>