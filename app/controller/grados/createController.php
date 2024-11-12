<?php

// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$nivel_id = $_POST['nivel_id'];
$curso = $_POST['curso'];
$paralelo = $_POST['paralelo'];

$sql = "INSERT INTO grados (nivel_id, curso, paralelo, estado, fyh_creacion) 
        VALUES (:nivel_id, :curso, :paralelo, :estado, :fyh_creacion)";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam(':nivel_id', $nivel_id);
$sentencia->bindParam(':curso', $curso);
$sentencia->bindParam(':paralelo', $paralelo);
$sentencia->bindParam(':estado', $estado_registro);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro de la manera correcta.";
        $_SESSION['icono'] = "success";

        header('Location:' . APP_URL . "/admin/grados");
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
