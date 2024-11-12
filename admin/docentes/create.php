<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ROLES
include('../../app/controller/roles/listado_de_roles.php');
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
                    <div class="card card-outline card-primary" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Crear un nuevo docente</h3>
                            <div class="card-tools">
                                <!-- VOLVER -->
                                <a type="button" class="btn btn-secondary" href="<?= APP_URL; ?>/admin/docentes">
                                    Volver
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controller/docentes/createController.php" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                            <a href="<?= APP_URL; ?>/admin/roles/create.php" class="btn btn-primary btn-sm" style="margin-left: 15px;">
                                                <i class="bi bi-file-plus"></i>
                                            </a>
                                            <div class="form-inline">
                                                <select name="id_rol" id="" class="form-control">
                                                    <?php
                                                    foreach ($roles as $rol) {
                                                    ?>
                                                        <option value="<?= $rol['id_rol']; ?>"
                                                            <?php if ($rol['nombres_rol']=='DOCENTE') {?>
                                                                    selected="selected" 
                                                            <?php } ?>>
                                                            <?= $rol['nombres_rol']; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombres">Nombres</label><b> * </b>
                                            <input type="text" name="nombres" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label><b> * </b>
                                            <input type="text" name="apellidos" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dni">Documento</label><b> * </b>
                                            <input type="number" name="dni" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento</label><b> * </b>
                                            <input type="date" name="fecha_nacimiento" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profesion">Profesión</label><b> * </b>
                                            <input type="text" name="profesion" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="especialidad">Especialidad</label><b> * </b>
                                            <input type="text" name="especialidad" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="antiguedad">Antiguedad</label><b> * </b>
                                            <input type="text" name="antiguedad" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Correo</label><b> * </b>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="celular">Célular</label><b> * </b>
                                            <input type="number" name="celular" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label><b> * </b>
                                            <input type="address" name="direccion" class="form-control" required>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <center>
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                                <a href="<?= APP_URL; ?>/admin/docentes" type="button" class="btn btn-secondary">Cancelar</a>
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