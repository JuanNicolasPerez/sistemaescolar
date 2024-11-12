<?php

// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$gestion_id = $_POST['gestion_id'];
$nivel = $_POST['nivel'];
$turno = $_POST['turno'];

$sql = "INSERT INTO niveles (gestion_id, nivel, turno, estado, fyh_creacion) 
        VALUES (:gestion_id, :nivel, :turno, :estado, :fyh_creacion)";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam(':gestion_id', $gestion_id);
$sentencia->bindParam(':nivel', $nivel);
$sentencia->bindParam(':turno', $turno);
$sentencia->bindParam(':estado', $estado_registro);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro de la manera correcta.";
        $_SESSION['icono'] = "success";

        header('Location:' . APP_URL . "/admin/niveles");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al registrarse.";
        $_SESSION['icono'] = "error";

?>
        <script>
            window.history.back();
        </script>
    <?php
    }
} catch (Exception $Exception) {
    print_r($Exception);
}
