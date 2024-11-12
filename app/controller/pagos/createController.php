<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$estudiante_id = $_POST['estudiante_id'];
$mes_pagado = $_POST['mes_pagado'];
$monto_pagado = $_POST['monto_pagado'];
$fecha_pagado = $_POST['fecha_pagado'];

if ($mes_pagado == '' || $monto_pagado == '' || $fecha_pagado == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/materias");
} else {
    $sql = "INSERT INTO pagos 
                            (estudiante_id, 
                            mes_pagado,
                            monto_pagado, 
                            fecha_pagado, 
                            fyh_creacion, 
                            estado) 
                VALUES (:estudiante_id,
                        :mes_pagado,
                        :monto_pagado, 
                        :fecha_pagado, 
                        :fyhcreacion, 
                        :estado)";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam('estudiante_id', $estudiante_id);
    $sentencia->bindParam('mes_pagado', $mes_pagado);
    $sentencia->bindParam('monto_pagado', $monto_pagado);
    $sentencia->bindParam('fecha_pagado', $fecha_pagado);
    $sentencia->bindParam('fyhcreacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_registro);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se registro de la manera correcta.";
            $_SESSION['icono'] = "success";
            ?>
                <script>
                    window.history.back();
                </script>
            <?php
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizarse, comuníquese con el administrador.";
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
}