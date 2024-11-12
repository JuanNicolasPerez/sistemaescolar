    <?php
    // INCLUIMOS LA CONEXXION A BD
    include('../../../app/config.php');

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
    if ($nombres == '' || $apellidos == '' || $dni == '' || $fecha_nacimiento == ''  || 
        $email == '' || $direccion == '' || $celular == '' || 
        $legajo == '' || 
        $nombre_apellidos == ''|| $dni_ppff == '' || $celular_ppff == '' || $ocupacion == '' || 
        $ref_nombre == '' ||    $ref_parentezco == '' ||  $ref_celular == '') {

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
        $sentencia->bindParam(':rol_id', $rol_id);
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

                // INSERTAR PRIMERO A LA TABLA ESTUDIANTES
                $sql = "INSERT INTO estudiantes (persona_id, nivel_id, grado_id, legajo, fyh_creacion, estado) 
                        VALUES (:persona_id, :nivel_id, :grado_id, :legajo, :fyh_creacion, :estado)";
                $sentencia = $pdo->prepare($sql);
                $sentencia->bindParam(':persona_id', $id_persona);
                $sentencia->bindParam(':nivel_id', $nivel_id);
                $sentencia->bindParam(':grado_id', $grado_id);
                $sentencia->bindParam(':legajo', $legajo);
                $sentencia->bindParam(':fyh_creacion', $fechaHora);
                $sentencia->bindParam(':estado', $estado_registro);

                $sentencia->execute();

                // RECUPERAMOS EL ID_PERSONA DE LA TABLA ESTUDIANTE
                $id_estudiante = $pdo->lastInsertId();

                // INSERTAR PRIMERO A LA TABLA PADRE DE FAMILIA
                $sql = "INSERT INTO ppffS (estudiante_id, nombre_apellidos, dni_ppff, celular_ppff, ocupacion, ref_nombre, ref_parentezco, ref_celular, fyh_creacion, estado) 
                                    VALUES (:estudiante_id, :nombre_apellidos, :dni_ppff, :celular_ppff, :ocupacion, :ref_nombre, :ref_parentezco, :ref_celular, :fyh_creacion, :estado)";
                $sentencia = $pdo->prepare($sql);
                $sentencia->bindParam(':estudiante_id', $id_estudiante);
                $sentencia->bindParam(':nombre_apellidos', $nombre_apellidos);
                $sentencia->bindParam(':dni_ppff', $dni_ppff);
                $sentencia->bindParam(':celular_ppff', $celular_ppff);
                $sentencia->bindParam(':ocupacion', $ocupacion);
                $sentencia->bindParam(':ref_nombre', $ref_nombre);
                $sentencia->bindParam(':ref_parentezco', $ref_parentezco);
                $sentencia->bindParam(':ref_celular', $ref_celular);
                $sentencia->bindParam(':fyh_creacion', $fechaHora);
                $sentencia->bindParam(':estado', $estado_registro);

                try {
                    if ($sentencia->execute()) {
                        $pdo->commit();
                        session_start();
                        $_SESSION['mensaje'] = "Se registro de la manera correcta.";
                        $_SESSION['icono'] = "success";

                        header('Location:' . APP_URL . "/admin/estudiantes");
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
            $_SESSION['mensaje'] = "Este correo o número legajo, ya está en uso por otro usuario.";
            $_SESSION['icono'] = "error";

            ?>
                <script>
                    window.history.back();
                </script>
            <?php
        }
    }
