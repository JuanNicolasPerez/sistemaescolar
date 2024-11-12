<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM asignaciones AS asig 
                INNER JOIN docentes AS doc 
                ON doc.id_docente = asig.docente_id
                INNER JOIN personas AS pers 
                ON pers.id_persona = doc.persona_id
                INNER JOIN usuarios AS usu 
                ON usu.id_usuario = pers.usuario_id
                INNER  JOIN niveles AS niv 
                ON niv.id_nivel= asig.nivel_id
                INNER JOIN grados AS gra 
                ON gra.id_grado = asig.grado_id
                INNER JOIN materias AS mat 
                ON mat.id_materia = asig.materia_id
                WHERE asig.estado = '1'";

$query = $pdo->prepare($sql);
$query->execute();

$asignaciones = $query->fetchAll(PDO::FETCH_ASSOC);
