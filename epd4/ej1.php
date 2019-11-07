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
        #Pasa de formato x:x:x a milisegundos

        function pasarATiempo($tiempo) {
            if ($tiempo == '::')
                return FALSE;
            else {
                $tiempo = preg_split("/[:]/", $tiempo);
                $milisegundos = ((int) $tiempo[0]) * 3600 + ((int) $tiempo[1]) * 60 + ((int) $tiempo[2]);
                return $milisegundos;
            }
        }

        #Pasa de formato milisegundos a x:x:x

        function pasarATiempoFormato($tiempo) {
            $minutos = (int) ($tiempo / 3600);
            $milisegundos = (int) ($tiempo % 3600);

            $segundos = (int) ($milisegundos / 60);
            $milisegundos = (int) ($milisegundos % 60);

            return "$minutos:$segundos:$milisegundos";
        }

        function matrizContenido($contenido) {
            $arrayContenido = preg_split("/[\n]/", $contenido);
            foreach ($arrayContenido as $value) {
                $value = preg_split("/[;]/", $value);

                $aux['id'] = $value[0];
                $aux['nombre'] = $value[1];

                $tiempo = pasarATiempo($value[2]);

                if (!$tiempo) {
                    $aux['retirado'] = 1;
                    $aux['tiempo'] = 0;
                } else {
                    $aux['retirado'] = 0;
                    $aux['tiempo'] = $tiempo;
                }

                $matrizContenido[] = $aux;
            }

            return $matrizContenido;
        }

        function filtroNumeroVueltas($matrizContenido) {
            $nombre1 = $matrizContenido[0]['nombre'];
            $cont = 1;
            $numeroVueltas = FALSE;
            $retirado = 0;
            $correcto = TRUE;

            foreach ($matrizContenido as $v) {
                if ($v['id'] == $cont) {
                    $cont++;
                } elseif ($v['id'] == 1 && !$retirado) {
                    if (!$numeroVueltas) {
                        $numeroVueltas = $cont - 1;
                        if ($numeroVueltas < 3 || $numeroVueltas > 50) {
                            $correcto = FALSE;
                            break;
                        }
                    } elseif ($numeroVueltas != $cont - 1) {
                        $correcto = FALSE;
                        break;
                    }
                    $cont = 2;
                } elseif ($v['id'] == 1 && $retirado) {
                    $cont = 2;
                } else {
                    $correcto = FALSE;
                    break;
                }

                $retirado = $v['retirado'];
            }

            if (!$numeroVueltas) {
                if ($v['retirado']) {
                    $correcto = FALSE;
                }elseif($cont-1 < 1 || $cont-1>50){
                    $correcto = FALSE;
                }
            }

            return $correcto;
        }

        function imprimirVueltaRapida($vuelta, $nombreCarrera, $fecha) {

            $tiempo = pasarATiempoFormato($vuelta['tiempo']);

            echo '<table>';

            echo '<tr>';
            echo "<td>$nombreCarrera</td>";
            echo '</tr>';

            echo '<tr>';
            echo "<td>$fecha</td>";
            echo '</tr>';

            echo '<tr>';
            echo "<td>{$vuelta['id']}</td>"; #numero de vuelta
            echo "<td>{$vuelta['nombre']}</td>"; #nombre del piloto
            echo "<td>$tiempo</td>"; #tiempo
            echo '</tr>';

            echo '</table>';
        }

        function imprimirVencedor($vencedor, $nombreCarrera, $fecha) {

            $tiempo = pasarATiempoFormato($vencedor['tiempo']);

            echo '<table>';

            echo '<tr>';
            echo "<td>$nombreCarrera</td>";
            echo '</tr>';

            echo '<tr>';
            echo "<td>$fecha</td>";
            echo '</tr>';

            echo '<tr>';
            echo "<td>{$vencedor['nombre']}</td>"; #nombre del piloto
            echo "<td>$tiempo</td>"; #milisegundos
            echo '</tr>';

            echo '</table>';
        }

        function sortPorTiempo($a, $b) {
            if ($a['retirado'] == TRUE) {
                return 1;
            } elseif ($b['retirado'] == TRUE) {
                return 0;
            } else
                return $a['tiempo'] > $b['tiempo'];
        }

        function sortPorNombre($a, $b) {
            if ($a['nombre'] > $b['nombre'])
                return 0;
            elseif ($a['nombre'] < $b['nombre'])
                return 1;
            else
                return $a['id'] > $b['id'];
        }

        function vueltaRapida($matrizContenido) {
            usort($matrizContenido, "sortPorTiempo");
            return $matrizContenido[0];
        }

        function vencedor($matrizContenido) {

            foreach ($matrizContenido as $vuelta) {

                if ($vuelta['retirado']) {
                    $arrayTiempos[$vuelta['nombre']]['retirado'] = 1;
                } elseif (isset($arrayTiempos[$vuelta['nombre']]['tiempo'])) {
                    $arrayTiempos[$vuelta['nombre']]['tiempo'] += $vuelta['tiempo'];
                } else { //inicializacion
                    $arrayTiempos[$vuelta['nombre']]['tiempo'] = $vuelta['tiempo'];
                    $arrayTiempos[$vuelta['nombre']]['retirado'] = 0;
                    $arrayTiempos[$vuelta['nombre']]['nombre'] = $vuelta['nombre'];
                }
            }

            usort($arrayTiempos, "sortPorTiempo");
            return $arrayTiempos[0];
        }

        if (isset($_POST['envio'])) {

            #COMPRABACION DE ERRORES

            if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
                $errores[] = 'Indique el nombre de la carrera';
            }
            if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
                $errores[] = 'Indique la fecha de la carrera';
            }
            if (!isset($_POST['peticion']) || empty($_POST['peticion'])) {
                $errores[] = 'Indique si quiere Vuelta Rapida o Vencedor';
            }
            if (!isset($_POST['contenido']) || empty($_POST['contenido'])) {
                $errores[] = 'Añada contenido';
            }

            $matrizContenido = matrizContenido($_POST['contenido']);
            usort($matrizContenido, "sortPorNombre");
            
            if(!filtroNumeroVueltas($matrizContenido)){
                $errores[] = 'Información introducida incorrectamente';
            }

            #PROCESAMIENTO DE DATOS

            if (empty($errores)) {

                #Se comprueba si se escoge la vuelta rapida
                if ($_POST['peticion'] == 'vueltaRapida') {
                    $vR = vueltaRapida($matrizContenido);
                    imprimirVueltaRapida($vR, $_POST['nombre'], $_POST['fecha']);
                }

                #Se comprueba si se escoge la vencedor
                elseif ($_POST['peticion'] == 'vencedor') {
                    $v = vencedor($matrizContenido);
                    imprimirVencedor($v, $_POST['nombre'], $_POST['fecha']);
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
