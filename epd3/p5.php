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
            table.matriz{
                border: 1px solid darkcyan;
            }
            .matriz td{
                border: 0.5px solid darkcyan;
                padding: 5px;
            }
            
            table{
                border: 1px solid grey;
            }
            td{
                border: 0.5px solid grey;
                padding: 10px;
            }
        </style>
    </head>
    <?php

    function multiplicaMatriz($mat1, $mat2) {
        $filas1 = count($mat1);
        $columnas1 = count($mat1[0]);
        $filas2 = count($mat2);
        $columnas2 = count($mat2[0]);

        if ($filas1 == $columnas2 and $filas2 == $columnas1) {
            for ($i = 0; $i < $filas1; $i++) {
                for ($j = 0; $j < $columnas2; $j++) {
                    $res[$i][$j] = 0;
                    for ($x = 0; $x < $columnas1; $x++) {
                        $res[$i][$j] += $mat1[$i][$x] * $mat2[$x][$j];
                    }
                }
            }
        } else {
            $res = false;
        }

        return $res;
    }

    function sumaMatriz($mat1, $mat2) {
        $filas1 = count($mat1);
        $columnas1 = count($mat1[0]);
        $filas2 = count($mat2);
        $columnas2 = count($mat2[0]);

        if ($filas1 == $filas2 and $columnas1 == $columnas2) {

            for ($i = 0; $i < $filas1; $i++) {
                for ($j = 0; $j < $columnas1; $j++) {
                    if (!isset($res[$i][$j])) {
                        $res[$i][$j] = 0;
                    }
                    $res[$i][$j] += $mat1[$i][$j] + $mat2[$i][$j];
                }
            }
        } else {
            $res = false;
        }

        return $res;
    }

    function multiplicaPorEscalar($mat, $escalar) {
        $filas1 = count($mat);
        $columnas1 = count($mat[0]);

        for ($i = 0; $i < $filas1; $i++) {
            for ($j = 0; $j < $columnas1; $j++) {
                if (!isset($res[$i][$j])) {
                    $res[$i][$j] = 0;
                }
                $res[$i][$j] += $mat[$i][$j] * $escalar;
            }
        }

        return $res;
    }

    function pintaMatriz($matriz) {
        $filas = count($matriz);
        $col = count($matriz[0]);
        echo "<table class='matriz'>";
        for ($i = 0; $i < $filas; $i++) {
            echo "<tr>";
            for ($j = 0; $j < $col; $j++) {
                echo "<td>" . $matriz[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    $mat1 = array(array(1, 2, 3), array(4, 5, 6));
    $mat2 = array(array(1, 2), array(3, 4), array(5, 6));
    ?>
    <body>
        <table>
            <tr>
                <td>
                    OPERACION
                </td>
                <td>
                    RESULTADO
                </td>
            </tr>
            <tr>
                <td>
                    MATRIZ A
                </td>
                <td>
                    <?php
                    if ($mat1) {
                        pintaMatriz($mat1);
                    } else {
                        echo "No se ha encontrado MATRIZ A";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    MATRIZ B
                </td>
                <td>
                    <?php
                    if ($mat2) {
                        pintaMatriz($mat2);
                    } else {
                        echo "No se ha encontrado MATRIZ B";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    SUMA MATRICES
                </td>
                <td>
                    <?php
                    $mat = sumaMatriz($mat1, $mat2);
                    if ($mat) {
                        pintaMatriz($mat);
                    } else {
                        echo "No se han podido sumar las matrices, compruebe que tienen las mismas dimensiones";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    MULTIPLICA MATRICES
                </td>
                <td>
                    <?php
                    $mat = multiplicaMatriz($mat1, $mat2);
                    if ($mat) {
                        pintaMatriz($mat);
                    } else {
                        echo "No se han podido multiplicar las matrices asegurese que el numero columnas de la primera matriz es igual al numero de filas de la segunda";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    MATRIZ A · ESCALAR (3)
                </td>
                <td>
                    <?php
                    $mat = multiplicaPorEscalar($mat1, 3);
                    if ($mat) {
                        pintaMatriz($mat);
                    } else {
                        echo "No se ha encontrado matriz a multiplicar";
                    }
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>
