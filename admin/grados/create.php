<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// INCLUIMOS EL CONTROLLER DE NIVELES
include('../../app/controller/niveles/listado_de_niveles.php');
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
                        <li class="breadcrumb-item active">Panel Grado Escolar</li>
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
                    <div class="card card-outline card-primary" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Crear un nuevo Grado</h3>
                            <div class="card-tools">
                                <!-- VOLVER -->
                                <a type="button" class="btn btn-secondary" href="<?= APP_URL; ?>/admin/grados">
                                    Volver
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controller/grados/createController.php" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nivel_id">Nivel Educativa</label>
                                            <select name="nivel_id" class="form-control" required>
                                            <?php
                                                foreach ($niveles as $nivel) {
                                                    ?>
                                                        <option value="<?=$nivel['id_nivel']?>">
                                                            <?=$nivel['nivel']." - ".$nivel['turno']?>
                                                        </option>
                                                    <?php
                                                }
                                            ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="curso">Curso Educativo</label>
                                            <select name="curso" class="form-control" required>                                               
                                                <!-- JARDIN -->
                                                <option value="SALA 3">SALA 3</option>
                                                <option value="SALA 4">SALA 4</option>
                                                <option value="SALA 5">SALA 5</option>
                                                <!-- PRIMARIA -->
                                                <option value="GRADO 1">GRADO 1</option>
                                                <option value="GRADO 2">GRADO 2</option>
                                                <option value="GRADO 3">GRADO 3</option>
                                                <option value="GRADO 4">GRADO 4</option>
                                                <option value="GRADO 5">GRADO 5</option>
                                                <option value="GRADO 6">GRADO 6</option>
                                                <option value="GRADO 7">GRADO 7</option>
                                                <!-- SECUNDARIA -->
                                                <option value="GRADO 1">GRADO 1</option>
                                                <option value="GRADO 2">GRADO 2</option>
                                                <option value="GRADO 3">GRADO 3</option>
                                                <option value="GRADO 4">GRADO 4</option>
                                                <option value="GRADO 5">GRADO 5</option>
                                                <option value="GRADO 6">GRADO 6</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="paralelo">Salón</label>
                                            <select name="paralelo" class="form-control" required>
                                                <option value="SALON - A">SALON - A</option>
                                                <option value="SALON - B">SALON - B</option>
                                                <option value="SALON - C">SALON - C</option>
                                                <option value="SALON - C">SALON - C</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <center>
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                                <a href="<?= APP_URL; ?>/admin/grados" type="button" class="btn btn-secondary">Cancelar</a>
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