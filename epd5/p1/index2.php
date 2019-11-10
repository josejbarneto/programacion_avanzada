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
        include 'funcionesLecturaEscritura.php';

        function ajustarKeyArray($array) {
            if (!empty($array)) {
                $i = 0;
                foreach ($array as $a) {
                    $arrayReturn[$i] = $a;
                    $i++;
                }
                return $arrayReturn;
            } else {
                return false;
            }
        }

        function filtroPorAerolinea($id, $destinos) {
            $i = 0;
            foreach ($destinos as $d) {
                if ($d['id'] != $id) {
                    unset($destinos[$i]);
                }
                $i++;
            }
            return ajustarKeyArray($destinos);
        }

        function eliminarOrigen($origen, $destinos) {
            $i = 0;
            foreach ($destinos as $d) {
                if ($origen === $d['nombre']) {
                    unset($destinos[$i]);
                }
                $i++;
            }
            return ajustarKeyArray($destinos);
        }

        function filtroDestinosYaFijados($conexiones, $destinos, $origen) {
            $i = 0;
            foreach ($destinos as $d) {
                foreach ($conexiones as $c) {
                    if ($c['id'] == $d['id'] && $c['origen'] == $origen && $c['destino'] == $d['nombre']) {
                        unset($destinos[$i]);
                        break;
                    }
                }
                $i++;
            }
            return ajustarKeyArray($destinos);
        }

        if (isset($_POST['envio'])) {

            #TRATAMIENTO DE ERRORES Y PROCESAMIENTO
            
            $destinos = leerDestinosAerolineas();

            if ($destinos == false) {
                $errores[] = 'No hay destinos';
            }

            if (!isset($_POST['selectVuelo'])) {
                $errores[] = 'Marca un vuelo';
            }
            
            if (!isset($errores)) {
                #FILTRAR!!!
                $aux = preg_split('/[;]/', $_POST['selectVuelo']);

                $idAerolinea = trim($aux[0]);
                $origen = trim($aux[1]);


                if (($destinos = filtroPorAerolinea($idAerolinea, $destinos)) == false) {
                    $errores[] = 'Todos los vuelos estan dados de alta';
                } elseif (($destinos = eliminarOrigen($origen, $destinos)) == false) {
                    $errores[] = 'Todos los vuelos estan dados de alta';
                }
                if (empty($errores)) {
                    $conexiones = leerConexiones();
                    if (($destinos = filtroDestinosYaFijados($conexiones, $destinos, $origen)) == false) {
                        $errores[] = 'Todos los vuelos estan dados de alta';
                    }
                }
            }

            #PROCESAMIENTO
            if (empty($errores)) {
                session_start();
                $_SESSION['destinos'] = $destinos;
                $_SESSION['origen'] = $origen;
                include 'escogerDestino.php';
            }
        }

        #FORMULARIO
        if (!isset($_POST['envio']) || isset($errores)) {
            $aerolineas = leerAerolineas();
            $origenAerolineas = leerDestinosAerolineas();

            #ERROES
            if (!empty($errores)) {
                echo '<ul style="color:red;">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }

            
            #CREACION DEL FORMULARIO
            echo '<form action="index2.php" method="POST"/>';

            foreach ($aerolineas as $aerolinea) {
                echo "<p style='font-weight: bold;'>{$aerolinea['nombre']}</p>";
                $id = $aerolinea['id'];

                foreach ($origenAerolineas as $origen) {
                    if ($origen['id'] == $id) {
                        echo "{$origen['nombre']}<input type='radio' value='$id;{$origen['nombre']}' name='selectVuelo'/>";
                    }
                }
                echo '<br/>';
            }
            echo '<input type="submit" name="envio" value="Enviar"/>';
            echo '</form><br/>';
        }
        ?>
    </body>
</html>
