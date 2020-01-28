<?php
    include_once '../../entidades/usuario.php';
    include_once '../../entidades/preferencias.php';
    
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $pass = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING);
       
    if(existUsuario($usuario)){
        $errores[] = 'El usuario ya existe';
    }
    
    if(existEmail($correo)){
        $errores[] = 'El correo ya existe';
    }
    
    if(!preg_match("/^[a-zA-Z0-9_-]{5,16}$/", $usuario)){
        $errores[] = 'Usuario incorrecto';
    }
    
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Error en el correo";
    }
    
    if(!preg_match("/^[a-zA-Z0-9_-]{7,20}$/", $pass)){
        $errores[] = "Error en la contraseña";
    }
    
    
    
    if(!empty($nombre) && empty($errores)){
        $contrasena=password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        crearUsuario($usuario, $contrasena, $correo, $nombre);
        session_start();
        $_SESSION['usuario']= getUsuario($usuario);
        $_SESSION['preferencias'] = getPreferenciasDeUsuario($_SESSION['usuario']['id']);
        header('Location: principal.php');
    }else{
        session_start();
        $_SESSION['intentoSignup']=TRUE;
        $_SESSION['errores']=$errores; 
        header('Location: principal.php');
    }
    ?>