<?php

function crearComentario($comentario, $id_usuario, $id_post) {
    $conn = conectarBaseDatos();

    $fechaCreacion = getdate();
    
    $consulta = "insert into comentario (id_usuario, id_post, texto, fecha_creacion, fecha_actualizacion) VALUES ('$id_usuario','$id_post', '$comentario', '$fechaCreacion', '$fechaCreacion');";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    
    mysqli_close($conn);
}

function editarComentario($comentario, $id_comentario) {
    $conn = conectarBaseDatos();

    $fechaActualizacion = getdate();
    
    $consulta = "UPDATE comentario SET texto = '$comentario' WHERE id = $id_comentario;";   
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

function listarComentarios() {
    $respuesta = [];
    return $respuesta;
}

function listarComentariosPorPost($post) {
    $respuesta = [];
    return $respuesta;
}

function listarComentariosPorUsuario($usuario) {
    $respuesta = [];
    return $respuesta;
}

?>