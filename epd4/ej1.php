<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>        

        <?php

        function matrizContenido($contenido) {
            $arrayContenido = preg_split("/[\n]/", $contenido);
            foreach ($arrayContenido as $value) {
                $aux = preg_split("/[;]/", $value);
                $matrizContenido[] = $aux;
            }
            return $matrizContenido;
        }

        #Pasa de formato x:x:x a milisegundos
        function pasarATiempo($tiempo) {
            $tiempo = preg_split("/[:]/", $tiempo);
            $milisegundos = ((int) $tiempo[0]) * 3600 + ((int) $tiempo[1]) * 60 + ((int) $tiempo[2]);
            return $milisegundos;
        }
        
        #Pasa de formato milisegundo a x:x:x
        function pasarATiempoFormato($tiempo) {
            $minutos = (int) ($tiempo / 3600);
            $milisegundos = (int) ($tiempo % 3600);

            $segundos = (int) ($milisegundos / 60);
            $milisegundos = (int) ($milisegundos % 60);

            return "$minutos:$segundos:$milisegundos";
        }

        function imprimirVueltaRapida($vuelta) {
            echo '<table>';
            echo "<td>$vuelta[0]</td>"; #numero de vuelta
            echo "<td>$vuelta[1]</td>"; #nombre del piloto
            echo "<td>$vuelta[2]</td>"; #tiempo
            echo '</table>';
        }

        function imprimirVencedor($piloto, $tiempo) {

            $tiempo = pasarATiempoFormato($tiempo);

            echo '<table>';
            echo "<td>$piloto</td>"; #nombre del piloto
            echo "<td>$tiempo</td>"; #milisegundos
            echo '</table>';
        }

        function vueltaRapida($matrizContenido) {

            $primero = TRUE;

            #Recorrer todas las vueltas para saber cual es la de menor tiempo
            foreach ($matrizContenido as $vuelta) {

                #Vemos que no se ha retirado de la vuelta
                if ($vuelta[2] != '::') {

                    #Se inicializa las variable con la primera vuelta
                    if ($primero == TRUE) {
                        $vueltaRapida = $vuelta;
                        $tiempoVueltaRapida = pasarATiempo($vuelta[2]);
                        $primero = FALSE;
                    }

                    #Si la nueva vuelta es mas rapida que la mas rapida encontrada, se actualiza
                    else {
                        $tiempoVuelta = pasarATiempo($vuelta[2]);
                        if ($tiempoVuelta < $tiempoVueltaRapida) {
                            $vueltaRapida = $vuelta;
                            $tiempoVueltaRapida = $tiempoVuelta;
                        }
                    }
                }
            }
            imprimirVueltaRapida($vueltaRapida);
        }

        function vencedor($matrizContenido) {
            
            foreach ($matrizContenido as $vuelta) {
                
                #if ($vuelta[2] == '::' && isset($arrayTiempos[$vuelta[1]]))
                    #unset($arrayTiempos[$vuelta[1]]);

                if (isset($arrayTiempos[$vuelta[1]])){
                    $arrayTiempos[$vuelta[1]] += pasarATiempo($vuelta[2]);#arrayTiempos asocia el nombre del piloto con el total de milisegundos de la carrera
                }

                elseif (!isset($arrayTiempos[$vuelta[1]])){
                    $arrayTiempos[$vuelta[1]] = pasarATiempo($vuelta[2]);#incializacion 
                }
            }

            $primero = TRUE;
            foreach ($arrayTiempos as $piloto => $tiempo) {

                if ($primero) {
                    $mejorPilotoTiempo = $piloto;
                    $mejorTiempo = $tiempo;
                    $primero = FALSE;
                } else {
                    if ($mejorPilotoTiempo > $tiempo) {
                        $mejorPilotoTiempo = $piloto;
                        $mejorTiempo = $tiempo;
                    }
                }
            }

            imprimirVencedor($mejorPilotoTiempo, $mejorTiempo);
        }

        if (isset($_POST['envio'])) {

            #COMPRABACION DE ERRORES

            print_r($_POST['nombre']);
            if (!isset($_POST['nombre'])) {
                $errores[] = 'Indique el nombre de la carrera';
            }
            if (!isset($_POST['fecha'])) {
                $errores[] = 'Indique la fecha de la carrera';
            }
            if (!isset($_POST['peticion'])) {
                $errores[] = 'Indique si quiere Vuelta Rapida o Vencedor';
            }
            if (!isset($_POST['contenido'])) {
                $errores[] = 'Añada contenido';
            }


            #PROCESAMIENTO DE DATOS

            if (!isset($errores)) {
                $matrizContenido = matrizContenido($_POST['contenido']);
                #print_r($matrizContenido);
                #Se comprueba si se escoge la vuelta rapida
                if ($_POST['peticion'] == 'vueltaRapida') {
                    vueltaRapida($matrizContenido);
                }

                #Se comprueba si se escoge la vencedor
                elseif ($_POST['peticion'] == 'vencedor') {
                    vencedor($matrizContenido);
                }
            }
        }
        if (!isset($_POST['envio']) || isset($errores)) {
            echo '<h1>Formulario de peticiones</h1>';

            #TRATAMIENTO DE ERRORES

            if (isset($errores)) {
                echo '<p style="color:red">Errores Cometidos</p>';
                echo '<ul style="color:red">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }
            ?>
            <!--ENVIO DE FORMULARIO-->
            <form method="post">
                Nombre de la carrera: <input name="nombre" type="text"/><br/>
                Fecha: <input name="fecha" type="date"/><br/>                        
                <input type="radio" name="peticion" value="vueltaRapida"/>Vuelta Rapida
                <input type="radio" name="peticion" value="vencedor"/>Vencedor<br/>
                <textarea name="contenido"></textarea><br/>
                <input name="envio" type="submit" value="Enviar"/>
            </form>
            <?php
        }
        ?>
    </body>
</html>
