<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM usuarios AS usu 
                INNER JOIN roles AS rol 
                ON rol.id_rol = usu.rol_id
                INNER  JOIN personas AS pers 
                ON pers.usuario_id = usu.id_usuario
                INNER JOIN docentes AS doc 
                ON doc.persona_id = pers.id_persona
                WHERE doc.estado = '1'";

$query = $pdo->prepare($sql);
$query->execute();

$docentes = $query->fetchAll(PDO::FETCH_ASSOC);
