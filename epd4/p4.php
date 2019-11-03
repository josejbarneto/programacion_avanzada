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

            .error{
                background-color: #f2a4a4;
            }
        </style>
    </head>
    <body>
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

        function pintaMatrizForm($nmatriz, $filas, $col, $matriz = false, $errores = []) {
            echo "MATRIZ $nmatriz";
            echo "<table class='matriz matriz$nmatriz'>";
            for ($i = 0; $i < $filas; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $col; $j++) {
                    if (!$matriz) {
                        echo "<td><input type='text' name='matriz-$nmatriz-$i-$j' /></td>";
                    } else {
                        $valor = $matriz[$i][$j];
                        echo "<td><input type='text' " . (isset($errores["$nmatriz-$i-$j"]) ? " class='error' " : "") . "value='$valor' name='matriz-$nmatriz-$i-$j' /></td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table></br>";
        }

        //CUANDO YA TENGO LAS MATRICES INTRODUCIDAS Y SON CORRECTAS
        if (isset($_POST['matrices'])) {
            $errores = [];
            $matriz1 = [];
            $matriz2 = [];
            $escalar = "";

            //matriz-nmatriz-fil-col
            foreach ($_POST as $key => $value) {
                //Hago la construcción de la matriz a la vez que compruebo el formulario con is_numeric.
                //Ya que si esta todo bien asi tengo ya las matrices construidas para hacer las operaciones
                //Y si esta mal tengo que pintar igualmente las matrices rellenas con los campos erroneos rojos
                if ($key != "matrices") {
                    if ($key != "escalar") {
                        $keyarray = explode("-", $key);
                        $matriz = $keyarray[1];
                        $fila = $keyarray[2];
                        $col = $keyarray[3];

                        if (!isset(${"matriz" . $matriz}[$fila])) {
                            ${"matriz" . $matriz}[$fila] = [];
                        }
                        ${"matriz" . $matriz}[$fila][$col] = $value;
                        if (!is_numeric($value)) {
                            $errores["$matriz-$fila-$col"] = 1;
                        }
                    } else {
                        if (is_numeric($value)) {
                            $escalar = $value;
                        } else {
                            $errores["escalar"] = 1;
                        }
                    }
                }
            }

            if (empty($errores)) {
                //HAGO OPERACIONES
                realizarCalculos($matriz1, $matriz2, $escalar);
            } else {
                echo '<h1>FORMULARIO MATRICES</h1>';
                echo '<form method="post" enctype="multipart/form-data">';
                pintaMatrizForm("1", count($matriz1), count($matriz1[0]), $matriz1, $errores);
                pintaMatrizForm("2", count($matriz2), count($matriz2[0]), $matriz2, $errores);
                echo "ESCALAR: <input type='number' " . (isset($errores["escalar"]) ? " class='error' " : "") . " name='escalar' value='$escalar'/></br></br>";
                echo '<input type="submit" name="matrices" value="Enviar" /><input type="reset" name="rest" value="Restaurar" />';
            }
        }

        //FORMULARIO DE CONSTRUCCION DE LAS MATRICES, TIENE QUE ESTAR CORRECTO Y YA TENGO LAS DIMENSIONES
        if (isset($_POST['dimensiones']) && !isset($_POST['matrices'])) {
            echo '<h1>FORMULARIO MATRICES</h1>';
            echo '<form method="post" enctype="multipart/form-data">';
            pintaMatrizForm("1", $_POST['filas1'], $_POST['col1']);
            pintaMatrizForm("2", $_POST['filas2'], $_POST['col2']);
            echo "ESCALAR: <input type='number' name='escalar'/></br></br>";
            echo '<input type="submit" name="matrices" value="Enviar" /><input type="reset" name="rest" value="Restaurar" />';
        }

        //FORMULARIO DE LAS DIMENSIONES
        if (!isset($_POST['dimensiones']) && !isset($_POST['matrices'])) {

            echo '<h1>FORMULARIO DIMENSIONES MATRICES</h1>			
		<form method="post" enctype="multipart/form-data">					
			DIMENSIONES MATRIZ 1 : <br />
			<input name="filas1" type="number" min="1"/> X <input name="col1" type="number" min="1"/> <br />
			DIMENSIONES MATRIZ 2 : <br />
			<input name="filas2" type="number" min="1"/> X <input name="col2" type="number" min="1"/> <br />
			<input type="submit" name="dimensiones" value="Enviar" />
			<input type="reset" name="rest" value="Restaurar" />			
		</form>';
        }

        function realizarCalculos($mat1, $mat2, $escalar) {

            echo "<table><tr><td>OPERACION</td><td>RESULTADO</td></tr><tr><td>MATRIZ A</td><td>";
            if ($mat1) {
                pintaMatriz($mat1);
            } else {
                echo "No se ha encontrado MATRIZ A";
            }

            echo "</td></tr><tr><td>MATRIZ B</td><td>";
            if ($mat2) {
                pintaMatriz($mat2);
            } else {
                echo "No se ha encontrado MATRIZ B";
            }

            echo "</td></tr><tr><td>SUMA MATRICES</td><td>";
            $mat = sumaMatriz($mat1, $mat2);
            if ($mat) {
                pintaMatriz($mat);
            } else {
                echo "No se han podido sumar las matrices, compruebe que tienen las mismas dimensiones";
            }

            echo "</td></tr><tr><td>MULTIPLICA MATRICES</td><td>";
            $mat = multiplicaMatriz($mat1, $mat2);
            if ($mat) {
                pintaMatriz($mat);
            } else {
                echo "No se han podido multiplicar las matrices asegurese que el numero columnas de la primera matriz es igual al numero de filas de la segunda";
            }


            echo "</td></tr><tr><td>MATRIZ A · ESCALAR ($escalar)</td><td>";
            $mat = multiplicaPorEscalar($mat1, $escalar);
            if ($mat) {
                pintaMatriz($mat);
            } else {
                echo "No se ha encontrado matriz a multiplicar";
            }

            echo "</td></tr></table>";
        }
        ?>
    </body>
</html>
