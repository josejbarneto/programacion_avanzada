<?php
    include_once '../../entidades/usuario.php';
    include_once '../../entidades/preferencias.php';
    
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
       
    if(existUsuario($usuario)){
        $errores[] = 'El usuario ya existe';
    }
    
    if(existEmail($correo)){
        $errores[] = 'El correo ya existe';
    }
    
    if(!empty($nombre) && empty($errores)){
        $contrasena=password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        crearUsuario($usuario, $contrasena, $correo);
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