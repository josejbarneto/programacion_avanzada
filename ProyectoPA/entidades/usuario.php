<?php

include_once '../../basedatos/baseDatos.php';
include_once '../../entidades/preferencias.php';

function crearUsuario($usuario, $contrasena, $email, $nombre) {
    $con = conectarBaseDatos();
    mysqli_query($con, "INSERT INTO usuario (usuario, contrasenya, email, nombre, admin) VALUES ('$usuario', '$contrasena', '$email', '$nombre', 0);");
    
    crearPreferencia($usuario);
    
    mysqli_close($con);
}

function editarUsuario($id,$nombre,$email,$pass) {
    $conn = conectarBaseDatos();
    
    $consulta = "UPDATE usuario SET nombre = '$nombre', email='$email', contrasenya='$pass' WHERE id = $id;";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function borrarUsuario($usuario) {
    $conn = conectarBaseDatos();
    
    $consulta = "DELETE FROM usuario WHERE id = $usuario;";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
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
    $result = mysqli_query($con, "SELECT admin, id, usuario, nombre, contrasenya, email FROM usuario WHERE usuario = '$usuario';");
    
    $r = mysqli_fetch_array($result);
    
    $user['admin'] = $r["admin"];
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
    $result = mysqli_query($con, "SELECT admin, id, usuario, nombre, contrasenya, email FROM usuario WHERE id = $usuario;") or die("$usuario");
    
    $r = mysqli_fetch_array($result);
    
    $user['admin'] = $r["admin"];
    $user['id'] = $r["id"];
    $user['usuario'] = $r["usuario"];
    $user['contrasena'] = $r["contrasenya"];
    $user['email'] = $r["email"];
    $user['nombre'] = $r["nombre"];
    
    mysqli_close($con);
    return $user;
}

function getAllUsuarios(){
    $conn = conectarBaseDatos();

    $consulta = "SELECT admin, id, usuario, nombre, contrasenya, email FROM usuario;";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos 1");

    $i = 0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $usuarios[$i]['admin'] = $columna['admin'];
        $usuarios[$i]['id'] = $columna['id'];
        $usuarios[$i]['usuario'] = $columna['usuario'];
        $usuarios[$i]['email'] = $columna['email'];
        $usuarios[$i]['nombre'] = $columna['nombre'];
        $i++;
    }

    mysqli_close($conn);
    
    if(isset($usuarios)){
        return $usuarios;
    }else{
        return false;
    }
}

?>