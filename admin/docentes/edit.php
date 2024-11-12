<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL GRADO A TRAVES DE LA URL
$id_docente = $_GET['id'];

// INCLUIMOS EL CONTROLLER DE DOCENTES
include('../../app/controller/docentes/datos_de_docentes.php');

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
                    <div class="card card-outline card-success" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Modificar datos del docente</h3>
                            <div class="card-tools">
                                <!-- VOLVER -->
                                <a type="button" class="btn btn-secondary" href="<?= APP_URL; ?>/admin/docentes">
                                    Volver
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controller/docentes/updateController.php" method="post">
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
                                            <input type="text" value="<?= $nombres; ?>" name="nombres" class="form-control" required>
                                            <input type="text" value="<?= $id_usuario; ?>" name="id_usuario" class="form-control" hidden>
                                            <input type="text" value="<?= $id_docente; ?>" name="id_docente" class="form-control" hidden>
                                            <input type="text" value="<?= $id_persona; ?>" name="id_persona" class="form-control" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label><b> * </b>
                                            <input type="text" value="<?= $apellidos; ?>" name="apellidos" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dni">Documento</label><b> * </b>
                                            <input type="number" value="<?= $dni; ?>" name="dni" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento</label><b> * </b>
                                            <input type="date" value="<?= $fecha_nacimiento; ?>" name="fecha_nacimiento" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profesion">Profesión</label><b> * </b>
                                            <input type="text" value="<?= $profesion; ?>" name="profesion" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="especialidad">Especialidad</label><b> * </b>
                                            <input type="text" value="<?= $especialidad; ?>" name="especialidad" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="antiguedad">Antiguedad</label><b> * </b>
                                            <input type="text" value="<?= $antiguedad; ?>" name="antiguedad" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Correo</label><b> * </b>
                                            <input type="email" value="<?= $email; ?>" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="celular">Célular</label><b> * </b>
                                            <input type="number" value="<?= $celular; ?>" name="celular" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label><b> * </b>
                                            <input type="address" value="<?= $direccion; ?>" name="direccion" class="form-control" required>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <center>
                                                <button type="submit" class="btn btn-success">Modificar</button>
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