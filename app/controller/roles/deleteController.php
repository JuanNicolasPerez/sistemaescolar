<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_rol = $_POST['id_rol'];

// Consultamos a la base de datos
$sql = "SELECT * FROM usuarios 
                WHERE rol_id = $id_rol
                AND estado = '1'";

$query_usuarios = $pdo->prepare($sql);
$query_usuarios->execute();

$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

$contador = 0;

foreach ($usuarios as $usuario) {
    $contador = $contador + 1;
}

if ($contador > 0) {
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar, existen usuarios asignados a este rol.";
    $_SESSION['icono'] = "error";

    header('Location:' . APP_URL . "/admin/roles");
} else {
    $sql_rol = "DELETE FROM roles WHERE id_rol=:id_rol";

    $sentencia = $pdo->prepare($sql_rol);

    $sentencia->bindParam('id_rol', $id_rol);

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
        $_SESSION['icono'] = "success";

        header('Location:' . APP_URL . "/admin/roles");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al eliminarse.";
        $_SESSION['icono'] = "error";

        header('Location:' . APP_URL . "/admin/roles");
    }
}
