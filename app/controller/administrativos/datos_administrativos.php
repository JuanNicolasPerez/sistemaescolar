<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM usuarios AS usu 
                INNER JOIN roles AS rol 
                ON rol.id_rol = usu.rol_id
                INNER  JOIN personas AS pers 
                ON pers.usuario_id = usu.id_usuario
                INNER JOIN administrativos AS adm 
                ON adm.persona_id = pers.id_persona
                WHERE usu.estado = '1'
                AND adm.id_administrativo = '$id_administrativo'";

$query = $pdo->prepare($sql);
$query->execute();

$administrativos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($administrativos as $administrativo) {
    $id_administrativo = $administrativo['id_administrativo'];
    $id_usuario = $administrativo['id_usuario'];
    $id_persona = $administrativo['id_persona'];

    $nombre_rol = $administrativo['nombres_rol'];
    $nombres = $administrativo['nombres'];
    $apellidos = $administrativo['apellidos'];
    $dni = $administrativo['dni'];
    $fecha_nacimiento = $administrativo['fecha_nacimiento'];
    $celular = $administrativo['celular'];
    $profesion = $administrativo['profesion'];
    $email = $administrativo['email'];
    $direccion = $administrativo['direccion'];
    $fechayhoracreacion = $administrativo['fyh_creacion'];
    $estado = $administrativo['estado'];
}