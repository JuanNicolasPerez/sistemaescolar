<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../../app/config.php');

$id_config_institucion = $_POST['id_config_institucion'];
$nombre_institucion = $_POST['nombre_institucion'];
$nombre_institucion = mb_strtoupper($nombre_institucion, 'UTF-8');

$correo = $_POST['email'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];

// PREGUNTAMOS SI TIENE UNA IMAGEN
$logo = $_POST['logo'];

if ($_FILES['file']['name'] != null) {
    $nombre_del_archivo = date('Y-m-d-H-i-s') . $_FILES['file']['name'];
    $location = "../../../../public/images/configuracion/" . $nombre_del_archivo;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    $logo = $nombre_del_archivo;
} else {
    if($logo == ""){
        $logo = "";
    }else {
        $logo = $logo;
    }
}

if ($nombre_institucion == '' || $celular == '' || $direccion == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique que los campos no estén vacios.";
    $_SESSION['icono'] = "error";

    ?>
    <script>
        window.history.back();
    </script>
    <?php
} else {
    $sql = "UPDATE configuracion_instituciones 
            SET nombre_institucion=:nombre_institucion,
                logo=:logo,
                correo=:correo, 
                direccion=:direccion, 
                telefono=:telefono, 
                celular=:celular, 
                fyh_actualizacion=:fyh_actualizacion                                   
            WHERE id_config_institucion=:id_config_institucion";

    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam(':nombre_institucion', $nombre_institucion);
    $sentencia->bindParam(':logo', $logo);
    $sentencia->bindParam(':correo', $correo);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':celular', $celular);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':id_config_institucion', $id_config_institucion);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
            $_SESSION['icono'] = "success";

            header('Location:' . APP_URL . "/admin/configuraciones/institucion");
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al altualizarse.";
            $_SESSION['icono'] = "error";

        ?>
            <script>
                window.history.back();
            </script>
        <?php
        }
    } catch (Exception $Exception) {
        session_start();
        $_SESSION['mensaje'] = "Este nombre de institución, ya esta en uso.";
        $_SESSION['icono'] = "error";

        ?>
            <script>
                window.history.back();
            </script>
        <?php
    }
}
