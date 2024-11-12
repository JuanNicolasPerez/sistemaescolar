<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_persona = $_POST['id_persona'];
$id_usuario = $_POST['id_usuario'];
$id_administrativo = $_POST['id_administrativo'];
$id_rol = $_POST['rol_id'];

$nombres = $_POST['nombres'];
$nombres = mb_strtoupper($nombres, 'UTF-8');

$apellidos = $_POST['apellidos'];
$apellidos = mb_strtoupper($apellidos, 'UTF-8');

$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$celular = $_POST['celular'];
$profesion = $_POST['profesion'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];

// VALIDAMOS LOS DATOS
if ($nombres == '' || $apellidos == '' || $dni == '' || $fecha_nacimiento == '' || $celular == '' || $profesion == '' || $direccion == '' || $email == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique que los campos no estén vacíos.";
    $_SESSION['icono'] = "error";

    ?>
        <script>
            window.history.back();
        </script>
    <?php

} else {
    // INICIAMOS LAS CONSULTAS MULTIPLES
    $pdo->beginTransaction();

    // MODIFICAMOS PRIMERO A LA TABLA USUARIOS
    $contrasenia = password_hash($dni, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios 
                    SET rol_id=:rol_id, 
                        email=:email, 
                        password=:password, 
                        fyh_actualizacion=:fyh_actualizacion
                    WHERE id_usuario=:id_usuario";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(':rol_id', $id_rol);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':password', $contrasenia);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':id_usuario', $id_usuario);

    try {
        if ($sentencia->execute()) {

            // MODIFICAMOS A LA TABLA PERSONAS
            $sql = "UPDATE personas 
                            SET nombres=:nombres, 
                                apellidos=:apellidos, 
                                dni=:dni, 
                                fecha_nacimiento=:fecha_nacimiento, 
                                celular=:celular, 
                                profesion=:profesion, 
                                direccion=:direccion, 
                                fyh_actualizacion=:fyh_actualizacion
                            WHERE id_persona=:id_persona";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bindParam(':nombres', $nombres);
            $sentencia->bindParam(':apellidos', $apellidos);
            $sentencia->bindParam(':dni', $dni);
            $sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $sentencia->bindParam(':celular', $celular);
            $sentencia->bindParam(':profesion', $profesion);
            $sentencia->bindParam(':direccion', $direccion);
            $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
            $sentencia->bindParam(':id_persona', $id_persona);
            $sentencia->execute();

            // MODIFICAMOS A LA TABLA ADMINISTRATIVOS
            $sql = "UPDATE administrativos 
                            SET fyh_actualizacion=:fyh_actualizacion 
                            WHERE id_administrativo=:id_administrativo";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
            $sentencia->bindParam(':id_administrativo', $id_administrativo);

            try {
                if ($sentencia->execute()) {
                    $pdo->commit();
                    session_start();
                    $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
                    $_SESSION['icono'] = "success";

                    header('Location:' . APP_URL . "/admin/administrativos");
                } else {
                    $pdo->rollBack();
                    session_start();
                    $_SESSION['mensaje'] = "Error al actualizarse.";
                    $_SESSION['icono'] = "error";
                    ?>
                        <script>
                            window.history.back();
                        </script>
                    <?php
                }
            } catch (Exception $Exception) {
                print_r($Exception);
            }

        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizarse.";
            $_SESSION['icono'] = "error";
            ?>
            <script>
                window.history.back();
            </script>
        <?php
        }
    } catch (Exception $Exception) {
        // print_r($Exception);
        $pdo->rollBack();
        session_start();
        $_SESSION['mensaje'] = "Este correo ya está en uso por otro usuario.";
        $_SESSION['icono'] = "error";

        ?>
            <script>
                window.history.back();
            </script>
        <?php
    }
}
