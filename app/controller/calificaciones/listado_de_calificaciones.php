<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM calificaciones AS calif
                INNER JOIN materias AS mat
                ON mat.id_materia = calif.materia_id
                WHERE calif.estado = '1'";

$query = $pdo->prepare($sql);
$query->execute();

$calificaciones = $query->fetchAll(PDO::FETCH_ASSOC);