<?php

// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_grado = $_POST['id_grado'];
$nivel_id = $_POST['nivel_id'];
$curso = $_POST['curso'];
$paralelo = $_POST['paralelo'];

$sql = "UPDATE grados
            SET nivel_id=:nivel_id, 
                curso=:curso, 
                paralelo=:paralelo, 
                estado=:estado, 
                fyh_actualizacion=:fyh_actualizacion
            WHERE id_grado=:id_grado";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam(':nivel_id', $nivel_id);
$sentencia->bindParam(':curso', $curso);
$sentencia->bindParam(':paralelo', $paralelo);
$sentencia->bindParam(':estado', $estado_registro);
$sentencia->bindParam(':fyh_actualizacion', $fyh_actualizacion);
$sentencia->bindParam(':id_grado', $id_grado);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
        $_SESSION['icono'] = "success";

        header('Location:' . APP_URL . "/admin/grados");
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
