<?php
    include_once '../../BaseDeDatos/baseDatos.php';
    $con = conectarBaseDatos();
    
    $user = $_POST['lusuario'];
    $pass = $_POST['lpass'];
    
    $result = mysqli_query($con, "SELECT Contrasena` FROM `usuario` WHERE `Nombre`='".$user."';");
    
    if(password_verify($pass, $result['Contrasena'])){
        header('principal.php');
    }
    
    
    mysqli_close($con);