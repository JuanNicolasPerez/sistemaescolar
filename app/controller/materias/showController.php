<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM materias 
                WHERE id_materia = '$id_materia'";
$query = $pdo->prepare($sql);
$query->execute();

$materias = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($materias as $materia) {
    $id_materia = $materia['id_materia'];
    $nombre_materia = $materia['nombre_materia'];
    $fyh_creacion = $materia['fyh_creacion'];
    $estado = $materia['estado'];
}