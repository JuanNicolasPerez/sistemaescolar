<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL ADMINISTRATIVO A TRAVES DE LA URL
$id_administrativo = $_GET['id'];

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ADMINISTRATIVO
include('../../app/controller/administrativos/datos_administrativos.php');

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
                        <li class="breadcrumb-item active">Panel Administrativo</li>
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
                            <h3 class="card-title">Modificar datos administrativos</h3>
                            <div class="card-tools">
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controller/administrativos/updateController.php" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                            <a href="<?= APP_URL; ?>/admin/roles/create.php" class="btn btn-primary btn-sm" style="margin-left: 15px;">
                                                    <i class="bi bi-file-plus"></i>
                                                </a>
                                            <div class="form-inline">
                                                <select name="rol_id" class="form-control">
                                                    <?php
                                                        foreach ($roles as $rol) {                                                            
                                                    ?>
                                                    <option value="<?= $rol['id_rol']; ?>" 
                                                            <?php if ($nombre_rol==$rol['nombres_rol']) {?>
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
                                            <label for="nombres">Nombres</label>
                                            <input type="text" name="id_persona" value="<?= $id_persona; ?>" class="form-control" hidden>
                                            <input type="text" name="id_usuario" value="<?= $id_usuario; ?>" class="form-control" hidden>
                                            <input type="text" name="id_administrativo" value="<?= $id_administrativo; ?>" class="form-control" hidden>
                                            <input type="text" name="nombres" value="<?= $nombres; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label>
                                            <input type="text" name="apellidos" value="<?= $apellidos; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dni">Documento</label>
                                            <input type="number" name="dni" value="<?= $dni; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" value="<?= $fecha_nacimiento; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="celular">Célular</label>
                                            <input type="number" name="celular" value="<?= $celular; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profesion">Profesión</label>
                                            <input type="text" name="profesion" value="<?= $profesion; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email">Correo</label>
                                            <input type="email" name="email" value="<?= $email; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="address" name="direccion" value="<?= $direccion; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <center>
                                            <button type="submit" class="btn btn-success">Modificar</button>
                                                <a href="<?= APP_URL; ?>/admin/administrativos" type="button" class="btn btn-secondary">Volver</a>
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