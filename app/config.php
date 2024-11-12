<?php

    // VARIABLES GLOBALES
    define('SERVIDOR', 'localhost');
    define('USUARIO', 'root');
    define('PASSWORD', '');
    define('BD', 'sisgestionescolar');

    define('APP_NAME', 'SISTEMA DE GESTION ESCOLAR');
    define('APP_URL', 'http://localhost/sisgestionescolar');
    define('KEY_API_MAPS', '');

    $servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

    try {
        $pdo = new PDO(
            $servidor,
            USUARIO,
            PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );

    } catch (PDOException $e) {
        print_r($e);
    }

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $fechaHora = date('Y-m-d H:i:s');

    $fechaActual = date('Y-m-d');
    $diaActual = date('d');
    $mesActual = date('m');
    $yearActual = date('Y');

    $estado_registro = '1';
