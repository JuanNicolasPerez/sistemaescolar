<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../../app/config.php');

$id_config_institucion = $_POST['id_config_institucion'];

// Buscamos la imagen desde la base de datos para eliminar del directorio
$sql_image = "SELECT * FROM configuracion_instituciones 
                WHERE id_config_institucion = '$id_config_institucion'";

$sentencia_image = $pdo->prepare($sql_image);
$sentencia_image->execute();
$imagen = $sentencia_image->fetch();

$ruta = $imagen['logo'];

unlink(APP_URL."/public/images/configuracion/".$ruta);

$sql = "DELETE FROM configuracion_instituciones
        WHERE id_config_institucion=:id_config_institucion";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam('id_config_institucion', $id_config_institucion);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
    $_SESSION['icono'] = "success";

    header('Location:' . APP_URL . "/admin/configuraciones/institucion");
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminarse.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/configuraciones/institucion");
}
