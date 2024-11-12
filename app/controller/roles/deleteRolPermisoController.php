<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_rol_permiso = $_POST['id_rol_permiso'];

$sql = "DELETE FROM roles_permisos WHERE id_rol_permiso=:id_rol_permiso";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam('id_rol_permiso', $id_rol_permiso);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
    $_SESSION['icono'] = "success";

    header('Location:' . APP_URL . "/admin/roles");
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminarse.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/roles");
}

