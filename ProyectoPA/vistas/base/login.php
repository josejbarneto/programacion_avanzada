<?php

include_once '../../basedatos/baseDatos.php';
$con = conectarBaseDatos();

$user = filter_input(INPUT_POST, 'lusuario', FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, 'lpass', FILTER_SANITIZE_STRING);

$result = mysqli_query($con, "SELECT contrasenya FROM usuario WHERE usuario='$user';");
$dbPass = mysqli_fetch_array($result);

if(empty(dbPass) || !password_verify($pass, $dbPass['contrasenya'])){
    $errores[]='Usuario o contraseña incorrectos';
}

if(!isset($errores)){
    $result = mysqli_query($con, "SELECT * FROM usuario WHERE usuario='$user';");
    $usuarioCompleto = mysqli_fetch_array($result);

    $result = mysqli_query($con, "SELECT * FROM preferencias WHERE id_usuario = (select id from usuario where usuario = '$user');");
    $preferencias = mysqli_fetch_array($result);
    mysqli_close($con);

    session_start();
    $_SESSION['usuario'] = $usuarioCompleto;
    $_SESSION['preferencias'] = $preferencias;
    header('Location: ../../vistas/base/principal.php');
}else{
    session_start();
    $_SESSION['intentoLogin']=TRUE;
    $_SESSION['errores']=$errores; 
    header('Location: ../../vistas/base/principal.php');
}

    