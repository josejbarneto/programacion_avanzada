<?php
    $con = mysqli_connect("localhost","root","");
    if (!$con) {
        die(' No puedo conectar: ' . mysqli_error());
    }
    $db = mysqli_select_db($con,"proyecto_pa");
    
    $result = mysqli_query($con,"SELECT count(*) FROM usuario");
    if (!$result) {
        die('Error al ejecutar la consulta: ' . mysqli_error($con));
    }
    
    foreach ($result as $a){
        $id = $a["count(*)"] + 1;   /*Genera el id del usuario*/
    }
    
    $usuario=$_POST['usuario'];

    /*Comprueba que el usuario se diferente a los que existen*/
    
    $result = mysqli_query($con,"SELECT count(*) FROM usuario WHERE Nombre = '".$usuario."';");
    foreach ($result as $a){
        if($a["count(*)"]!=0){
            echo("El usuario ya existe");
            return false;
        }
    }
    
    /*Crea el hash para guardarlo*/
    
    $contrasena=password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    
    $correo=$_POST['correo'];
    
    $result = mysqli_query($con,"SELECT count(*) FROM usuario WHERE Correo = '".$correo."';");
    foreach ($result as $a){
        if($a["count(*)"]!=0){
            echo("El correo ya existe");
            return false;
        }
    }
    
    /*Inserta el usuario*/
    
    if(mysqli_query($con, "INSERT INTO `usuario` (`ID`, `Nombre`, `Contrasena`, `Descripcion`, `Correo`) VALUES ('".$id."', '".$usuario."', '".$contrasena."', '', '".$correo."');")){
        echo("Usuario suscrito");
    }
    
    mysqli_close($con);
?>