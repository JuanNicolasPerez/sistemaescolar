<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_pago = $_POST['id_pago'];
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
    $sql = "UPDATE pagos 
                    SET mes_pagado=:mes_pagado,
                        monto_pagado=:monto_pagado, 
                        fecha_pagado=:fecha_pagado, 
                        fyh_actualizacion=:fyh_actualizacion
                WHERE id_pago=:id_pago";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(':mes_pagado', $mes_pagado);
    $sentencia->bindParam(':monto_pagado', $monto_pagado);
    $sentencia->bindParam(':fecha_pagado', $fecha_pagado);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':id_pago', $id_pago);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
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