<?php
//CONEXION BASE DE DATOS 
include('../app/config.php');

session_start();

if (isset($_SESSION['session_email'])) {
    session_destroy();

    header("location:" . APP_URL . "/login");
}
