<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_kardex = $_POST['id_kardex'];

$sql= "DELETE FROM kardexs WHERE id_kardex =:id_kardex";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam(':id_kardex', $id_kardex );

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
    $_SESSION['icono'] = "success";

    header('Location:' . APP_URL . "/admin/kardex/index.php");
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminarse.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/kardex/index.php");
}