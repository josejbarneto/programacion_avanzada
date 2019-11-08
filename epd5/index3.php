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

        function sortPorId($a, $b) {
            $a['nombre'] > $b['nombre'];
        }

        function sortNumeroConx($a, $b) {
            $a['numConx'] < $b['numConx'];
        }

        function pasarAMinutos($tiempo) {
            $tiempo = preg_split("/[:]/", $tiempo);
            $minutos = ((int) $tiempo[0]) * 60 + ((int) $tiempo[1]);
            return $minutos;
        }

        function crearTabla($conexiones) {
            sort($conexiones, 'sortPorNombre');
            $origen = $conexiones[0]['origen'];
            $sumatorioTiempo = pasarAMinutos($conexiones[0]['tiempo']);
            $numeroConx = 1;

            foreach ($conexiones as $conexion) {
                if ($origen != $conexion['origen']) {
                    $tabla['origen'] = $origen;
                    $tabla['numeroConx'] = $numeroConx;
                    $tabla['mediaTiempo'] = $sumatorioTiempo / $numeroConx;

                    $origen = $conexion['origen'];
                    $sumatorioTiempo = pasarAMinutos($conexion['tiempo']);
                    $numeroConx = 1;
                } else {
                    $sumatorioTiempo += pasarAMinutos($conexion['tiempo']);
                    $numeroConx++;
                }
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
            echo '<table>';

            echo '<tr>';
            echo '<th>Origen</th>';
            echo '<th>Numero Conexiones</th>';
            echo '<th>Tiempo Medio</th>';
            echo '</tr>';

            foreach ($tabla as $t) {
                echo "<td>{$t['origen']}</td>";
                echo "<td>{$t['numeroConx']}</td>";
                echo "<td>{$t['mediaTiempo']}</td>";
            }
        }

        if (isset($_POST['envio'])) {
            $idAerolinea = $_POST['aerolineas'];
            $conexiones = leerConexiones(); 
            $conexiones = eliminarFilasPorId($idAerolinea, $conexiones);
            $tabla = crearTabla($conexiones);
            sort($tabla, 'sortNumeroConx');
            mostrarTabla($conexiones);
        }


        if (!isset($_POST['envio'])) {
            $aerolineas = leerAerolineas();

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
