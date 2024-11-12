<?php
    include('../app/config.php');

    $email = $_POST['correo_login'];
    $password = $_POST['contraseña_login'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND estado = '1'";
    $query = $pdo->prepare($sql);
    $query->execute();

    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    $contador = 0;

    foreach ($usuarios as $usuario) {
        $passwordEncriptado = $usuario['password'];
        $contador = $contador + 1;
    }

    if (($contador > 0) && (password_verify($password, $passwordEncriptado))) {
        session_start();
        $_SESSION['mensaje'] = "Bienvenido al sistema.";
        $_SESSION['icono'] = "success";
        $_SESSION['session_email'] = $email;
        
        header('Location:' . APP_URL . "/admin");
    } else {
        session_start();
        $_SESSION['mensaje'] = "Los datos son incorrectos, vuelva a intentarlo.";
        header('Location:' . APP_URL . "/login");
    }
