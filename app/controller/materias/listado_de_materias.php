<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM materias
                WHERE estado = '1'";
$query = $pdo->prepare($sql);
$query->execute();

$materias = $query->fetchAll(PDO::FETCH_ASSOC);
