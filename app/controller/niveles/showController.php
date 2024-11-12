<?php

// Consultamos a la base de datos
$sql_niveles = "SELECT * FROM niveles as niv
                        INNER JOIN gestiones AS ges
                        ON niv.gestion_id = ges.id_gestion
                WHERE niv.id_nivel = '$id_nivel'
                AND niv.estado = '1'";
$query_niveles = $pdo->prepare($sql_niveles);
$query_niveles->execute();

$niveles = $query_niveles->fetchAll(PDO::FETCH_ASSOC);

foreach ($niveles as $nivel) {
    $gestion_id = $nivel['gestion_id'];
    $gestion = $nivel['gestion'];
    $nivel_edu = $nivel['nivel'];
    $turno = $nivel['turno'];
    $fyh_creacion = $nivel['fyh_creacion'];
    $estado = $nivel['estado'];
}