<?php
// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_docente = $_POST['id_docente'];
$id_nivel = $_POST['id_nivel'];
$id_grado = $_POST['id_grado'];
$id_materia = $_POST['id_materia'];

if ($id_docente == ''|| $id_nivel == '' || $id_grado == ''|| $id_materia == '') {
    session_start();
    $_SESSION['mensaje'] = "Verifique los datos.";
    $_SESSION['icono'] = "error";

    ?>
        <script>
            window.history.back();
        </script>
    <?php
} else {
    $sql = "INSERT INTO asignaciones 
                        (docente_id, nivel_id, grado_id, materia_id, fyh_creacion, estado) 
                VALUES (:docente_id, :nivel_id, :grado_id, :materia_id, :fyhcreacion, :estado)";

    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam('docente_id', $id_docente);
    $sentencia->bindParam('nivel_id', $id_nivel);
    $sentencia->bindParam('grado_id', $id_grado);
    $sentencia->bindParam('materia_id', $id_materia);
    $sentencia->bindParam('fyhcreacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_registro);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se registro de la manera correcta.";
            $_SESSION['icono'] = "success";
    
            header('Location:' . APP_URL . "/admin/docentes/asignacion.php");
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
        print_r($Exception);
    }
}