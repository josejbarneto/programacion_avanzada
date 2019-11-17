<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function conectarBaseDatos() {
    $usuario = "root";
    $servidor = "localhost";
    $basededatos = "p2";
    $conexion = mysqli_connect($servidor, $usuario, "") or die("No se ha podido conectar al servidor de Base de datos");
    $db = mysqli_select_db($conexion, $basededatos) or die("Upps! Pues va a ser que no se ha podido conectar a la base de datos");
    return $conexion;
}

function leerDestinos() {
    $conn = conectarBaseDatos();

    $consulta = "SELECT * FROM destinos";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    
    while ($columna = mysqli_fetch_array($resultado)) {
        $destinos[] = $columna['nombre'];
    }

    mysqli_close($conn);

    if (isset($destinos)) {
        return $destinos;
    } else {
        return false;
    }
}

function leerAerolineas() {
    $conn = conectarBaseDatos();

    $consulta = "SELECT * FROM aerolineas";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    $i=0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $aerolineas[$i]['nombre'] = $columna['nombre'];
        $aerolineas[$i]['id'] = $columna['id'];
        $i++;
    }

    mysqli_close($conn);    
    if (isset($aerolineas)) {
        return $aerolineas;
    } else {
        return false;
    }
}

function leerDestinosAerolineas() {
    $conn = conectarBaseDatos();

    $consulta = "SELECT * FROM destinos_aerolineas";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    $i=0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $destinosAerolineas[$i]['nombre'] = $columna['nombre_destino'];
        $destinosAerolineas[$i]['id'] = $columna['id_aerolinea'];
        $i++;
    }

    mysqli_close($conn);

    if (isset($destinosAerolineas)) {
        return $destinosAerolineas;
    } else {
        return false;
    }
}

function escribirAerolineas($id, $nombre) {
    $conn = conectarBaseDatos();

    $consulta = "INSERT INTO aerolineas (id, nombre)
                 VALUES ($id, '$nombre');";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos1");
    mysqli_close($conn);
}

function escribirDestinosAerolineas($id, $nombre) {
    $conn = conectarBaseDatos();

    $consulta = "INSERT INTO destinos_aerolineas (id_aerolinea, nombre_destino)
                 VALUES ($id, '$nombre');";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    mysqli_close($conn);
}

function leerConexiones() {
    $conn = conectarBaseDatos();

    $consulta = "SELECT * FROM conexiones";
    $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
    
    $i=0;
    while ($columna = mysqli_fetch_array($resultado)) {
        $conexiones[$i]['origen'] = $columna['origen'];
        $conexiones[$i]['id'] = $columna['id_aerolinea'];
        $conexiones[$i]['destino'] = $columna['destino'];
        $conexiones[$i]['tiempo'] = $columna['tiempo'];
        $i++;
    }

    mysqli_close($conn);

    if (isset($conexiones)) {
        return $conexiones;
    } else {
        return false;
    }
}

function escribirConexiones($id, $origen, $destino, $tiempo) {
    $conn = conectarBaseDatos();

    $consulta = "INSERT INTO conexiones (id_aerolinea, origen, destino, tiempo)
                 VALUES ($id,'$origen','$destino','$tiempo');";
    mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos1");
    mysqli_close($conn);
}
