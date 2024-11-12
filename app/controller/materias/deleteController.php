<?php
    // INCLUIMOS LA CONEXXION A BD
    include('../../../app/config.php');

    $id_materia = $_POST['id_materia'];

    // Consultamos a la base de datos
    $sql = "DELETE FROM materias 
                    WHERE id_materia =:id_materia";

    $sentencia = $pdo->prepare($sql);

    $sentencia->bindParam(':id_materia', $id_materia);

    try {
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se elimino de la manera correcta.";
            $_SESSION['icono'] = "success";

            header('Location:' . APP_URL . "/admin/materias");
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
