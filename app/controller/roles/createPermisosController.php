<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$nombre_url = $_POST['nombre_url'];
$url = $_POST['url'];

if ($nombre_url == '' && $url == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/roles");
} else {
    $sql_rol = "INSERT INTO permisos (nombre_url, url, fyh_creacion, estado) 
                VALUES (:nombre_url, :url, :fyhcreacion, :estado)";

    $sentencia = $pdo->prepare($sql_rol);

    $sentencia->bindParam(':nombre_url', $nombre_url);
    $sentencia->bindParam(':url', $url);
    $sentencia->bindParam(':fyhcreacion', $fechaHora);
    $sentencia->bindParam(':estado', $estado_registro);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se registro de la manera correcta.";
            $_SESSION['icono'] = "success";
    
            header('Location:' . APP_URL . "/admin/roles/permisos.php");
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al registrarse.";
            $_SESSION['icono'] = "error";
    
            header('Location:' . APP_URL . "/admin/roles/create_permisos.php");
        }
    } catch (Exception $Exception) {
        print_r($Exception);
    }
}
