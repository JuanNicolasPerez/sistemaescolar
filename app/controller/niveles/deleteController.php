<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_nivel = $_POST['id_nivel'];

// Consultamos a la base de datos
$sql = "DELETE FROM niveles 
                WHERE id_nivel =:id_nivel";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam(':id_nivel', $id_nivel);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
        $_SESSION['icono'] = "success";

        header('Location:' . APP_URL . "/admin/niveles");
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
