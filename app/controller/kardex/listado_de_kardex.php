<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM kardexs AS kar 
                INNER JOIN docentes AS doc 
                ON doc.id_docente = kar.docente_id
                INNER JOIN personas AS pers 
                ON pers.id_persona = doc.persona_id
                INNER JOIN usuarios AS usu 
                ON usu.id_usuario = pers.usuario_id
                INNER JOIN materias AS mat 
                ON mat.id_materia = kar.materia_id
                INNER JOIN estudiantes AS est 
                ON est.id_estudiante = kar.estudiante_id
                WHERE kar.estado = '1'";

$query = $pdo->prepare($sql);
$query->execute();

$kardexs = $query->fetchAll(PDO::FETCH_ASSOC);
