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
            function presupuesto($nombre, $dni, $porcentajeIVA, $matrizDatos){
                echo '<table>';
                echo '<tr>';
                echo "<th colspan = 2>Nombre: $nombre</th>";
                echo "<th colspan = 2>DNI: $dni</th>";
                echo '</tr>';
                
                echo '<tr>';
                echo '<th>Articulo</th>';
                echo '<th>Unidad</th>';
                echo '<th>Precio/Unidad</th>';
                echo '<th>Total</th>';
                echo '</tr>';
                
                $subtotal = 0;
                
                
                for($i=0; $i < count($matrizDatos[0]); $i++){
                    echo '<tr>';
                    echo "<td>{$matrizDatos[$i]['id']}</td>";
                    echo "<td>{$matrizDatos[$i]['cantidad']}</td>";
                    echo "<td>{$matrizDatos[$i]['precio']} €</td>";
                    $total = $matrizDatos[$i]['cantidad'] * $matrizDatos[$i]['precio'];
                    $subtotal += $total;
                    echo "<td>$total €</td>";
                    echo '</tr>';
                }
                
                
                echo '<tr>';
                echo '<td colspan = 2>Subtotal<td>';
                echo "<td>$subtotal €</td>";
                echo '</tr>';
                
                echo '<tr>';
                echo '<td>IVA</td>';
                echo "<td colspan=2> $porcentajeIVA %</td>";
                $totalIVA = $subtotal * ($porcentajeIVA/100);
                echo "<td>$totalIVA €</td>";
                echo '</tr>';
                
                echo '<tr>';
                echo '<th colspan=3>TOTAL PRESUPUESTADO</th>';
                $totalPresupuestado = $totalIVA + $subtotal;
                echo "<td>$totalPresupuestado €</td>";
                echo '<tr>';
            }
            
            $matriz = [
                ['id'=>'Iphone 7', 'cantidad'=>3, 'precio'=>500],
                ['id'=>'Macbook', 'cantidad'=>1, 'precio'=>1500],
                ['id'=>'Ipod', 'cantidad'=>2, 'precio'=>50]
            ];
            
            #prueba
            presupuesto('Daniel', '77854678G', 21, $matriz);
        ?>
    </body>
</html>
