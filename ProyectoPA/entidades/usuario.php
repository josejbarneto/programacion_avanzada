<?php

include_once '../../basedatos/baseDatos.php';
include_once '../../entidades/preferencias.php';

function crearUsuario($usuario, $contrasena, $email, $nombre) {
    $con = conectarBaseDatos();
    mysqli_query($con, "INSERT INTO usuario (usuario, contrasenya, email, nombre) VALUES ('$usuario', '$contrasena', '$email', '$nombre');");
    
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
        return true;
    } else {
        return false;
    }
}

function existEmail($email) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT count(*) FROM usuario WHERE email = '$email';");
    $a = mysqli_fetch_array($result);
    mysqli_close($con);
    if ($a["count(*)"] != 0) {
        return true;
    } else {
        return false;
    }
}

function getUsuario($usuario) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT id, usuario, contrasenya, email FROM usuario WHERE id = '$usuario';");
    
    $r = mysqli_fetch_all($result,1)[0];
    
    $user['id'] = $r["id"];
    $user['usuario'] = $r["usuario"];
    $user['contrasena'] = $r["contrasenya"];
    $user['email'] = $r["email"];
    
    mysqli_close($con);
    return $user;
}

?>