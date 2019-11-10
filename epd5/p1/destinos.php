<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function comprobarDestinos() {
    for ($i = 0; $i < $_SESSION['numeroDestinos']; $i++) {
        if (!isset($arrayAux)) {
            $arrayAux[] = $_POST['selectDestino'.$i];
        } else {
            if (in_array($_POST['selectDestino' . $i], $arrayAux)) {
                return false;
            } else {
                $arrayAux[] = $_POST['selectDestino' . $i];
            }
        }
    }
    return true;
}


#               --- CODIGO ---

if (isset($_POST['envioDestinos'])) {
    include 'funcionesLecturaEscritura.php';
    session_start();
}

$destinos = leerDestinos();

if (isset($_POST['envioDestinos'])) {
    #TRATAMIENTO ERRORES
    for ($i = 0; $i < $_SESSION['numeroDestinos']; $i++) {
        if (!isset($_POST['selectDestino' . $i])) {
            $errores[$i][] = 'Debes marcar un destino';
        }
        if(!in_array($_POST['selectDestino' . $i], $destinos)){
            $errores[$i][] = 'Destino no existente';
        }
    }

    #LEER FICHEROS Y COMPROBAR QUE NO EXISTE LA AEROLINEA    
    $aerolineas = leerAerolineas();
    if ($aerolineas != false) {

        $nombreAerolinea = $_SESSION['nombreAerolinea'];

        foreach ($aerolineas as $a) {
            if ($a['nombre'] == $nombreAerolinea) {
                $errores['aerolineaExiste'] = 'Ya existe la aerolinea';
                break;
            }
            $idNuevaAerolinea = $a['id'] + 1;
        }
    } else {
        $nombreAerolinea = $_SESSION['nombreAerolinea'];
        $idNuevaAerolinea = 1;
    }

    #COMPROBAR QUE NO SE REPITEN DESTINOS
    if(!comprobarDestinos()){
        $errores['destinosRepetidos']='No se pueden repetir destinos';
    }

    #PROCESAMIENTO
    if (!isset($errores)) {
        escribirAerolineas($idNuevaAerolinea, $nombreAerolinea);

        for ($i = 0; $i < $_SESSION['numeroDestinos']; $i++) {
            escribirDestinosAerolineas($idNuevaAerolinea, $_POST['selectDestino' . $i]);
        }
        
        session_destroy();
    }
}




if (!isset($_POST['envioDestinos']) || isset($errores)) {

    if (isset($errores['aerolineaExiste'])) {
        echo "<p style='color:red;'>{$errores['aerolineaExiste']}</p>";
    } if (isset($errores['destinosRepetidos'])) {
        echo "<p style='color:red;'>{$errores['destinosRepetidos']}</p>";
    }

    #FORMULARIO 
    echo '<form action="destinos.php" method="POST">';
    for ($i = 0; $i < $_SESSION['numeroDestinos']; $i++) {

        #ERRORES
        if (!empty($errores[$i])) {
            echo '<ul style="color:red;">';
            foreach ($errores[$i] as $e) {
                echo "<li>$e</li>";
            }
            echo '</ul>';
        }

        echo "<select name='selectDestino$i'>";
        foreach ($destinos as $d) {
            echo "<option value='$d'>$d</option>";
        }
        echo '</select><br/>';
    }
    echo '<input value="Enviar" name="envioDestinos" type="submit"/>';
    echo '</form>';
}
