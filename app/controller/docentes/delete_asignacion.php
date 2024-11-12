<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_asignacion = $_POST['id_asignacion'];

$sql= "DELETE FROM asignaciones WHERE id_asignacion =:id_asignacion";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam(':id_asignacion', $id_asignacion );

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
    $_SESSION['icono'] = "success";

    header('Location:' . APP_URL . "/admin/docentes/asignacion.php");
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminarse.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/docentes/asignacion.php");
}