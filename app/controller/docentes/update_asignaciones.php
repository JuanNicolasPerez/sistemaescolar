<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_asignacion = $_POST['id_asignacion'];
$id_nivel = $_POST['id_nivel'];
$id_grado = $_POST['id_grado'];
$id_materia = $_POST['id_materia'];

if ($id_nivel == '' || $id_grado == ''|| $id_materia == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    ?>
        <script>
            window.history.back();
        </script>
    <?php
} else {
    $sql = "UPDATE asignaciones 
                    SET nivel_id=:nivel_id, 
                        grado_id=:grado_id, 
                        materia_id=:materia_id, 
                        fyh_actualizacion=:fyh_actualizacion 
                WHERE id_asignacion=:id_asignacion";

    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam('nivel_id', $id_nivel);
    $sentencia->bindParam('grado_id', $id_grado);
    $sentencia->bindParam('materia_id', $id_materia);
    $sentencia->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia->bindParam('id_asignacion', $id_asignacion);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizo de la manera correcta.";
            $_SESSION['icono'] = "success";
    
            header('Location:' . APP_URL . "/admin/docentes/asignacion.php");
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
        print_r($Exception);
    }
}