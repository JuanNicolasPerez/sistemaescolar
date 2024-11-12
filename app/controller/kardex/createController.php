<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$docente_id = $_POST['docente_id'];
$estudiante_id  = $_POST['estudiante_id'];
$materia_id = $_POST['materia_id'];
$fecha = $_POST['fecha'];
$observacion = $_POST['observacion'];
$nota = $_POST['nota'];

$sql = "INSERT INTO kardexs (docente_id,
                            estudiante_id,
                            materia_id,
                            fecha,
                            observacion,
                            nota,
                            fyh_creacion, 
                            estado) 
                VALUES (:docente_id, 
                        :estudiante_id,
                        :materia_id,
                        :fecha,
                        :observacion,
                        :nota,
                        :fyhcreacion, 
                        :estado)";

$sentencia = $pdo->prepare($sql);

$sentencia->bindParam('docente_id', $docente_id);
$sentencia->bindParam('estudiante_id', $estudiante_id);
$sentencia->bindParam('materia_id', $materia_id);
$sentencia->bindParam('fecha', $fecha);
$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('nota', $nota);
$sentencia->bindParam('fyhcreacion', $fechaHora);
$sentencia->bindParam('estado', $estado_registro);

try {
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro de la manera correcta.";
        $_SESSION['icono'] = "success";

        header('Location:' . APP_URL . "/admin/kardex");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al registrarse.";
        $_SESSION['icono'] = "error";

        header('Location:' . APP_URL . "/admin/kardex/create.php");
    }
} catch (Exception $Exception) {
    print_r($Exception);
}
