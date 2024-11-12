<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_pago = $_POST['id_pago'];

// Consultamos a la base de datos
$sql = "DELETE FROM pagos 
                WHERE id_pago =:id_pago";
$sentencia = $pdo->prepare($sql);
$sentencia->bindParam(':id_pago', $id_pago);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
        $_SESSION['icono'] = "success";

        ?>
            <script>
                window.history.back();
            </script>
        <?php
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al eliminar.";
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
