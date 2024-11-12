<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$nombre_rol = $_POST['nombre_rol'];
$nombre_rol = mb_strtoupper($nombre_rol, 'UTF-8');

if ($nombre_rol == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/roles");
} else {
    $sql_rol = "INSERT INTO roles (nombres_rol, fyh_creacion, estado) 
                VALUES (:nombre_rol, :fyhcreacion, :estado)";

    $sentencia = $pdo->prepare($sql_rol);

    $sentencia->bindParam('nombre_rol', $nombre_rol);
    $sentencia->bindParam('fyhcreacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_registro);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se registro de la manera correcta.";
            $_SESSION['icono'] = "success";
    
            header('Location:' . APP_URL . "/admin/roles");
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al registrarse.";
            $_SESSION['icono'] = "error";
    
            header('Location:' . APP_URL . "/admin/roles/create.php");
        }
    } catch (Exception $Exception) {
        session_start();
        $_SESSION['mensaje'] = "Error al registrarse, este rol ya existente.";
        $_SESSION['icono'] = "error";

        header('Location:' . APP_URL . "/admin/roles/create.php");
    }
}
