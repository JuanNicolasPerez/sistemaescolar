<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_rol = $_POST['id_rol'];

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

    // INSERTAR PRIMERO A LA TABLA USUARIOS
    $contrasenia = password_hash($dni, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (rol_id, email, password, fyh_creacion, estado) 
                            VALUES ( :rol_id, :email, :password, :fyh_creacion, :estado)";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(':rol_id', $id_rol);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':password', $contrasenia);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->bindParam(':estado', $estado_registro);

    try {
        if ($sentencia->execute()) {
            // RECUPERAMOS EL ID_USUARIO DE LA TABLA USUARIO
            $id_usuario = $pdo->lastInsertId();

            // INSERTAR PRIMERO A LA TABLA PERSONAS
            $sql = "INSERT INTO personas (nombres, apellidos, usuario_id, dni, fecha_nacimiento, celular, profesion, direccion, fyh_creacion, estado) 
                                VALUES (:nombres, :apellidos, :usuario_id, :dni, :fecha_nacimiento, :celular, :profesion, :direccion, :fyh_creacion, :estado)";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bindParam(':usuario_id', $id_usuario);
            $sentencia->bindParam(':nombres', $nombres);
            $sentencia->bindParam(':apellidos', $apellidos);
            $sentencia->bindParam(':dni', $dni);
            $sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
            $sentencia->bindParam(':celular', $celular);
            $sentencia->bindParam(':profesion', $profesion);
            $sentencia->bindParam(':direccion', $direccion);
            $sentencia->bindParam(':fyh_creacion', $fechaHora);
            $sentencia->bindParam(':estado', $estado_registro);
            $sentencia->execute();

            // RECUPERAMOS EL ID_PERSONA DE LA TABLA PERSONAS
            $id_persona = $pdo->lastInsertId();

            // INSERTAR PRIMERO A LA TABLA ADMINISTRATIVOS
            $sql = "INSERT INTO administrativos (persona_id, fyh_creacion, estado) 
                    VALUES (:persona_id, :fyh_creacion, :estado)";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bindParam(':persona_id', $id_persona);
            $sentencia->bindParam(':fyh_creacion', $fechaHora);
            $sentencia->bindParam(':estado', $estado_registro);

            try {
                if ($sentencia->execute()) {
                    $pdo->commit();
                    session_start();
                    $_SESSION['mensaje'] = "Se registro de la manera correcta.";
                    $_SESSION['icono'] = "success";

                    header('Location:' . APP_URL . "/admin/administrativos");
                } else {
                    $pdo->rollBack();
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
                print_r($Exception);
            }

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
