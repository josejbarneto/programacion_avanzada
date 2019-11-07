<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'funciones.php';


if (isset($_POST['envio'])) {
    $stop = FALSE;
    $i = 1;

    while (!$stop) {
        if (!isset($_POST[$i])) {
            $stop = TRUE;
        } else {
            $contenido[] = $_POST["$i"];
            $i++;
        }
    }
}

if (isset($_POST['envio'])) {
    
    #COMPROBACION DE ERRORES
    foreach ($contenido as $carrera) {
        $fecha = 'fecha' . $carrera;
        $text = 'contenido' . $carrera;

        if (!isset($_POST[$fecha]) || empty($_POST[$fecha])) {
            $errores[$carrera][] = 'Introduce una fecha';
        }if (!isset($_POST[$text]) || empty($_POST[$text])) {
            $errores[$carrera][] = 'Rellena el text Area';
        }elseif(!filtroNumeroVueltas(matrizContenido($_POST[$text]))){
            $errores[$carrera][] = 'Informacion introducida incorrecta';
        }
    }

    #PROCESAMIENTO DE DATOS
    if (!isset($errores)) {

        foreach ($contenido as $carrera) {
            $fecha = 'fecha' . $carrera;
            $text = 'contenido' . $carrera;
            $c = $_POST[$text];
            $matrizContenido = matrizContenido($_POST[$text]);
            $vencedorCarrera = vencedor($matrizContenido)['nombre'];
            if (!isset($v[$vencedorCarrera])) {
                $v[$vencedorCarrera] = 1;
            } else {
                $v[$vencedorCarrera] ++;
            }
        }

        arsort($v);
        print_r($v);
        $campeon = array_keys($v)[0];
        echo "El campeon es: $campeon";
    }
}
if (!isset($_POST['envio']) || isset($errores)) {
    echo '<h1>Formulario de peticiones</h1>';

    $i = 1;
    foreach ($contenido as $carrera) {
        #TRATAMIENTO DE ERRORES
        if (isset($errores[$carrera])) {
            echo '<p style="color:red">Errores Cometidos</p>';
            echo '<ul style="color:red">';
            foreach ($errores[$carrera] as $e) {
                echo "<li>$e</li>";
            }
            echo '</ul>';
        }

        #ENVIO DE FORMULARIO
        echo '<form method="post" action="form.php">';


        $fecha = 'fecha' . $carrera;
        $text = 'contenido' . $carrera;
        echo "Carrera: $carrera<br/>";
        echo "Fecha<input name='$fecha' type='date' /><br/>";
        echo "<textarea name='$text'></textarea><br/>";
        echo "<input name='$i' value='$carrera' type='hidden'/>";
        $i = $i + 1;
    }
    echo "<input name='envio' type='submit' value='Enviar'/>";
    echo '</form>';
}