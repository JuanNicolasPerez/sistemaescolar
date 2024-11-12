<?php

// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_nivel = $_POST['id_nivel'];
$gestion_id = $_POST['gestion_id'];
$nivel = $_POST['nivel'];
$turno = $_POST['turno'];

$sql = "UPDATE niveles 
            SET gestion_id=:gestion_id,                
                nivel=:nivel,
                turno=:turno,
                fyh_actualizacion=:fyh_actualizacion
                WHERE id_nivel=:id_nivel";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam(':gestion_id', $gestion_id);
$sentencia->bindParam(':nivel', $nivel);
$sentencia->bindParam(':turno', $turno);
$sentencia->bindParam(':fyh_actualizacion', $fyh_actualizacion);
$sentencia->bindParam(':id_nivel', $id_nivel);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
        $_SESSION['icono'] = "success";

        header('Location:' . APP_URL . "/admin/niveles");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al actualizar.";
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
