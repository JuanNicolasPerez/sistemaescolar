<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$materia = $_POST['materia'];
$materia = mb_strtoupper($materia, 'UTF-8');

if ($materia == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/materias");
} else {
    $sql = "INSERT INTO materias (nombre_materia, fyh_creacion, estado) 
                VALUES (:nombre_materia, :fyhcreacion, :estado)";

    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam('nombre_materia', $materia);
    $sentencia->bindParam('fyhcreacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_registro);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se registro de la manera correcta.";
            $_SESSION['icono'] = "success";
    
            header('Location:' . APP_URL . "/admin/materias");
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al registrarse.";
            $_SESSION['icono'] = "error";
    
            header('Location:' . APP_URL . "/admin/materias/create.php");
        }
    } catch (Exception $Exception) {
        print_r($Exception);
    }
}