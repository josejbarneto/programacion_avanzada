<?php

include_once '../../basedatos/baseDatos.php';

function crearReaccion($id_usuario, $id_post, $tipo) {
    $con = conectarBaseDatos();

    mysqli_query($con, "INSERT INTO reaccion (id_usuario, id_post, tipo) VALUES ($id_usuario, $id_post, $tipo);") or die("Algo ha ido mal en la consulta a la base de datos c");

    mysqli_close($con);
}

function editarReaccion($id_usuario, $id_post, $tipo) {
    $con = conectarBaseDatos();

    mysqli_query($con, "UPDATE reaccion SET tipo = $tipo WHERE id_post = $id_post AND id_usuario = $id_usuario;") or die("$id_usuario, $id_post, $tipo");

    mysqli_close($con);
}

function borrarReaccion($id_usuario, $id_post) {
    $conn = conectarBaseDatos();

    $consulta = "DELETE FROM reaccion WHERE id_post = $id_post and id_usuario = $id_usuario;";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos b");

    mysqli_close($conn);
}

function existReaccion($id_usuario, $id_post) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT count(*) FROM reaccion WHERE id_usuario = $id_usuario and id_post = $id_post;") or die("Algo ha ido mal en la consulta a la base de datos exist");
    $a = mysqli_fetch_array($result);
    mysqli_close($con);
    if ($a["count(*)"] != 0) {
        return true;
    } else {
        return false;
    }
}

function getReaccion($id_usuario, $id_post) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT * FROM reaccion WHERE id_usuario = $id_usuario and id_post = $id_post;") or die("Algo ha ido mal en la consulta a la base de datos get");
    $a = mysqli_fetch_array($result);
    mysqli_close($con);
    return $a;
}

function getReacciones($id_post) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "select count(*) as 'likes', (select count(*) from reaccion where id_post = $id_post and tipo = 0) as 'dislikes' from reaccion where id_post = $id_post and tipo = 1;") or die("$id_post");
    $columna = mysqli_fetch_array($result);
    $reacciones['likes'] = $columna['likes'];
    $reacciones['dislikes'] = $columna['dislikes'];

    mysqli_close($con);

    return $reacciones;
}

?>