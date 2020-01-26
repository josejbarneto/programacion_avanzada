<?php

include_once '../../basedatos/baseDatos.php';
include_once '../../entidades/preferencias.php';

function crearUsuario($usuario, $contrasena, $email) {
    $con = conectarBaseDatos();
    mysqli_query($con, "INSERT INTO usuario (usuario, contrasenya, email) VALUES ('$usuario', '$contrasena', '$email');");
    
    crearPreferencia($usuario);
    
    mysqli_close($con);
}

function editarUsuario($usuario) {
    $respuesta = [];
    return $respuesta;
}

function mostrarUsuario($usuario) {
    $respuesta = [];
    return $respuesta;
}

function borrarUsuario($usuario) {
    $respuesta = [];
    return $respuesta;
}

function listarUsuarios($usuario) {
    $respuesta = [];
    return $respuesta;
}

function existUsuario($usuario) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT count(*) FROM usuario WHERE usuario = '$usuario';");
    $a = mysqli_fetch_array($result);
    mysqli_close($con);
    if ($a["count(*)"] != 0) {
        echo("El usuario ya existe");
        return true;
    } else {
        return false;
    }
}

function existEmail($usuario, $email) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT count(*) FROM usuario WHERE email = '$email';");
    $a = mysqli_fetch_array($result);
    mysqli_close($con);
    if ($a["count(*)"] != 0) {
        echo("El usuario ya existe");
        return true;
    } else {
        return false;
    }
}

function getUsuario($usuario) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT id, usuario, contrasenya, email FROM usuario WHERE usuario = '$usuario';");
    
    $r = mysqli_fetch_all($result,1)[0];
    print_r($r);
    
    $user['id'] = $r["id"];
    $user['usuario'] = $r["usuario"];
    $user['contrasena'] = $r["contrasenya"];
    $user['email'] = $r["email"];
    
    mysqli_close($con);
    return $user;
}

?>