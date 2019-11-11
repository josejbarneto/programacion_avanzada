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
        include 'paginaPrincipal.php';
        include 'funcionesLecturaEscritura.php';

        function sortPorNombre($a, $b) {
            $a['nombre'] > $b['nombre'];
        }

        function sortNumeroConx($a, $b) {
            $a['numeroConx'] < $b['numeroConx'];
        }

        function sortPorOrigen($a, $b) {
            $a['origen'] < $b['origen'];
        }

        function pasarAMinutos($tiempo) {
            $tiempo = preg_split("/[:]/", $tiempo);
            $minutos = ((int) $tiempo[0]) * 60 + ((int) $tiempo[1]);
            return $minutos;
        }

        function pasarAFormato($tiempo) {
            $horas = (int) ($tiempo / 60);
            $minutos = (int) ($tiempo % 60);

            if ($horas <= 9) {
                $horas = "0$horas";
            }

            if ($minutos <= 9) {
                $minutos = "0$minutos";
            }

            return "$horas:$minutos";
        }

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

        function crearTabla($conexiones) {#MAL
            uksort($conexiones, 'sortPorOrigen');
            $origen = $conexiones[0]['origen'];
            $sumatorioTiempo = 0;
            $numeroConx = 0;

            $i = 0;
            foreach ($conexiones as $conexion) {
                if ($origen != $conexion['origen']) {
                    $tabla[$i]['origen'] = $origen;
                    $tabla[$i]['numeroConx'] = $numeroConx;
                    $tabla[$i]['mediaTiempo'] = $sumatorioTiempo / $numeroConx;

                    $origen = $conexion['origen'];
                    $sumatorioTiempo = pasarAMinutos($conexion['tiempo']);
                    $numeroConx = 1;
                    $i++;
                } else {
                    $sumatorioTiempo += pasarAMinutos($conexion['tiempo']);
                    $numeroConx++;
                }
            }

            $tabla[$i]['origen'] = $origen;
            $tabla[$i]['numeroConx'] = $numeroConx;
            $tabla[$i]['mediaTiempo'] = $sumatorioTiempo / $numeroConx;

            $i = 0;
            foreach ($tabla as $t) {
                $tabla[$i]['mediaTiempo'] = pasarAFormato($t['mediaTiempo']);
                $i++;
            }

            return $tabla;
        }

        function eliminarFilasPorId($id, $conexiones) {
            $i = 0;
            foreach ($conexiones as $conexion) {
                if ($conexion['id'] != $id) {
                    unset($conexiones[$i]);
                }
                $i++;
            }
            return $conexiones;
        }

        function mostrarTabla($tabla) {

            echo '<table style="text-align:center;">';

            echo '<tr>';
            echo '<th>Origen</th>';
            echo '<th>Numero Conexiones</th>';
            echo '<th>Tiempo Medio</th>';
            echo '</tr>';

            foreach ($tabla as $t) {
                echo '<tr>';
                echo "<td>{$t['origen']}</td>";
                echo "<td>{$t['numeroConx']}</td>";
                echo "<td>{$t['mediaTiempo']}</td>";
                echo '</tr>';
            }
        }

        if (isset($_POST['envio'])) {
            if (!isset($_POST['aerolineas'])) {
                $errores[] = 'Selecciona una aerolinea';
            } else {
                $idAerolinea = $_POST['aerolineas'];
                $conexiones = leerConexiones();

                if ($conexiones == false) {
                    $errores[] = 'No hay niguna conexion';
                } elseif (empty($conexiones = eliminarFilasPorId($idAerolinea, $conexiones))) {
                    $errores[] = 'No hay niguna conexion';
                } if (!isset($errores)) {
                    $conexiones = ajustarKeyArray($conexiones);
                    $tabla = crearTabla($conexiones);
                    uksort($tabla, 'sortNumeroConx');
                    mostrarTabla($tabla);
                }
            }
        }


        if (!isset($_POST['envio']) || isset($errores)) {
            $aerolineas = leerAerolineas();

            #ERROES
            if (!empty($errores)) {
                echo '<ul style="color:red;">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }

            echo '<form method="POST" action="#"> ';

            foreach ($aerolineas as $aerolinea) {
                echo "{$aerolinea['nombre']}: <input type ='radio' name='aerolineas' value='{$aerolinea['id']}'/><br/>";
            }
            echo '<br/><input type="submit" value="Enviar" name="envio"/>';
            echo '<form/>';
        }
        ?>

    </body>
</html>
