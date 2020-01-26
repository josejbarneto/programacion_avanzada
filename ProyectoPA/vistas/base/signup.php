<?php
    include_once '../../entidades/usuario.php';
    include_once '../../entidades/preferencias.php';
    
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL);
       
    /*Comprueba que el usuario es diferente a los que existen*/
    if(!existUsuario($usuario)){
        
        /*Crea el hash para guardarlo*/
        $contrasena=password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        
         /*Comprueba que el email es diferente a los que existen*/
        if(!existEmail($usuario, $correo)){
            crearUsuario($usuario, $contrasena, $correo);
            session_start();
            $_SESSION['usuario']= getUsuario($usuario);
            $_SESSION['preferencias'] = getPreferenciasDeUsuario($_SESSION['usuario']['id']);
            header('Location: principal.php');
        }
    }
    
    ?>