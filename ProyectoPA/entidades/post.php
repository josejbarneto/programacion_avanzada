<?php

include_once '../../basedatos/baseDatos.php';

function crearPost($idUsuario, $idCategoria, $titulo, $texto) {
    $conn = conectarBaseDatos();

    $fechaEnvio = date_create();
    $fecha = date_format($fechaEnvio, 'Y-m-d H:i:s');

    echo "$idUsuario, $idCategoria, $titulo, $texto, $fecha";

    $consulta = "insert into post (id_usuario, id_categoria, titulo, texto, fecha_creacion) VALUES ($idUsuario, $idCategoria, '$titulo', '$texto', '$fecha');";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function editarPost($idPost, $categoria, $titulo, $texto) {
    $conn = conectarBaseDatos();

    $consulta = "UPDATE post SET texto = '$texto', id_categoria = '$categoria', titulo='$titulo' WHERE id = $idPost;";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function mostrarPost($post) {
    echo '<div>';
    echo "<div>{$post['idUsuario']}</div><br/>";
    echo "<div>{$post['texto']}</div>";
    echo '<div>';
}

function borrarPost($idPost) {
    $conn = conectarBaseDatos();

    $consulta = "DELETE FROM post WHERE id = $idPost;";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function listarPostsPorCategoria($categoria) {
    $conn = conectarBaseDatos();

    $consulta = "select * from post where id_categoria = $categoria order by fecha_creacion DESC;";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    $i = 0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $posts[$i]['id'] = $columna['id'];
        $posts[$i]['idUsuario'] = $columna['id_usuario'];
        $posts[$i]['idCategoria'] = $columna['id_categoria'];
        $posts[$i]['titulo'] = $columna['titulo'];
        $posts[$i]['texto'] = $columna['texto'];
        $posts[$i]['fechaCreacion'] = $columna['fecha_creacion'];
        $i++;
    }
    mysqli_close($conn);
    if (isset($posts)) {
        return $posts;
    } else {
        return false;
    }
}

function listarPostsPorUsuario($usuario) {
    $conn = conectarBaseDatos();

    $consulta = "select * from post where id_usuario = $usuario order by fecha_creacion DESC;";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    $i = 0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $posts[$i]['id'] = $columna['id'];
        $posts[$i]['idUsuario'] = $columna['id_usuario'];
        $posts[$i]['idCategoria'] = $columna['id_categoria'];
        $posts[$i]['titulo'] = $columna['titulo'];
        $posts[$i]['texto'] = $columna['texto'];
        $posts[$i]['fechaCreacion'] = $columna['fecha_creacion'];
        $i++;
    }

    mysqli_close($conn);
    return $posts;
}

function getPost($idPost) {
    $conn = conectarBaseDatos();

    $consulta = "select post.id, post.id_usuario, post.id_categoria, post.titulo, post.texto, post.fecha_creacion, usuario.usuario, usuario.nombre, categoria.nombre as nombre_cat from post inner join usuario on post.id_usuario = usuario.id inner join categoria on post.id_categoria = categoria.id where post.id = $idPost;";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    $columna = mysqli_fetch_array($resultado);

    $post['id'] = $columna['id'];
    $post['idUsuario'] = $columna['id_usuario'];
    $post['idCategoria'] = $columna['id_categoria'];
    $post['titulo'] = $columna['titulo'];
    $post['texto'] = $columna['texto'];
    $post['fechaCreacion'] = $columna['fecha_creacion'];
    $post['nombreUsuario'] = $columna['nombre'];
    $post['usuario'] = $columna['usuario'];
    $post['categoria'] = $columna['nombre_cat'];

    mysqli_close($conn);
    return $post;
}

?>