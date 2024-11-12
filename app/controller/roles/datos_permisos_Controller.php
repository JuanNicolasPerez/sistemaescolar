<?php

// Consultamos a la base de datos
$sql = "SELECT * FROM permisos WHERE estado = '1' AND id_permiso = '$id_permiso'";

$query = $pdo->prepare($sql);
$query->execute();

$permisos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($permisos as $permiso) {
    $nombre_url = $permiso['nombre_url'];
    $url = $permiso['url'];
}
