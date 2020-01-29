<?php
include_once '../../basedatos/baseDatos.php';

function crearCategoria($nombre, $descripcion) {
    $conn = conectarBaseDatos();

    $consulta = "insert into categoria (id, nombre, descripcion) VALUES (
    (
        (select id from (select id from categoria) subquery order by id desc limit 1)
    )+1
   ,'$nombre','$descripcion');"; //coge el id de la anterior y le suma 1
    
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    mysqli_close($conn);
}

function editarCategoria($categoria) {
    $respuesta = [];
    return $respuesta;
}

function borrarCategoria($categoria) {
    $conn = conectarBaseDatos();

    //borras la categoria
    $consulta = "DELETE FROM categoria WHERE id = $categoria;";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    //seleccionas todos las las categorias cuyo id es mayor que la categoria borrada
    $consulta = "select * from categoria WHERE id > $categoria;";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    //le restas 1 a todos los ids previamente seleccionados
    while ($categoria = mysqli_fetch_array($resultado)) {        
        $consulta = "update categoria set id = ({$categoria['id']}-1) where id = {$categoria['id']};";
        mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
        }
    
    mysqli_close($conn);
}

function getCategorias(){
    $con = conectarBaseDatos();
    $consulta = "select * from categoria";   
    $resultado = mysqli_query($con, $consulta) or die("Algo ha ido mal en la consulta a la base de datos 1"); 

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