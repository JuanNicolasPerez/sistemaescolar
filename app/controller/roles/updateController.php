<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_rol = $_POST['id_rol'];

$nombre_rol = $_POST['nombre_rol'];
$nombre_rol = mb_strtoupper($nombre_rol, 'UTF-8');

if ($nombre_rol == "") {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/roles/edit.php?id=".$id_rol);
} else {
    $sql_rol = "UPDATE roles SET nombres_rol=:nombre_rol, fyh_actualizacion=:fyh_actualizacion 
                WHERE id_rol=:id_rol";

    $sentencia = $pdo->prepare($sql_rol);

    $sentencia->bindParam(':nombre_rol', $nombre_rol);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':id_rol', $id_rol);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
            $_SESSION['icono'] = "success";
    
            header('Location:' . APP_URL . "/admin/roles");
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar.";
            $_SESSION['icono'] = "error";
    
            header('Location:' . APP_URL . "/admin/roles/edit.php?id=".$id_rol);
        }
    } catch (Exception $Exception) {
        session_start();
        $_SESSION['mensaje'] = "Error al actualizar, este rol ya existente.";
        $_SESSION['icono'] = "error";

        header('Location:' . APP_URL . "/admin/roles/edit.php?id=".$id_rol);
    }
}
