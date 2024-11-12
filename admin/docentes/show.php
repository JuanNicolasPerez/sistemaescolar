<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL GRADO A TRAVES DE LA URL
$id_docente = $_GET['id'];

// INCLUIMOS EL CONTROLLER DE DOCENTES
include('../../app/controller/docentes/datos_de_docentes.php');

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
                        <li class="breadcrumb-item active">Panel de docentes</li>
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
                <div class="col-md-12">
                    <div class="card card-outline card-info" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Datos del docente</h3>
                            <div class="card-tools">
                                <!-- VOLVER -->
                                <a type="button" class="btn btn-secondary" href="<?= APP_URL; ?>/admin/docentes">
                                    Volver
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nombre del rol</label>
                                        <div class="form-inline">
                                            <select name="id_rol" id="" class="form-control" disabled>
                                                <option>
                                                    <?= $nombres_rol; ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" value="<?= $nombres; ?>" name="nombres" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" value="<?= $apellidos; ?>" name="apellidos" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dni">Documento</label>
                                        <input type="number" value="<?= $dni; ?>" name="dni" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                        <input type="date" value="<?= $fecha_nacimiento; ?>" name="fecha_nacimiento" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="profesion">Profesión</label>
                                        <input type="text" value="<?= $profesion; ?>" name="profesion" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="especialidad">Especialidad</label>
                                        <input type="text" value="<?= $especialidad; ?>" name="especialidad" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="antiguedad">Antiguedad</label>
                                        <input type="text" value="<?= $antiguedad; ?>" name="antiguedad" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Correo</label>
                                        <input type="email" value="<?= $email; ?>" name="email" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="celular">Célular</label>
                                        <input type="number" value="<?= $celular; ?>" name="celular" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="address" value="<?= $direccion; ?>" name="direccion" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fyh_creacion">Fecha y hora de creacion</label>
                                        <input type="text" name="fyh_creacion" class="form-control" value="<?= $fyh_creacion; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
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
                                            <a href="<?= APP_URL; ?>/admin/docentes" type="button" class="btn btn-secondary">Volver</a>
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