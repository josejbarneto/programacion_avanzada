<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            *{
                margin: 0 auto;
                text-align: center;
            }
            table{
                border: 1px solid black;
            }
            td{
                border: 0.5px solid black;
                padding: 5px;
            }
        </style>
    </head>
    <?php

    function calendarioPerpetuo($mes, $año) {
        $mesFixed = $mes < 3 ? ($mes + 10) : $mes - 2; //Enero 11 Febrero 12 y el resto de Marzo 1 a Diciembre 10.
        $c = intdiv($año, 100);
        $a = $año % 100;

        return (13 + intdiv(13 * $mesFixed - 1, 5) + $a + (intdiv($a, 4)) + (intdiv($c, 4)) - 2 * $c) % 7;
    }

    function nombreMes($mes) {
        setlocale(LC_TIME, 'es');
        return ucfirst(strftime('%B', mktime(0, 0, 0, $mes)));
    }
    ?>
    <body>
        <table>
            <?php
            $hoy = new DateTime('now');
            $mes = $hoy->format('m');
            $año = $hoy->format('Y');
            $proximosXaños = 100;

            echo "<h1>MARTES 13 ENCONTRADOS EN LOS PROXIMOS $proximosXaños AÑOS</h1>";
            echo "<tr><td>MES</td><td>AÑO</td></tr>";
            for ($i = 0; $i < $proximosXaños * 12; $i++) {

                if (calendarioPerpetuo($mes, $año) == 2) {//Si es martes
                    echo "<tr><td>" . nombreMes($mes) . "</td><td>$año</td></tr>";
                }
                if ($mes < 12) {
                    $mes++;
                } else {
                    $año++;
                    $mes = 1;
                }
            }
            ?>
        </table>
    </body>
</html>
