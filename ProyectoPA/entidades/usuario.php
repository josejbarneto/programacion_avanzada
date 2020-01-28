<?php

include_once '../../basedatos/baseDatos.php';
include_once '../../entidades/preferencias.php';

function crearUsuario($usuario, $contrasena, $email, $nombre) {
    $con = conectarBaseDatos();
    mysqli_query($con, "INSERT INTO usuario (usuario, contrasenya, email, nombre) VALUES ('$usuario', '$contrasena', '$email', '$nombre');");
    
    crearPreferencia($usuario);
    
    mysqli_close($con);
}

function editarUsuario($id,$nombre,$email,$pass) {
    $conn = conectarBaseDatos();
    
    $consulta = "UPDATE usuario SET nombre = '$nombre', email='$email', contrasenya='$pass' WHERE id = $id;";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
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
    $result = mysqli_query($con, "SELECT id, usuario, nombre, contrasenya, email FROM usuario WHERE usuario = '$usuario';");
    
    $r = mysqli_fetch_array($result);
    
    $user['id'] = $r["id"];
    $user['usuario'] = $r["usuario"];
    $user['contrasena'] = $r["contrasenya"];
    $user['email'] = $r["email"];
    $user['nombre'] = $r["nombre"];
    
    mysqli_close($con);
    return $user;
}

function getUsuarioById($usuario) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT id, usuario, nombre, contrasenya, email FROM usuario WHERE id = $usuario;");
    
    $r = mysqli_fetch_array($result);
    
    $user['id'] = $r["id"];
    $user['usuario'] = $r["usuario"];
    $user['contrasena'] = $r["contrasenya"];
    $user['email'] = $r["email"];
    $user['nombre'] = $r["nombre"];
    
    mysqli_close($con);
    return $user;
}



?>