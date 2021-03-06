<?php

include_once '../../basedatos/baseDatos.php';
include_once '../../entidades/categoria.php';

function crearPreferencia($usuario) {
    $categorias = getCategorias();
    $con = conectarBaseDatos();
    $result = mysqli_query($con, "INSERT INTO preferencias (id_usuario, modo_nocturno, id_categoria_inicial, open_post_new_tab, orden) VALUES ((select id from usuario where usuario='$usuario'), 0, {$categorias[0]['id']}, 0, 1);");
    mysqli_fetch_array($result);
    mysqli_close($con);
}

function editarPreferencia($id, $nocturno, $categoria, $lenguaje, $newTab, $orden) {
    $conn = conectarBaseDatos();

    //preparacion de valores antes de la insertcion
    if (empty($nocturno)) {
        $nocturno = 0;
    }if (empty($lenguaje)) {
        $lenguaje = 0;
    }if (empty($newTab)) {
        $newTab = 0;
    }

    $consulta = "UPDATE preferencias SET modo_nocturno = $nocturno, id_categoria_inicial = $categoria,  open_post_new_tab = $newTab, orden=$orden WHERE id_usuario = $id;";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la base de datos");

    mysqli_close($conn);
}

function getPreferenciasDeUsuario($usuario) {

    $con = conectarBaseDatos();
    $result = mysqli_query($con, "SELECT preferencias.id,preferencias.id_usuario, preferencias.modo_nocturno, preferencias.id_categoria_inicial, preferencias.open_post_new_tab, preferencias.orden, categoria.nombre FROM preferencias inner join categoria on preferencias.id_categoria_inicial = categoria.id WHERE id_usuario = $usuario;") or die("Error en la base de datos");
    $a = mysqli_fetch_array($result);
    $preferencias['id'] = $a['id'];
    $preferencias['id_usuario'] = $a['id_usuario'];
    $preferencias['modo_nocturno'] = $a['modo_nocturno'];
    $preferencias['id_categoria_inicial'] = $a['id_categoria_inicial'];
    $preferencias['open_post_new_tab'] = $a['open_post_new_tab'];
    $preferencias['orden'] = $a['orden'];
    $preferencias['nombre_categoria_inicial'] = $a['nombre'];

    mysqli_close($con);
    return $preferencias;
}

?>