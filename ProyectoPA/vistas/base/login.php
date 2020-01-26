<?php
    include_once '../../BaseDeDatos/baseDatos.php';
    $con = conectarBaseDatos();
    
    $user = $_POST['lusuario'];
    $pass = $_POST['lpass'];
    
    $result = mysqli_query($con, "SELECT contrasenya FROM usuario WHERE usuario='$user';");
    $dbPass = mysqli_fetch_array($result);
    
    if(!empty($dbpass)){
        $result = mysqli_query($con, "SELECT * FROM usuario WHERE usuario='$user';");
        $usuarioCompleto = mysqli_fetch_array($result);
        
        $result = mysqli_query($con, "SELECT * FROM preferencias WHERE id_usuario = (select id from usuario where usuario = '$user');");
        $preferencias = mysqli_fetch_array($result);
    }
    
    mysqli_close($con);
    
    echo "$pass</br>";
    echo "{$dbPass['contrasenya']}";
    
    //if(password_verify($pass, $dbPass['contrasenya'])){
        session_start();
        $_SESSION["usuario"]= $usuarioCompleto;
        $_SESSION['preferencias']=$preferencias;
        header('Location: principal.php');
    //}
    
    