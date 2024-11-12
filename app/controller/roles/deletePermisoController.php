<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_permiso = $_POST['id_permiso'];

$sql = "DELETE FROM permisos WHERE id_permiso=:id_permiso";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam('id_permiso', $id_permiso);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
    $_SESSION['icono'] = "success";

    header('Location:' . APP_URL . "/admin/roles/permisos.php");
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminarse.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/roles/permisos.php");
}

