<?php

include_once '../../entidades/usuario.php';
include_once '../../entidades/preferencias.php';
$con = conectarBaseDatos();

$user = filter_input(INPUT_POST, 'lusuario', FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, 'lpass', FILTER_SANITIZE_STRING);

$result = mysqli_query($con, "SELECT contrasenya FROM usuario WHERE usuario='$user';");
$dbPass = mysqli_fetch_array($result);

if(empty($dbPass) || !password_verify($pass, $dbPass['contrasenya'])){
    $errores[]='Usuario o contraseña incorrectos';
}

if(!isset($errores)){
    session_start();
    
    $_SESSION['usuario']= getUsuario($user);
    $_SESSION['preferencias'] = getPreferenciasDeUsuario($_SESSION['usuario']['id']);
    header('Location: ../../vistas/base/principal.php');
}else{
    session_start();
    $_SESSION['intentoLogin']=TRUE;
    $_SESSION['errores']=$errores; 
    header('Location: ../../vistas/base/principal.php');
}

    