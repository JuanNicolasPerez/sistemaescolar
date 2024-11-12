<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM usuarios AS usu 
                INNER JOIN roles AS rol 
                ON rol.id_rol = usu.rol_id
                INNER  JOIN personas AS pers 
                ON pers.usuario_id = usu.id_usuario
                INNER JOIN administrativos AS adm 
                ON adm.persona_id = pers.id_persona
                WHERE usu.estado = '1'";

$query = $pdo->prepare($sql);
$query->execute();

$administrativos = $query->fetchAll(PDO::FETCH_ASSOC);
