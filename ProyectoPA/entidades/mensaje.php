<?php
include_once '../../basedatos/baseDatos.php';

function crearMensaje($mensaje, $idEmisor, $idReceptor, $fechaEnvio) {
    $conn = conectarBaseDatos();

    $consulta = "insert into mensaje (texto, id_emisor, id_receptor, fecha_enviado) VALUES ('$mensaje', '$idEmisor', '$idReceptor', '$fechaEnvio');";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function mostrarMensaje($mensaje) {
    $respuesta = [];
    return $respuesta;
}

function borrarMensaje($mensaje) {
    $conn = conectarBaseDatos();

    $consulta = "insert into mensaje (texto, id_emisor, id_receptor, fecha_enviado) VALUES ('$mensaje', '$idEmisor', '$idReceptor', '$fechaEnvio');";   
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

    mysqli_close($conn);
}

function listarMensajes($idUsuario, $idUsuario2) {
    $conn = conectarBaseDatos();

    $consulta =  "select texto from mensaje where (id_emisor='$idUsuario' and id_receptor='$idUsuario2') or (id_emisor='$idUsuario2' and id_receptor='$idUsuario') order by fechaEnviado DESC;";   
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    while ($columna = mysqli_fetch_array($resultado)) {
        $mensaje['id'] = $columna['id'];
        $mensaje['idEmisor'] = $columna['id_emisor'];
        $mensaje['idReceptor'] = $columna['id_receptor'];
        $mensaje['fechaEnviado'] = $columna['fecha_enviado'];
        $mensaje['texto'] = $columna['texto'];   
    }
    
    mysqli_close($conn);
}

?>