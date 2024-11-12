<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_usuario = $_POST['id_usuario'];

$sql_Usu = "DELETE FROM usuarios WHERE id_usuario=:id_usuario";

$sentencia = $pdo->prepare($sql_Usu);

$sentencia->bindParam('id_usuario', $id_usuario);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
    $_SESSION['icono'] = "success";

    header('Location:' . APP_URL . "/admin/usuarios");
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminarse.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/usuarios");
}