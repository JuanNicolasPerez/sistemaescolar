<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_usuario = $_POST['id_usuario'];

$rol_id = $_POST['rol_id'];
$correo = $_POST['email'];

$contrasenia = $_POST['password'];
$verificarContrasenia = $_POST['password_repeat'];

if ($correo == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique que los campos no estén vacios.";
    $_SESSION['icono'] = "error";

?>
    <script>
        window.history.back();
    </script>
    <?php

} else {
    if ($contrasenia == '') {

        $sqlUsu = " UPDATE usuarios 
                        SET rol_id=:rol_id,
                            email=:email, 
                            fyh_actualizacion=:fyh_actualizacion 
                        WHERE id_usuario=:id_usuario";

        $sentencia = $pdo->prepare($sqlUsu);

        $sentencia->bindParam(':rol_id', $rol_id);
        $sentencia->bindParam(':email', $correo);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_usuario', $id_usuario);

        try {
            if ($sentencia->execute()) {
                session_start();
                $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
                $_SESSION['icono'] = "success";

                header('Location:' . APP_URL . "/admin/usuarios");
            } else {
                session_start();
                $_SESSION['mensaje'] = "Error al actualizar.";
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
        if ($contrasenia == $verificarContrasenia) {
            $contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);

            if ($correo == '') {
                session_start();
                $_SESSION['mensaje'] = "Verifique que los campos no estén vacios.";
                $_SESSION['icono'] = "error";

            ?>
                <script>
                    window.history.back();
                </script>
                <?php

            } else {
                $sql = "UPDATE usuarios
                    SET rol_id=:rol_id,
                        email=:email,
                        password=:password,
                        fyh_actualizacion =:fyh_actualizacion
                    WHERE id_usuario=:id_usuario";

                $sentencia = $pdo->prepare($sql);

                $sentencia->bindParam(':rol_id', $rol_id);
                $sentencia->bindParam(':email', $correo);
                $sentencia->bindParam(':password', $contrasenia);
                $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
                $sentencia->bindParam(':id_usuario', $id_usuario);

                try {
                    if ($sentencia->execute()) {
                        session_start();
                        $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
                        $_SESSION['icono'] = "success";

                        header('Location:' . APP_URL . "/admin/usuarios");
                    } else {
                        session_start();
                        $_SESSION['mensaje'] = "Error al actualizar.";
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
}
