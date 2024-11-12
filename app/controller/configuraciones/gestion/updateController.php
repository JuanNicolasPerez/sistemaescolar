<?php

// INCLUIMOS LA CONEXXION A BD
include('../../../../app/config.php');
$id_gestion = $_POST['id_gestion'];
$gestion = $_POST['gestion'];
$gestion = mb_strtoupper($gestion, 'UTF-8');
$estado = $_POST['estado'];

if ($estado == 'ACTIVO') {
    $estado = 1;
} else {
    $estado = 0;
}

if ($gestion == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique que los campos no estén vacios.";
    $_SESSION['icono'] = "error";

    ?>
    <script>
        window.history.back();
    </script>
    <?php
} else {
    $sql = "UPDATE gestiones 
            SET gestion=:gestion, 
                estado=:estado, 
                fyh_actualizacion=:fyh_actualizacion 
            WHERE id_gestion=:id_gestion";

    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam(':gestion', $gestion);
    $sentencia->bindParam(':estado', $estado);
    $sentencia->bindParam(':fyh_actualizacion', $fyh_actualizacion);
    $sentencia->bindParam(':id_gestion', $id_gestion);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
            $_SESSION['icono'] = "success";

            header('Location:' . APP_URL . "/admin/configuraciones/gestion");
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizarse.";
            $_SESSION['icono'] = "error";

        ?>
            <script>
                window.history.back();
            </script>
        <?php
        }
    } catch (Exception $Exception) {
        session_start();
        $_SESSION['mensaje'] = "Este nombre de institución, ya esta en uso.";
        $_SESSION['icono'] = "error";

        ?>
            <script>
                window.history.back();
            </script>
        <?php
    }
}

