<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM roles_permisos AS rolper
                INNER JOIN permisos AS per
                ON per.id_permiso = rolper.permiso_id
                INNER JOIN roles AS rol
                ON rol.id_rol = rolper.rol_id
        WHERE rolper.estado = '1'
        ORDER BY per.nombre_url ASC";
$query = $pdo->prepare($sql);
$query->execute();

$roles_Permisos = $query->fetchAll(PDO::FETCH_ASSOC);
