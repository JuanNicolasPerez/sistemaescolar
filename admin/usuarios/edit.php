<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL USUARIO A TRAVES DE LA URL
$id_usuario = $_GET['id'];

//TRAEMOS LOS DATOS DESDE EL CONTROLLER USUARIOS/ROLES
include('../../app/controller/usuarios/editController.php');
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
                    <div class="card card-outline card-success" style="background: #d3d2d2">
                        <div class="card-header">
                            <h3 class="card-title">Modificar un usuario</h3>
                            <div class="card-tools">
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controller/usuarios/updateController.php" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                            <div class="form-inline">
                                                <select name="rol_id" class="form-control">
                                                    <?php
                                                        foreach ($roles as $rol) {
                                                            $nombre_rol_tabla = $rol['nombres_rol'];
                                                    ?>
                                                    <option value="<?= $rol['id_rol']; ?>" 
                                                            <?php if ($nombre_rol_tabla == $nombre_rol) {?>
                                                                    selected="selected" 
                                                            <?php } ?>>
                                                        <?= $rol['nombres_rol']; ?>
                                                    </option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <a href="<?= APP_URL; ?>/admin/roles/create.php" class="btn btn-primary" style="margin-left: 15px;">
                                                    <i class="bi bi-file-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Correo</label>
                                            <input type="text" name="id_usuario" class="form-control" value="<?= $id_usuario; ?>" hidden>
                                            <input type="email" name="email" class="form-control" value="<?= $correo; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Contraseña</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_repeat">Contraseña verificar</label>
                                            <input type="password" name="password_repeat" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <center>
                                                <button type="submit" class="btn btn-success">Modificar</button>
                                                <a href="<?= APP_URL; ?>/admin/usuarios" type="button" class="btn btn-secondary">Cancelar</a>
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