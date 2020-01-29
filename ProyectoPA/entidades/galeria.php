<?php

include_once '../../basedatos/baseDatos.php';

function crearGaleria($id_usuario, $id_post, $ficherourl, $tipo, $fichourl) {   //$fichourl define si es un fichero o una url 0 fichero 1 url
     $conn = conectarBaseDatos();
     
     if($fichourl==0){  //fichero
         $consulta="insert into galeria (id_usuario, id_post, nombre_fichero, tipo) VALUES ($id_usuario, $id_post, '$ficherourl', '$tipo');";
         mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
     }
     elseif($fichourl==1){  //url
         $consulta="insert into galeria (id_usuario, id_post, url, tipo) VALUES ($id_usuario, $id_post, '$ficherourl', '$tipo');";
         mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
     }
     
     
     
     mysqli_close($conn);
}

function editarGaleria($id_post, $ficherourl, $tipo, $fichourl) {
    $conn = conectarBaseDatos();
    
    $consulta="UPDATE `galeria` SET nombre_fichero='', url='' WHERE id_post = $id_post;";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
     if($fichourl==0){  //fichero
         $consulta="UPDATE `galeria` SET nombre_fichero='$ficherourl', tipo='$tipo' WHERE id_post = $id_post;";
         mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
     }
     elseif($fichourl==1){  //url
         $consulta="UPDATE `galeria` SET url='$ficherourl', tipo='$tipo' WHERE id_post = $id_post;";
         mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
     }
    
    mysqli_close($conn);
}

function mostrarGaleria($galeria) {
    $respuesta = [];
    return $respuesta;
}

function borrarGaleria($galeria) {
    $respuesta = [];
    return $respuesta;
}

function listarGaleriaPorCategoria($categoria) {
    $respuesta = [];
    return $respuesta;
}

function listarGaleriaPorUsuario($usuario) {
    $respuesta = [];
    return $respuesta;
}

?>