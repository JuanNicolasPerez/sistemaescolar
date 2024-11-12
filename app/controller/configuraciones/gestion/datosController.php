<?php

// Consultamos a la base de datos
$sql_gestion = "SELECT * FROM gestiones 
                WHERE id_gestion  = '$id_gestion'";

$query_gestion = $pdo->prepare($sql_gestion);
$query_gestion->execute();

$gestiones = $query_gestion->fetchAll(PDO::FETCH_ASSOC);

foreach ($gestiones as $gestion) {
    $gestion_dato = $gestion['gestion'];
    $estado = $gestion['estado'];
    $fyh_creacion = $gestion['fyh_creacion'];
}