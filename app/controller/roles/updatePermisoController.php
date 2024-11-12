<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_permiso = $_POST['id_permiso'];

$nombre_url = $_POST['nombre_url'];
$url = $_POST['url'];

if ($nombre_url == '' && $url == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/roles/edit_permisos.php?id=".$id_permiso);
} else {
    $sql_rol = "UPDATE permisos 
                    SET nombre_url=:nombre_url, 
                        url=:url, 
                        fyh_actualizacion=:fyh_actualizacion 
                WHERE id_permiso=:id_permiso";

    $sentencia = $pdo->prepare($sql_rol);

    $sentencia->bindParam(':nombre_url', $nombre_url);
    $sentencia->bindParam(':url', $url);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':id_permiso', $id_permiso);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
            $_SESSION['icono'] = "success";
    
            header('Location:' . APP_URL . "/admin/roles/permisos.php");
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar.";
            $_SESSION['icono'] = "error";
    
            header('Location:' . APP_URL . "/admin/roles/edit_permisos.php?id=".$id_permiso);
        }
    } catch (Exception $Exception) {
        session_start();
        $_SESSION['mensaje'] = "Error al actualizar, este permiso ya existente.";
        $_SESSION['icono'] = "error";

        header('Location:' . APP_URL . "/admin/roles/edit_permisos.php?id=".$id_permiso);
    }
}
