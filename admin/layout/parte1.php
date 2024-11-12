    <?php
    // SESION MENSAJE
    session_start();


    if (isset($_SESSION['session_email'])) {
        $email_sesion = $_SESSION['session_email'];
        $query_session = $pdo->prepare("SELECT * FROM usuarios AS usu
                                            INNER JOIN roles AS rol
                                            ON rol.id_rol = usu.rol_id
                                            INNER JOIN personas AS pers
                                            WHERE usu.email = '$email_sesion' AND usu.estado = '1'");
        $query_session->execute();

        $datos_session_usuarios = $query_session->fetchAll(PDO::FETCH_ASSOC);

        foreach ($datos_session_usuarios as $datos_session_usuario) {
            $email_session_usuario = $datos_session_usuario['email'];
            $nombre_session_usuario = $datos_session_usuario['email'];
            $id_rol_session_usuario = $datos_session_usuario['id_rol'];
            $rol_session_usuario = $datos_session_usuario['nombres_rol'];
            $nombres_session_usuario = $datos_session_usuario['nombres'];
            $apellidos_session_usuario = $datos_session_usuario['apellidos'];
            $direccion_session_usuario = $datos_session_usuario['direccion'];
            $celular_session_usuario = $datos_session_usuario['celular'];
            $fecha_nacimiento_session_usuario = $datos_session_usuario['fecha_nacimiento'];
            $fyh_creacion_session_usuario = $datos_session_usuario['fyh_creacion'];
            $dni_session_usuario = $datos_session_usuario['dni'];
        }

        //METODO PARA ALMACENRAR LA RUTA QUE INGRESAMOS
        $url = $_SERVER["PHP_SELF"];

        //CONTAMOS LOS CARACTERES
        $conta = strlen($url);

        //CORTAMOS LA RUTA DEL LADO DEL SERVIDOR LOCAL
        $res = substr($url, 18, $conta);

        $sql = "SELECT * FROM roles_permisos AS rolper
                                INNER JOIN permisos AS per
                                ON per.id_permiso = rolper.permiso_id
                                INNER JOIN roles AS rol
                                ON rol.id_rol = rolper.rol_id
                        WHERE rolper.estado = '1'";
        $query = $pdo->prepare($sql);
        $query->execute();

        $roles_Permisos = $query->fetchAll(PDO::FETCH_ASSOC);

        $contador_permiso = 0;
        foreach ($roles_Permisos as $role_Permiso) {
            if ($id_rol_session_usuario == $role_Permiso['rol_id']) {

                if ($res == $role_Permiso['url']) {
                    $contador_permiso = $contador_permiso + 1;
                }
            }
        }

        if ($contador_permiso > 0) {
            
        } else {
            header('Location:' . APP_URL . "/admin/noAutorizado.php");
        }        

    } else {
        header('Location:' . APP_URL . "/login");
    }

    ?>

<!-- CABEZA PAGINA -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/dist/css/adminlte.min.css">
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- bootstrap-icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- JQuery -->
    <script src="<?= APP_URL; ?>/public/plugins/jquery/jquery.js"></script>

    <!-- JQuery Excel-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <!-- DataTable -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini ">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light ">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= APP_URL; ?>/admin" class="nav-link"><?= APP_NAME; ?></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= APP_URL; ?>/admin" class="brand-link">
                <img src="<?= APP_URL; ?>/public/images/logo/logo.jpg" alt="Gestion Escolar" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Gestion Escolar</span>
            </a>

            <!-- Menu Lateral -->
            <div class="sidebar">
                <!-- Panel Usuario -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= APP_URL; ?>/public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $nombre_session_usuario; ?></a>
                    </div>
                </div>

                <!-- Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DIRECTOR ADMINISTRATIVO") || ($rol_session_usuario == "DIRECTOR ACADEMICO")) {
                        ?>
                            <!-- CONFIGURACIONES -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-gear"></i>
                                    </i>
                                    <p>
                                        Configuración
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/configuraciones" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Configurar</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DOCENTE") || ($rol_session_usuario == "ESTUDIANTE")) {
                        ?>
                            <!-- KARDEX -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-clipboard-check"></i>
                                    </i>
                                    <p>
                                        kardex
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/kardex" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ingresar panel kardex</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DIRECTOR ACADEMICO")) {
                        ?>
                            <!-- NIVELES -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-bookshelf"></i>
                                    </i>
                                    <p>
                                        Niveles
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/niveles" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de niveles</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DIRECTOR ACADEMICO")) {
                        ?>
                            <!-- GRADOS -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-bar-chart-steps"></i>
                                    </i>
                                    <p>
                                        Grados
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/grados" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de grados</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DIRECTOR ACADEMICO")) {
                        ?>
                            <!-- MATERIAS -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-book-half"></i>
                                    </i>
                                    <p>
                                        Materias
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/materias" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de materias</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR")) {
                        ?>
                            <!--    ROLES -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-bookmarks"></i>
                                    </i>
                                    <p>
                                        Roles
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/roles" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de roles</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/roles/permisos.php" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de permisos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>


                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR")) {
                        ?>
                            <!-- USUARIOS -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-people-fill"></i>
                                    </i>
                                    <p>
                                        Usuarios
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/usuarios" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DIRECTOR ACADEMICO") || ($rol_session_usuario == "DIRECTOR ADMINISTRATIVO") || ($rol_session_usuario == "SECRETARIA")) {
                        ?>
                            <!-- ADMINISTRATIVOS -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-person-lines-fill"></i>
                                    </i>
                                    <p>
                                        Administrativos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/administrativos" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Personal administrativo</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DIRECTOR ACADEMICO") || ($rol_session_usuario== "SECRETARIA")) {
                        ?>
                            <!-- DOCENTES -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-person-video3"></i>
                                    </i>
                                    <p>
                                        Docentes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/docentes" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Personal de docentes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/docentes/asignacion.php" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Materias asignadas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DOCENTE")) {
                        ?>
                            <!-- CALIFICACIONES -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-check2-square"></i>
                                    </i>
                                    <p>
                                        Calificaciones
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/calificaciones" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Agregar las calificaciones</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario == "DIRECTOR ACADEMICO") || ($rol_session_usuario=="SECRETARIA") || ($rol_session_usuario == "DIRECTOR ADMINISTRATIVO") || ($rol_session_usuario=="CONTADOR")) {
                        ?>
                            <!-- ESTUDIANTES -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-person-workspace"></i>
                                    </i>
                                    <p>
                                        Estudiantes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/inscripciones" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Inscripciones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/estudiantes" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Listado de Estudiantes</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>


                        <?php
                        if (($rol_session_usuario == "ADMINISTRADOR") || ($rol_session_usuario=="CONTADOR") || ($rol_session_usuario == "DIRECTOR ADMINISTRATIVO")) {
                        ?>
                            <!-- PAGOS -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas">
                                        <i class="bi bi-cash-coin"></i>
                                    </i>
                                    <p>
                                        Pagos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= APP_URL; ?>/admin/pagos" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Realizar pagos</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <!-- CERRAR SESION -->
                        <li class="nav-item">
                            <a href="<?= APP_URL; ?>/login/logout.php" class="nav-link" style="background-color: red;">
                                <i class="nav-icon fas">
                                    <i class="bi bi-door-open"></i>
                                </i>
                                <p>
                                    Cerrar sesión
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.Menu-->
            </div>
            <!-- /.sidebar -->
        </aside>