<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_kardex = $_POST['id_kardex'];
$docente_id = $_POST['docente_id'];
$estudiante_id  = $_POST['estudiante_id'];
$materia_id = $_POST['materia_id'];
$fecha = $_POST['fecha'];
$observacion = $_POST['observacion'];
$nota = $_POST['nota'];

$sql = "UPDATE kardexs 
                SET docente_id=:docente_id,
                    estudiante_id=:estudiante_id,
                    materia_id=:materia_id,
                    fecha=:fecha,
                    observacion=:observacion,
                    nota=:nota,
                    fyh_actualizacion=:fyh_actualizacion, 
                    estado=:estado
                WHERE id_kardex=:id_kardex";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam('docente_id', $docente_id);
$sentencia->bindParam('estudiante_id', $estudiante_id);
$sentencia->bindParam('materia_id', $materia_id);
$sentencia->bindParam('fecha', $fecha);
$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('nota', $nota);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('estado', $estado_registro);
$sentencia->bindParam('id_kardex', $id_kardex);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
        $_SESSION['icono'] = "success";

        header('Location:' . APP_URL . "/admin/kardex");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al actualizarse.";
        $_SESSION['icono'] = "error";

        header('Location:' . APP_URL . "/admin/kardex/create.php");
    }
} catch (Exception $Exception) {
    print_r($Exception);
}
