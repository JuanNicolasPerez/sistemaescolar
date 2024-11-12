<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

// <!-- IDENTIFICADORES -->
$id_usuario = $_POST['id_usuario'];
$id_persona = $_POST['id_persona'];
$id_estudiante = $_POST['id_estudiante'];
$id_ppff =  $_POST['id_ppff'];

// <!-- DATOS DEL ESTUDIANTE -->
$rol_id = $_POST['rol_id'];
$nombres = $_POST['nombres'];
$nombres = mb_strtoupper($nombres, 'UTF-8');
$apellidos = $_POST['apellidos'];
$apellidos = mb_strtoupper($apellidos, 'UTF-8');
$dni = $_POST['dni'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$celular = $_POST['celular'];
$profesion = 'ESTUDIANTE';

// <!-- DATOS ACADEMICOS -->
$nivel_id = $_POST['nivel_id'];
$grado_id = $_POST['grado_id'];
$legajo = $_POST['legajo'];

// <!-- DATOS DE LOS PADRES -->
$nombre_apellidos = $_POST['nombre_apellidos'];
$nombre_apellidos = mb_strtoupper($nombre_apellidos, 'UTF-8');
$dni_ppff = $_POST['dni_ppff'];
$celular_ppff = $_POST['celular_ppff'];
$ocupacion = $_POST['ocupacion'];

// <!-- DATOS DEL AUTORIZADO -->
$ref_nombre = $_POST['ref_nombre'];
$ref_nombre = mb_strtoupper($ref_nombre, 'UTF-8');
$ref_parentezco = $_POST['ref_parentezco'];
$ref_celular = $_POST['ref_celular'];

// VALIDAMOS LOS DATOS
if (
    $nombres == '' || $apellidos == '' || $dni == '' || $fecha_nacimiento == ''  ||
    $email == '' || $direccion == '' || $celular == '' ||
    $legajo == '' ||
    $nombre_apellidos == '' || $dni_ppff == '' || $celular_ppff == '' || $ocupacion == '' ||
    $ref_nombre == '' ||    $ref_parentezco == '' ||  $ref_celular == ''
) {

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

    // ACTUALIZAR PRIMERO A LA TABLA USUARIOS
    $contrasenia = password_hash($dni, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios 
                        SET rol_id=:rol_id, 
                            email=:email, 
                            password=:password,
                            fyh_actualizacion=:fyh_actualizacion 
                        WHERE id_usuario=:id_usuario";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(':rol_id', $rol_id);
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
            try {
                if ($sentencia->execute()) {
                    // MODIFICAMOS A LA TABLA ESTUDIANTES
                    $sql = "UPDATE estudiantes 
                                SET nivel_id=:nivel_id,
                                    grado_id=:grado_id,
                                    legajo=:legajo, 
                                    fyh_actualizacion=:fyh_actualizacion
                                WHERE id_estudiante=:id_estudiante";
                    $sentencia = $pdo->prepare($sql);
                    $sentencia->bindParam(':nivel_id', $nivel_id);
                    $sentencia->bindParam(':grado_id', $grado_id);
                    $sentencia->bindParam(':legajo', $legajo);
                    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
                    $sentencia->bindParam(':id_estudiante', $id_estudiante);

                    try {
                        if ($sentencia->execute()) {
                            // MODIFICAMOS A LA TABLA PADRE DE FAMILIA
                            $sql = "UPDATE ppffS 
                                        SET nombre_apellidos=:nombre_apellidos,
                                            dni_ppff=:dni_ppff, 
                                            celular_ppff=:celular_ppff, 
                                            ocupacion=:ocupacion, 
                                            ref_nombre=:ref_nombre, 
                                            ref_parentezco=:ref_parentezco, 
                                            ref_celular=:ref_celular,
                                            fyh_actualizacion=:fyh_actualizacion
                                        WHERE id_ppff=:id_ppff";
                            $sentencia = $pdo->prepare($sql);
                            $sentencia->bindParam(':nombre_apellidos', $nombre_apellidos);
                            $sentencia->bindParam(':dni_ppff', $dni_ppff);
                            $sentencia->bindParam(':celular_ppff', $celular_ppff);
                            $sentencia->bindParam(':ocupacion', $ocupacion);
                            $sentencia->bindParam(':ref_nombre', $ref_nombre);
                            $sentencia->bindParam(':ref_parentezco', $ref_parentezco);
                            $sentencia->bindParam(':ref_celular', $ref_celular);
                            $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
                            $sentencia->bindParam(':id_ppff', $id_ppff);

                            try {
                                if ($sentencia->execute()) {
                                    $pdo->commit();
                                    session_start();
                                    $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
                                    $_SESSION['icono'] = "success";
                                    header('Location:' . APP_URL . "/admin/estudiantes");
                                } else {
                                    $pdo->rollBack();
                                    session_start();
                                    $_SESSION['mensaje'] = "Error al actualizarse, comuníquese con el administrador.";
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
                                $_SESSION['mensaje'] = "Error al actualizarse, comuníquese con el administrador.";
                                $_SESSION['icono'] = "error";
                                ?>
                                <script>
                                    window.history.back();
                                </script>
                                <?php
                            }
                        } else {
                            $pdo->rollBack();
                            session_start();
                            $_SESSION['mensaje'] = "Error al registrarse, comuníquese con el administrador.";
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
                        $_SESSION['mensaje'] = "Este legajo, ya está en uso por otro estudiante.";
                        $_SESSION['icono'] = "error";
                        ?>
                        <script>
                            window.history.back();
                        </script>
                        <?php
                    }
                } else {
                    $pdo->rollBack();
                    session_start();
                    $_SESSION['mensaje'] = "Error al registrarse, comuníquese con el administrador.";
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
                $_SESSION['mensaje'] = "Error al registrarse, comuníquese con el administrador.";
                $_SESSION['icono'] = "error";
                ?>
                <script>
                    window.history.back();
                </script>
                <?php
            }
        } else {
            $pdo->rollBack();
            session_start();
            $_SESSION['mensaje'] = "Error al registrarse, comuníquese con el administrador.";
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
        $_SESSION['mensaje'] = "Este correo, ya está en uso por otro usuario.";
        $_SESSION['icono'] = "error";

        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }
}
