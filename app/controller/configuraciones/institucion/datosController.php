<?php
// RECIBIMOS EL ID DESDE LA RUTA URL
$id_config_institucion = $_GET['id'];

// Consultamos a la base de datos
$sql_instituciones = "SELECT * FROM configuracion_instituciones WHERE id_config_institucion  = '$id_config_institucion' AND estado = '1'";
$query_instituciones = $pdo->prepare($sql_instituciones);
$query_instituciones->execute();

$instituciones = $query_instituciones->fetchAll(PDO::FETCH_ASSOC);

foreach ($instituciones as $institucion) {
    $nombre_institucion = $institucion['nombre_institucion'];

    $correo = $institucion['correo'];
    $direccion = $institucion['direccion'];
    $telefono = $institucion['telefono'];
    $celular = $institucion['celular'];
    $logo = $institucion['logo'];
}
