<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM usuarios AS usu 
                INNER JOIN roles AS rol 
                ON rol.id_rol = usu.rol_id
                INNER  JOIN personas AS pers 
                ON pers.usuario_id = usu.id_usuario
                INNER JOIN docentes AS doc 
                ON doc.persona_id = pers.id_persona
                WHERE doc.estado = '1'
                AND doc.id_docente = '$id_docente'";

$query = $pdo->prepare($sql);
$query->execute();

$docentes = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($docentes as $docente) {
    $id_usuario = $docente['id_usuario'];
    $id_persona = $docente['id_persona'];
    $id_docente = $docente['id_docente'];

    $nombres_rol = $docente['nombres_rol'];
    $nombres = $docente['nombres'];
    $apellidos = $docente['apellidos'];
    $dni = $docente['dni'];
    $fecha_nacimiento = $docente['fecha_nacimiento'];
    $celular = $docente['celular'];
    $profesion = $docente['profesion'];
    $email = $docente['email'];
    $direccion = $docente['direccion'];
    $especialidad = $docente['especialidad'];
    $antiguedad = $docente['antiguedad'];
    $fyh_creacion = $docente['fyh_creacion'];
    $estado = $docente['estado'];

}