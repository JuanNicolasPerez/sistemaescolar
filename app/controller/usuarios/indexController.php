<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM usuarios 
                AS usu  
                INNER JOIN roles 
                AS rol 
                ON usu.rol_id = rol.id_rol
                WHERE usu.estado = '1'";

$query_usuarios = $pdo->prepare($sql);
$query_usuarios->execute();

$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);
