<?php

// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_materia = $_POST['id_materia'];
$nombre_materia = $_POST['nombre_materia'];
$nombre_materia = mb_strtoupper($nombre_materia, 'UTF-8');

if ($nombre_materia == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/materias");
} else {
    $sql = "UPDATE materias 
            SET nombre_materia=:nombre_materia,                
                fyh_actualizacion=:fyh_actualizacion
            WHERE id_materia=:id_materia";

    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam('nombre_materia', $nombre_materia);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_materia', $id_materia);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
            $_SESSION['icono'] = "success";
    
            header('Location:' . APP_URL . "/admin/materias");
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar.";
            $_SESSION['icono'] = "error";
    
            header('Location:' . APP_URL . "/admin/materias/create.php");
        }
    } catch (Exception $Exception) {
        print_r($Exception);
    }
}