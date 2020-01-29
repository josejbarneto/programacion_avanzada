<?php

function crearComentario($comentario, $id_usuario, $id_post) {
    $conn = conectarBaseDatos();

    $fechaCreacion = date_create();
    $fecha = date_format($fechaCreacion, 'Y-m-d H:i:s');
    
    $consulta = "insert into comentario (id_usuario, id_post, texto, fecha_creacion, fecha_actualizacion) VALUES ('$id_usuario','$id_post', '$comentario', '$fecha', '$fecha');";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    
    mysqli_close($conn);
}

function editarComentario($comentario, $id_comentario) {
    $conn = conectarBaseDatos();

    $fechaCreacion = date_create();
    $fecha = date_format($fechaCreacion, 'Y-m-d H:i:s');
    
    $consulta = "UPDATE comentario SET texto = '$comentario', fecha_actualizacion = '$fecha' WHERE id = $id_comentario;";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function mostrarComentario($comentario) {
    $respuesta = [];
    return $respuesta;
}

function borrarComentario($id_comentario) {
    $conn = conectarBaseDatos();
    
    $consulta = "DELETE FROM comentario WHERE id = $id_comentario;";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function listarComentariosPorPost($idPost) {
    $conn = conectarBaseDatos();

    $consulta = "select comentario.id, comentario.id_usuario, comentario.id_post, comentario.texto, comentario.fecha_creacion, usuario.usuario, usuario.nombre from comentario inner join usuario on comentario.id_usuario = usuario.id where comentario.id_post = $idPost;";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    $i = 0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $comentarios[$i]['id'] = $columna['id'];
        $comentarios[$i]['idUsuario'] = $columna['id_usuario'];
        $comentarios[$i]['idPost'] = $columna['id_post'];
        $comentarios[$i]['texto'] = $columna['texto'];
        $comentarios[$i]['fechaCreacion'] = $columna['fecha_creacion'];
        $comentarios[$i]['nombreUsuario'] = $columna['nombre'];
        $comentarios[$i]['usuario'] = $columna['usuario'];
        $i++;
    }

    mysqli_close($conn);
    
    if(isset($comentarios)){
        return $comentarios;
    }else{
        return false;
    }
}

function listarComentariosPorUsuario($usuario) {
    $conn = conectarBaseDatos();

    $consulta = "select comentario.id, comentario.id_usuario, comentario.id_post, comentario.texto, comentario.fecha_creacion, usuario.usuario, usuario.nombre from comentario inner join usuario on comentario.id_usuario = usuario.id where usuario.id = $usuario;";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos 1");

    $i = 0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $comentarios[$i]['id'] = $columna['id'];
        $comentarios[$i]['idUsuario'] = $columna['id_usuario'];
        $comentarios[$i]['idPost'] = $columna['id_post'];
        $comentarios[$i]['texto'] = $columna['texto'];
        $comentarios[$i]['fechaCreacion'] = $columna['fecha_creacion'];
        $comentarios[$i]['nombreUsuario'] = $columna['nombre'];
        $comentarios[$i]['usuario'] = $columna['usuario'];
        $i++;
    }

    mysqli_close($conn);
    
    if(isset($comentarios)){
        return $comentarios;
    }else{
        return false;
    }
}

function getAllComenarios(){
    $conn = conectarBaseDatos();

    $consulta = "select comentario.id, comentario.id_usuario, comentario.id_post, comentario.texto, comentario.fecha_creacion, usuario.usuario, usuario.nombre from comentario inner join usuario on comentario.id_usuario = usuario.id;";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos 1");

    $i = 0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $comentarios[$i]['id'] = $columna['id'];
        $comentarios[$i]['idUsuario'] = $columna['id_usuario'];
        $comentarios[$i]['idPost'] = $columna['id_post'];
        $comentarios[$i]['texto'] = $columna['texto'];
        $comentarios[$i]['fechaCreacion'] = $columna['fecha_creacion'];
        $comentarios[$i]['nombreUsuario'] = $columna['nombre'];
        $comentarios[$i]['usuario'] = $columna['usuario'];
        $i++;
    }

    mysqli_close($conn);
    
    if(isset($comentarios)){
        return $comentarios;
    }else{
        return false;
    }
}
?>