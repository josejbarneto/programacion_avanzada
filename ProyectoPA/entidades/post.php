<?php

include_once '../../basedatos/baseDatos.php';

function crearPost($idUsuario, $idCategoria, $texto) {
    $conn = conectarBaseDatos();

    $fechaEnvio = getdate();
    
    $consulta = "insert into post (id_usuario, id_categoria, texto, fecha_creacion) VALUES ('$idUsuario', '$idCategoria', '$texto', '$fechaEnvio');";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function editarPost($idPost, $texto) {
    $conn = conectarBaseDatos();
    
    $consulta = "UPDATE post SET texto = '$texto' WHERE id = $idPost;";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function mostrarPost($post){
    echo '<div>';
    echo "<div>{$post['idUsuario']}</div><br/>";
    echo "<div>{$post['texto']}</div>";
    echo '<div>';
}

function borrarPost($post) {
    $conn = conectarBaseDatos();

    $fechaEnvio = getdate();
    
    $consulta = "DELETE FROM post WHERE id = $idPost;";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function listarPostsPorCategoria($categoria) {
    $conn = conectarBaseDatos();
    
    $consulta = "select id, id_usuario, id_categoria, texto, fecha_creacion from post where id_categoria = (select id_categoria from categoria where nombre = '$categoria') order by fecha_creacion DESC;";   
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos"); 

    mysqli_close($conn);
    
    while ($columna = mysqli_fetch_array($resultado)) {
        $posts['id'] = $columna['id'];
        $posts['idUsuario'] = $columna['id_usuario'];
        $posts['idCategoria'] = $columna['id_categoria'];
        $posts['texto'] = $columna['texto'];
        $posts['fechaCreacion'] = $columna['fecha_creacion'];   
    }
    
    foreach($posts as $post){
        mostrarPost($post);
    }
}

function listarPostsPorUsuario($usuario) {
    $conn = conectarBaseDatos();
    
    $consulta = "select id, id_usuario, id_categoria, texto, fecha_creacion from post where id_usuario = $usuario order by fecha_creacion DESC;";   
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos"); 

    mysqli_close($conn);
    
    while ($columna = mysqli_fetch_array($resultado)) {
        $posts['id'] = $columna['id'];
        $posts['idUsuario'] = $columna['id_usuario'];
        $posts['idCategoria'] = $columna['id_categoria'];
        $posts['texto'] = $columna['texto'];
        $posts['fechaCreacion'] = $columna['fecha_creacion'];   
    }
    
    foreach($posts as $post){
        mostrarPost($post);
    }
}

?>