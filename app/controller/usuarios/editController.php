<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM usuarios 
                AS usu  
                INNER JOIN roles 
                AS rol 
                ON rol.id_rol = usu.rol_id
                WHERE usu.estado = '1'
                AND usu.id_usuario = '$id_usuario'";

$query_usuarios = $pdo->prepare($sql);
$query_usuarios->execute();

$usuarios = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $nombre_rol = $usuario['nombres_rol'];
    $correo = $usuario['email'];
    $fechayhoracreacion = $usuario['fyh_creacion'];
    $estado = $usuario['estado'];
}