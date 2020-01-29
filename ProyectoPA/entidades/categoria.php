<?php
include_once '../../basedatos/baseDatos.php';

function crearCategoria($categoria) {
    $respuesta = [];
    return $respuesta;
}

function editarCategoria($categoria) {
    $respuesta = [];
    return $respuesta;
}

function mostrarCategoria($categoria) {
    $respuesta = [];
    return $respuesta;
}

function borrarCategoria($categoria) {
    $respuesta = [];
    return $respuesta;
}

function listarCategorias($categoria) {
    $respuesta = [];
    return $respuesta;
}

function listarCategoriasPorUsuario($usuario) {
    $respuesta = [];
    return $respuesta;
}

function getCategorias(){
    $con = conectarBaseDatos();
    $consulta = "select * from categoria";   
    $resultado = mysqli_query($con, $consulta) or die("Algo ha ido mal en la consulta a la base de datos"); 

    mysqli_close($con);
    
    $i=0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $categorias[$i]['id'] = $columna['id'];
        $categorias[$i]['nombre'] = $columna['nombre'];
        $categorias[$i]['descripcion'] = $columna['descripcion'];
        $i++;
    } 
    
    return $categorias;
}

?>