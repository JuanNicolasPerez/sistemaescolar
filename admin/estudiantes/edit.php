<?php
//CONEXION BASE DE DATOS 
include('../../app/config.php');

//  CABECERA DE  PAGINA 
include('../../admin/layout/parte1.php');

// OBTENEMOS EL ID DEL GRADO A TRAVES DE LA URL
$id_estudiante = $_GET['id'];

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ESTUDIANTES
include('../../app/controller/estudiantes/datos_estudiantes.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER ROLES
include('../../app/controller/roles/listado_de_roles.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER NIVELES
include('../../app/controller/niveles/listado_de_niveles.php');

//TRAEMOS LOS DATOS DESDE EL CONTROLLER GRADOS
include('../../app/controller/grados/listado_de_grados.php');
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
                        <li class="breadcrumb-item active">Panel del estudiante</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="<?= APP_URL; ?>/app/controller/estudiantes/updateController.php" method="post">
                <!-- DATOS DEL ESTUDIANTE -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-success" style="background: #d3d2d2">
                            <div class="card-header">
                                <h3 class="card-title">Datos del estudiante</h3>
                                <div class="card-tools">
                                    <!-- IDENTIFICADORES -->
                                    <input type="text" class="form-control" name="id_usuario" value="<?= $id_usuario; ?>" hidden>
                                    <input type="text" class="form-control" name="id_persona" value="<?= $id_persona; ?>" hidden>
                                    <input type="text" class="form-control" name="id_estudiante" value="<?= $id_estudiante; ?>" hidden>
                                    <input type="text" class="form-control" name="id_ppff" value="<?= $id_ppff; ?>" hidden>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nombre del rol</label>
                                                <select name="rol_id" id="" class="form-control">
                                                <?php
                                                    foreach ($roles as $rol) {
                                                ?>
                                                        <option value="<?= $rol['id_rol']; ?>"
                                                            <?php if ($rol['nombres_rol'] == 'ESTUDIANTE') { ?>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombres">Nombres</label><b> * </b>
                                            <input type="text" name="nombres" value="<?= $nombres; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="apellidos">Apellidos</label><b> * </b>
                                            <input type="text" name="apellidos" value="<?= $apellidos; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dni">Documento</label><b> * </b>
                                            <input type="number" name="dni" value="<?= $dni; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de nacimiento</label><b> * </b>
                                            <input type="date" name="fecha_nacimiento" value="<?= $fecha_nacimiento; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="email">Correo</label><b> * </b>
                                            <input type="email" name="email" value="<?= $email; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label><b> * </b>
                                            <input type="address" name="direccion" value="<?= $direccion; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="celular">Célular</label><b> * </b>
                                            <input type="number" name="celular" value="<?= $celular; ?>" class="form-control" required>
                                        </div>
                                    </div>
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
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- DATOS ACADEMICOS -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-success" style="background: #d3d2d2">
                            <div class="card-header">
                                <h3 class="card-title">Datos curriculares</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nivel</label><b> * </b>
                                            <select name="nivel_id" id="" class="form-control">
                                                <?php
                                                foreach ($niveles as $nivele) {
                                                ?>
                                                    <option value="<?= $nivele['id_nivel']; ?>"
                                                        <?php if ($nivele['id_nivel'] == $nivel_id) { ?>
                                                                    selected="selected"
                                                        <?php } ?>>
                                                        <?= $nivele['nivel'] . " - " . $nivele['turno']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="grado">Grado</label><b> * </b>
                                            <select name="grado_id" id="" class="form-control">
                                                <?php
                                                foreach ($grados as $grado) {
                                                ?>
                                                    <option value="<?= $grado['id_grado']; ?>"
                                                        <?php if ($grado['id_grado']== $grado_id) { ?>
                                                                    selected="selected"
                                                        <?php } ?>>
                                                        <?= $grado['curso'] . " - " . $grado['paralelo']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="legajo">Legajo</label><b> * </b>
                                            <input type="text" name="legajo" value="<?= $legajo; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- DATOS DE LOS PADRES -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-success" style="background: #d3d2d2">
                            <div class="card-header">
                                <h3 class="card-title">Datos de los tutores</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre_apellidos">Apellido y nombre</label><b> * </b>
                                            <input type="text" name="nombre_apellidos" value="<?= $nombre_apellidos; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="dni_ppff">Documento</label><b> * </b>
                                            <input type="number" name="dni_ppff" value="<?= $dni_ppff; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="celular_ppff">Célular</label><b> * </b>
                                            <input type="number" name="celular_ppff" value="<?= $celular_ppff; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="ocupacion">Profesión</label><b> * </b>
                                            <input type="text" name="ocupacion" value="<?= $ocupacion; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- DATOS DE LA PERSONA AUTORIZADA -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-success" style="background: #d3d2d2">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la persona autorizada</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ref_nombre">Apellido y nombre</label><b> * </b>
                                            <input type="text" name="ref_nombre" value="<?= $ref_nombre; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ref_parentezco">Parentezco</label><b> * </b>
                                            <input type="text" name="ref_parentezco" value="<?= $ref_parentezco; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="ref_celular">Celular</label><b> * </b>
                                            <input type="number" name="ref_celular" value="<?= $ref_celular; ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  MODIFICAR -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-success">Actualizar</button>
                                <a href="<?= APP_URL; ?>/admin/estudiantes" type="button" class="btn btn-secondary">Volver</a>
                            </center>
                        </div>
                    </div>
                </div>
            </form>
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