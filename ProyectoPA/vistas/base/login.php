<?php
    $con = mysqli_connect("localhost","root","");
    if (!$con) {
        die(' No puedo conectar: ' . mysqli_error());
    }
    $db = mysqli_select_db($con,"proyecto_pa");
    
    $user = $_POST['lusuario'];
    $pass = $_POST['lpass'];
    
    $result = mysqli_query($con, "SELECT `Contrasena` FROM `usuario` WHERE `Nombre`='".$user."';");
    
    foreach($result as $a){
        if(password_verify($pass, $a['Contrasena'])){
           echo("Contraseña correcta");
        }
    }
    
    mysqli_close($con);