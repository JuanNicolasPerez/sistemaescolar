<?php

// INCLUIMOS LA CONEXXION A BD
include('../../../app/config.php');

$id_docente = $_GET['id_docente'];
$id_estudiante = $_GET['id_estudiante'];
$id_materia = $_GET['id_materia'];
$nota1 = $_GET['nota1'];
$nota2 = $_GET['nota2'];
$nota3 = $_GET['nota3'];

// CONSULTAMOS SI HAY DATOS
$sql_consulta = "SELECT * FROM calificaciones 
                WHERE docente_id = '$id_docente' 
                AND estudiante_id = '$id_estudiante'
                AND materia_id  = '$id_materia'";
$sentencia = $pdo->prepare($sql_consulta);
$sentencia->execute();

$notas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

foreach ($notas as $nota) {
    $id_calificacion= $nota['id_calificacion'];
}

if ($notas) {

    $sql_update= "UPDATE calificaciones 
                            SET nota1=:nota1,
                                nota2=:nota2,
                                nota3=:nota3,
                                fyh_actualizacion=:fyh_actualizacion
                            WHERE  id_calificacion=:id_calificacion";
    $sentencia = $pdo->prepare($sql_update);

    $sentencia->bindParam(':nota1', $nota1);
    $sentencia->bindParam(':nota2', $nota2);
    $sentencia->bindParam(':nota3', $nota3);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':id_calificacion', $id_calificacion);
    $sentencia->execute();

} else {

    $sql_insert = "INSERT INTO calificaciones (docente_id, 
                                                estudiante_id, 
                                                materia_id, 
                                                nota1,
                                                nota2,
                                                nota3, 
                                                fyh_creacion, 
                                                estado) 
                            VALUES ( :docente_id, 
                                    :estudiante_id, 
                                    :materia_id, 
                                    :nota1,
                                    :nota2,
                                    :nota3, 
                                    :fyh_creacion, 
                                    :estado)";
    $sentencia = $pdo->prepare($sql_insert);

    $sentencia->bindParam(':docente_id', $id_docente);
    $sentencia->bindParam(':estudiante_id', $id_estudiante);
    $sentencia->bindParam(':materia_id', $id_materia);
    $sentencia->bindParam(':nota1', $nota1);
    $sentencia->bindParam(':nota2', $nota2);
    $sentencia->bindParam(':nota3', $nota3);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->bindParam(':estado', $estado_registro);
    $sentencia->execute();
}
