<?php

include_once '../../basedatos/baseDatos.php';

function crearPreferencia($usuario) {
    $con = conectarBaseDatos();
    echo 'hola';
    $result = mysqli_query($con,"INSERT INTO preferencias (id_usuario, vista, modo_nocturno, categoria_inicial, lenguaje_obsceno, open_post_new_tab, orden) VALUES ((select id from usuario where usuario='$usuario'), 'compacta', FALSE, 'Categoria1', FALSE, FALSE, 'Por reacciones);");
    mysqli_fetch_array($result);
    mysqli_close($con);
}

function editarPreferencia($preferencia) {
    $respuesta = [];
    return $respuesta;
}

function mostrarPreferencia($preferencia) {
    $respuesta = [];
    return $respuesta;
}

function borrarPreferencia($preferencia) {
    $respuesta = [];
    return $respuesta;
}

function listarPreferencias($preferencia) {
    $respuesta = [];
    return $respuesta;
}

function getPreferenciasDeUsuario($usuario) {
    $con = conectarBaseDatos();
    $result = mysqli_query($con,"SELECT * FROM preferencias WHERE id_usuario = '$usuario';");
    $a = mysqli_fetch_array($result);
    $preferencias['id']=$a['id'];
    $preferencias['id_usuario']=$a['id_usuario'];
    $preferencias['vista']=$a['vista'];
    $preferencias['modo_nocturno']=$a['modo_nocturno'];
    $preferencias['categoria_inicial']=$a['categoria_inicial'];
    $preferencias['lenguaje_obsceno']=$a['lenguaje_obsceno'];
    $preferencias['open_post_new_tab']=$a['open_post_new_tab'];
    $preferencias['orden']=$a['orden'];
    
    mysqli_close($con);
    return $usuario;
    
}

?>