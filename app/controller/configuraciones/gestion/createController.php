<?php

// INCLUIMOS LA CONEXXION A BD
include('../../../../app/config.php');

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
    $sql = "INSERT INTO gestiones (gestion, estado, fyh_creacion) 
        VALUES (:gestion, :estado, :fyh_creacion)";

    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam(':gestion', $gestion);
    $sentencia->bindParam(':estado', $estado);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se registro de la manera correcta.";
            $_SESSION['icono'] = "success";

            header('Location:' . APP_URL . "/admin/configuraciones/gestion");
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

