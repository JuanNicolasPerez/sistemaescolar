<?php

// Consultamos a la base de datos
$sql = "SELECT *, est.nivel_id AS nivel_id, est.grado_id AS grado_id FROM usuarios AS usu 
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
                WHERE est.id_estudiante = '$id_estudiante'
                AND est.estado = '1'";

$query = $pdo->prepare($sql);
$query->execute();

$estudiantes = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($estudiantes as $estudiante) {
    // <!-- IDENTIFICADORES -->
    $id_usuario = $estudiante['id_usuario'];
    $id_estudiante = $estudiante['id_estudiante'];
    $id_persona = $estudiante['id_persona'];
    $id_ppff = $estudiante['id_ppff'];

    // <!-- DATOS DEL ESTUDIANTE -->
    $rol_id = $estudiante['rol_id'];
    $nombres_rol = $estudiante['nombres_rol'];
    $nombres = $estudiante['nombres'];
    $apellidos = $estudiante['apellidos'];
    $dni = $estudiante['dni'];
    $fecha_nacimiento = $estudiante['fecha_nacimiento'];
    $email = $estudiante['email'];
    $direccion = $estudiante['direccion'];
    $celular = $estudiante['celular'];

    // <!-- DATOS ACADEMICOS -->
    $nivel_id = $estudiante['nivel_id'];
    $nivel = $estudiante['nivel'];
    $turno = $estudiante['turno'];
    $grado_id = $estudiante['grado_id'];
    $curso = $estudiante['curso'];
    $paralelo = $estudiante['paralelo'];
    $legajo = $estudiante['legajo'];

    // <!-- DATOS DE LOS PADRES -->
    $nombre_apellidos = $estudiante['nombre_apellidos'];
    $dni_ppff = $estudiante['dni_ppff'];
    $celular_ppff = $estudiante['celular_ppff'];
    $ocupacion = $estudiante['ocupacion'];

    // <!-- DATOS DEL AUTORIZADO -->
    $ref_nombre = $estudiante['ref_nombre'];
    $ref_parentezco = $estudiante['ref_parentezco'];
    $ref_celular = $estudiante['ref_celular'];

    // <!-- DATOS DE CREACION -->
    $estado = $estudiante['estado'];
    $fyh_creacion = $estudiante['fyh_creacion'];

}