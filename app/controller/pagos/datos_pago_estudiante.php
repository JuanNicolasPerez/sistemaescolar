<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM pagos
                WHERE estado = '1'
                AND   estudiante_id = $id_estudiante";

$query = $pdo->prepare($sql);
$query->execute();

$pagos = $query->fetchAll(PDO::FETCH_ASSOC);