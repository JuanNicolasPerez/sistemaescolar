<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_rol = $_POST['id_rol'];
$correo = $_POST['email'];
$contrasenia = $_POST['password'];
$verificarContrasenia = $_POST['password_repeat'];

if ($correo == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique que los campos no estén vacíos.";
    $_SESSION['icono'] = "error";

    ?>
        <script>
            window.history.back();
        </script>
    <?php
}else {
    if ($contrasenia == $verificarContrasenia) {
        $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (rol_id, email, password, fyh_creacion, estado) 
                        VALUES (:rol_id, :email, :password, :fyh_creacion, :estado)";

        $sentencia = $pdo->prepare($sql);

        $sentencia->bindParam(':rol_id', $id_rol);
        $sentencia->bindParam(':email', $correo);
        $sentencia->bindParam(':password', $contrasenia);
        $sentencia->bindParam(':fyh_creacion', $fechaHora);
        $sentencia->bindParam(':estado', $estado_registro);

        try {
            if ($sentencia->execute()) {
                session_start();
                $_SESSION['mensaje'] = "Se registro de la manera correcta.";
                $_SESSION['icono'] = "success";

                header('Location:' . APP_URL . "/admin/usuarios");
            } else {
                session_start();
                $_SESSION['mensaje'] = "Error al registrarse.";
                $_SESSION['icono'] = "error";
                ?>
                    <script>
                        window.history.back();
                    </script>
                <?php
            }
        } catch (Exception $Exception) {
            session_start();
            $_SESSION['mensaje'] = "Este correo ya esta en uso por otro usuario.";
            $_SESSION['icono'] = "error";

            ?>
            <script>
                window.history.back();
            </script>
            <?php
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "Las contraseñas introducidas no son iguales.";
        $_SESSION['icono'] = "error";
        ?>
            <script>
                window.history.back();
            </script>
        <?php
    }
}
