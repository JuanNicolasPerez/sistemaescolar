<?php
//CONEXION BASE DE DATOS 
include('../app/config.php');

//  CABECERA DE  PAGINA 
include('../admin/layout/parte1.php');

//CONTROLADORES
include('../app/controller/roles/listado_de_roles.php');
include('../app/controller/usuarios/indexController.php');
include('../app/controller/niveles/listado_de_niveles.php');
include('../app/controller/grados/listado_de_grados.php');
include('../app/controller/materias/listado_de_materias.php');
include('../app/controller/administrativos/listado_de_administrativos.php');
include('../app/controller/docentes/listado_de_docentes.php');
include('../app/controller/estudiantes/listado_de_estudiantes.php');
?>

<!-- CUERPO DE PAGINA -->
<div class="content-wrapper" style="background: #d3d2d2;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Panel Principal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Panel Principal</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <?php
            if ($rol_session_usuario == "ESTUDIANTE") {
                foreach ($estudiantes as $estudiante) {
                    if ($email_sesion == $estudiante['email']) {
                        $id_estudiante = $estudiante['id_estudiante'];
                        $nivel = $estudiante['nivel'];
                        $turno = $estudiante['turno'];
                        $curso = $estudiante['curso'];
                        $paralelo = $estudiante['paralelo'];
                        $legajo = $estudiante['legajo'];
                    }
                }
            ?>
                <!-- VISTA PARA EL ESTUDIANTE -->
                <div class="content">
                    <div class="container-fluid">
                        <!-- DATOS DEL ESTUDIANTE -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info" style="background: #d3d2d2">
                                    <div class="card-header">
                                        <h3 class="card-title">Datos del estudiante</h3>
                                        <div class="card-tools">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- DATOS DEL ESTUDIANTE -->
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombres">Nombres</label>
                                                            <input type="text" name="nombres" value="<?= $nombres_session_usuario; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="apellidos">Apellidos</label>
                                                            <input type="text" name="apellidos" value="<?= $apellidos_session_usuario; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="dni">Documento</label>
                                                            <input type="number" name="dni" value="<?= $dni_session_usuario; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                                            <input type="date" name="fecha_nacimiento" value="<?= $fecha_nacimiento_session_usuario; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="celular">Célular</label>
                                                            <input type="number" name="celular" value="<?= $celular_session_usuario; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="fyh_creacion">Fecha y hora de creacion</label>
                                                            <input type="text" name="fyh_creacion" class="form-control" value="<?= $fyh_creacion_session_usuario; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Correo</label>
                                                            <input type="email" name="email" value="<?= $email_session_usuario; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="address" name="direccion" value="<?= $direccion_session_usuario; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <!-- REPORTES-->
                                                    <div class="col-md-12 col-sm-6 col-12">
                                                        <div class="info-box">
                                                            <span class="info-box-icon bg-primary">
                                                                <i class="far fa">
                                                                    <i class="bi bi-hospital"></i>
                                                                </i>
                                                            </span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text">
                                                                    <b>
                                                                        Reportes del Kardex
                                                                    </b>
                                                                </span>
                                                                <a href="<?= APP_URL; ?>/admin/kardex/reporte_estudiante.php?id_estudiante=<?= $id_estudiante; ?>" class="btn btn-primary btm-sm">Ingresar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- CALIFICACIONES -->
                                                    <div class="col-md-12 col-sm-6 col-12">
                                                        <div class="info-box">
                                                            <span class="info-box-icon bg-info">
                                                                <i class="far fa">
                                                                    <i class="bi bi-calendar-range"></i>
                                                                </i>
                                                            </span>
                                                            <div class="info-box-content">
                                                                <span class="info-box-text">
                                                                    <b>
                                                                        Mis calificaciones
                                                                    </b>
                                                                </span>
                                                                <a href="<?= APP_URL; ?>/admin/calificaciones/reporte_estudiante.php?id_estudiante=<?= $id_estudiante; ?>" class="btn btn-info btm-sm">Ingresar</a>
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
                                                <div class="card card-outline card-info" style="background: #d3d2d2">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Datos curriculares</h3>
                                                        <div class="card-tools">
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Nivel</label>
                                                                    <select name="nivel_id" id="" class="form-control" disabled>
                                                                        <option>
                                                                            <?= $nivel . " - " . $turno; ?>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="grado">Grado</label>
                                                                    <select name="grado_id" id="" class="form-control" disabled>
                                                                        <option>
                                                                            <?= $curso . " - " . $paralelo; ?>
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="legajo">Legajo</label>
                                                                    <input type="text" name="legajo" value="<?= $legajo; ?>" class="form-control" disabled>
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
                        </div>
                    </div>
                </div>
            <?php
            } elseif ($rol_session_usuario == "DOCENTE") {
                foreach ($docentes as $docente) {
                    if ($email_sesion == $docente['email']) {
                        $nombres = $docente['nombres'];
                        $apellidos = $docente['apellidos'];
                        $profesion = $docente['profesion'];
                        $especialidad = $docente['especialidad'];
                        $email = $docente['email'];
                        $direccion = $docente['direccion'];
                    }
                }
            ?>
                <!-- VISTA PARA EL DOCENTE -->
                <div class="content">
                    <div class="container-fluid">
                        <!-- DATOS DEL DOCENTE -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-info" style="background: #d3d2d2">
                                    <div class="card-header">
                                        <h3 class="card-title">Datos del docente</h3>
                                        <div class="card-tools">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- DATOS DEL DOCENTE -->
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombres">Nombres</label>
                                                            <input type="text" name="nombres" value="<?= $nombres; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="apellidos">Apellidos</label>
                                                            <input type="text" name="apellidos" value="<?= $apellidos; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="profesion">Profesion</label>
                                                            <input type="text" name="profesion" value="<?= $profesion; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="especialidad">Especialidad</label>
                                                            <input type="text" name="especialidad" value="<?= $especialidad; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Correo</label>
                                                            <input type="email" name="email" value="<?= $email; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="address" name="direccion" value="<?= $direccion; ?>" class="form-control" disabled>
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
                </div>
            <?php
            } elseif ($rol_session_usuario == "ADMINISTRADOR") {
            ?>
                <!-- VISTA PARA EL ADMINISTRADOR -->
                <div class="row">
                    <!-- ROLES -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <?php
                                $contador_rol = 0;
                                foreach ($roles as $rol) {
                                    $contador_rol = $contador_rol + 1;
                                }
                                ?>
                                <center>
                                    <h3><?= $contador_rol; ?></h3>
                                </center>
                                <p>Roles registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa">
                                    <i class="bi bi-bookmarks"></i>
                                </i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/roles" class="small-box-footer">
                                Más info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- USUARIOS -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <?php
                                $contador_usuarios = 0;
                                foreach ($usuarios as $usuario) {
                                    $contador_usuarios = $contador_usuarios + 1;
                                }
                                ?>
                                <center>
                                    <h3><?= $contador_usuarios; ?></h3>
                                </center>
                                <p>Usuarios registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa">
                                    <i class="bi bi-people-fill"></i>
                                </i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/usuarios" class="small-box-footer">
                                Más info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- NIVELES -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <?php
                                $contador_niveles = 0;
                                foreach ($niveles as $nivel) {
                                    $contador_niveles = $contador_niveles + 1;
                                }
                                ?>
                                <center>
                                    <h3><?= $contador_niveles; ?></h3>
                                </center>
                                <p>Niveles registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa">
                                    <i class="bi bi-bookshelf"></i>
                                </i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/niveles" class="small-box-footer">
                                Más info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- GRADOS -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <?php
                                $contador_grados = 0;
                                foreach ($grados as $grado) {
                                    $contador_grados = $contador_grados + 1;
                                }
                                ?>
                                <center>
                                    <h3><?= $contador_grados; ?></h3>
                                </center>
                                <p>Grados registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa">
                                    <i class="bi bi-bar-chart-steps"></i>
                                </i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/grados" class="small-box-footer">
                                Más info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- MATERIAS -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <?php
                                $contador_materias = 0;
                                foreach ($materias as $materia) {
                                    $contador_materias = $contador_materias + 1;
                                }
                                ?>
                                <center>
                                    <h3><?= $contador_materias; ?></h3>
                                </center>
                                <p>Materias registradas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa">
                                    <i class="bi bi-book-half"></i>
                                </i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/materias" class="small-box-footer">
                                Más info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- ADMINISTRATIVOS -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <?php
                                $contador_administrativos = 0;
                                foreach ($administrativos as $administrativo) {
                                    $contador_administrativos = $contador_administrativos + 1;
                                }
                                ?>
                                <center>
                                    <h3><?= $contador_administrativos; ?></h3>
                                </center>
                                <p>Administrativos registradas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa">
                                    <i class="bi bi-person-lines-fill"></i>
                                </i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/administrativos" class="small-box-footer">
                                Más info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- DOCENTES -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-default">
                            <div class="inner">
                                <?php
                                $contador_docentes = 0;
                                foreach ($docentes as $docente) {
                                    $contador_docentes = $contador_docentes + 1;
                                }
                                ?>
                                <center>
                                    <h3><?= $contador_docentes; ?></h3>
                                </center>
                                <p>Docentes registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa">
                                    <i class="bi bi-person-video3"></i>
                                </i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/docentes" class="small-box-footer">
                                Más info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- ESTUDIANTES -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <?php
                                $contador_estudiantes = 0;
                                foreach ($estudiantes as $estudiante) {
                                    $contador_estudiantes = $contador_estudiantes + 1;
                                }
                                ?>
                                <center>
                                    <h3><?= $contador_estudiantes; ?></h3>
                                </center>
                                <p>Estudiantes registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa">
                                    <i class="bi bi-person-workspace"></i>
                                </i>
                            </div>
                            <a href="<?= APP_URL; ?>/admin/estudiantes" class="small-box-footer">
                                Más info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                $sql = "SELECT * FROM usuarios AS usu
                        INNER JOIN roles AS rol
                        ON rol.id_rol = usu.rol_id
                        INNER JOIN personas AS per
                        ON per.usuario_id = usu.id_usuario
                        WHERE usu.estado = '1'
                        AND usu.email = '$email_sesion'";
                $sentence = $pdo->prepare($sql);
                $sentence->execute();

                $datos_usu = $sentence->fetchAll(PDO::FETCH_ASSOC);

                foreach ($datos_usu as $dato_usu) {
                    $dato_nombres = $dato_usu['nombres'];
                    $dato_apellidos = $dato_usu['apellidos'];
                    $dato_email = $dato_usu['email'];
                    $dato_direccion = $dato_usu['direccion'];
                }
            ?>
                <!-- VISTA PARA EL USUARIO -->
                <div class="content">
                    <div class="container-fluid">
                        <!-- DATOS DEL USUARIO -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-outline card-info" style="background: #d3d2d2">
                                    <div class="card-header">
                                        <h3 class="card-title">Datos del usuario</h3>
                                        <div class="card-tools">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- DATOS DEL USUARIO -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombres">Nombres</label>
                                                            <input type="text" name="nombres" value="<?= $dato_nombres; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="apellidos">Apellidos</label>
                                                            <input type="text" name="apellidos" value="<?= $dato_apellidos; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="email">Correo</label>
                                                            <input type="email" name="email" value="<?= $dato_email; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="address" name="direccion" value="<?= $dato_direccion; ?>" class="form-control" disabled>
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
                </div>
            <?php
            }
            ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php
//  PIE DE PAGINA 
include('../admin/layout/parte2.php');

// Mensajes de SESION
include('../layout/mensajes.php');
?>