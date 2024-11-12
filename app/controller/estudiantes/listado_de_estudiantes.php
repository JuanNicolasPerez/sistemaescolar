<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM usuarios AS usu 
                INNER JOIN roles AS rol 
                ON rol.id_rol = usu.rol_id
                INNER  JOIN personas AS pers 
                ON pers.usuario_id = usu.id_usuario
                INNER JOIN estudiantes AS est 
                ON est.persona_id = pers.id_persona
                INNER JOIN niveles AS niv 
                ON niv.id_nivel = est.nivel_id
                INNER JOIN grados AS gra 
                ON gra.id_grado = est.grado_id
                INNER JOIN ppffs AS pf
                ON pf.estudiante_id = est.id_estudiante
                WHERE est.estado = '1'";

$query = $pdo->prepare($sql);
$query->execute();

$estudiantes = $query->fetchAll(PDO::FETCH_ASSOC);
