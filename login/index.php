<?php
include('../app/config.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- style de login -->
    <link rel="stylesheet" href="<?= APP_URL; ?>/public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar a la página</p>
                    <button id="btn__iniciar-sesion">Iniciar sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!-- Formulario Login y Registro -->
            <div class="contenedor__login-register">
                <!-- Formulario Login -->
                <form action="controller_login.php" method="post" class="formulario__login">
                    <h2>Iniciar sesión</h2>
                    <input type="email" name="correo_login" id="correo_login" placeholder="Correo electronico">
                    <input type="password" name="contraseña_login" id="contraseña_login" placeholder="Contraseña">
                    <button type="submit">Entrar</button>
                </form>

                <!-- Mensajes de confirmacion -->
                <?php
                    session_start();

                    if (isset($_SESSION['mensaje'])) {
                        $mensaje = $_SESSION['mensaje'];
                ?>

                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "<?=$mensaje;?>",
                        showConfirmButton: false,
                        timer: 3500
                    });
                </script>

                <?php
                    session_destroy();
                    }
                ?>

                <!-- Formulario Registro -->
                <form action="" method="post" class="formulario__register">
                    <h2>Registrarse</h2>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
                    <input type="email" name="correo_registro" id="correo_registro" placeholder="Correo electronico">
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                    <input type="password" name="contraseña_registro" id="contraseña_registro" placeholder="Contraseña">
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <!-- jQuery -->
    <script src="<?= APP_URL; ?>/public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= APP_URL; ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= APP_URL; ?>/public/dist/js/adminlte.min.js"></script>
    <!-- js para login  -->
    <script src="<?= APP_URL; ?>/public/js/script.js"></script>
</body>

</html>