<?php

// Consultamos a la base de datos
$sql_permisos = "SELECT * FROM permisos 
                    WHERE estado = '1'
                    ORDER BY nombre_url ASC";
$query_permisos = $pdo->prepare($sql_permisos);
$query_permisos->execute();

$permisos = $query_permisos->fetchAll(PDO::FETCH_ASSOC);
