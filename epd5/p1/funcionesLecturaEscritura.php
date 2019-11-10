<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function leerDestinos() {
    $ruta = 'destinos.txt';
    $f = fopen($ruta, 'r');

    flock($f, LOCK_SH);

    $destinos = fgetcsv($f, ',');

    flock($f, LOCK_UN);

    fclose($f);

    return $destinos;
}

function leerAerolineas() {
    $ruta = 'aerolineas.txt';

    if (file_exists($ruta)) {
        $f = fopen($ruta, 'r');

        flock($f, LOCK_SH);

        $i = 0;
        while (!feof($f)) {
            $aux = fgetcsv($f, 0, ';');
            if (!empty($aux)) {
                $aerolineas[$i]['id'] = trim($aux[0]);
                $aerolineas[$i]['nombre'] = trim($aux[1]);

                $i++;
            }
        }

        flock($f, LOCK_UN);
        fclose($f);

        return $aerolineas;
    } else {
        return false;
    }
}

function leerDestinosAerolineas() {
    $ruta = 'destinosAerolineas.txt';

    if (file_exists($ruta)) {
        $f = fopen($ruta, 'r');
        flock($f, LOCK_SH);

        $i = 0;
        while (!feof($f)) {
            $aux = fgetcsv($f, 0, ';');
            if (!empty($aux)) {
                $destinosAerolineas[$i]['id'] = trim($aux[0]);
                $destinosAerolineas[$i]['nombre'] = trim($aux[1]);

                $i++;
            }
        }

        flock($f, LOCK_UN);
        fclose($f);
        return $destinosAerolineas;
    } else {
        return false;
    }
}

function escribirAerolineas($id, $nombre) {
    $ruta = 'aerolineas.txt';
    if (file_exists($ruta)) {
        $f = fopen($ruta, 'a+');
    } else {
        $f = fopen($ruta, 'w');
    }

    $cadena = "$id;$nombre\n";

    flock($f, LOCK_EX);

    fwrite($f, $cadena);

    flock($f, LOCK_UN);

    fclose($f);
}

function escribirDestinosAerolineas($id, $nombre) {
    $ruta = 'destinosAerolineas.txt';
    if (file_exists($ruta)) {
        $f = fopen($ruta, 'a+');
    } else {
        $f = fopen($ruta, 'w');
    }

    $cadena = "$id;$nombre\n";

    flock($f, LOCK_EX);

    fwrite($f, $cadena);

    flock($f, LOCK_UN);

    fclose($f);
}

function leerConexiones() {
    $ruta = 'conexiones.txt';
    $f = fopen($ruta, 'r');

    flock($f, LOCK_SH);

    $i = 0;
    while (!feof($f)) {
        $viaje = fgetcsv($f, 0, ';');

        $tabla[$i]['id'] = trim($viaje[0]);
        $tabla[$i]['origen'] = trim($viaje[1]);
        $tabla[$i]['destino'] = trim($viaje[2]);
        $tabla[$i]['tiempo'] = trim($viaje[3]);

        $i++;
    }
    flock($f, LOCK_UN);

    fclose($f);

    if (isset($tabla)) {
        return $tabla;
    } else {
        return false; 
    }
}

function escribirConexiones($id, $origen, $destino, $tiempo) {
    $ruta = 'conexiones.txt';
    if (file_exists($ruta)) {
        $f = fopen($ruta, 'a+');
    } else {
        $f = fopen($ruta, 'w');
    }

    $cadena = "$id;$origen;$destino;$tiempo\n";

    flock($f, LOCK_EX);

    fwrite($f, $cadena);

    flock($f, LOCK_UN);

    fclose($f);
}
