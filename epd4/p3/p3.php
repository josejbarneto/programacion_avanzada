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

        function getNombreCarreras($contenido) {
            $contenido = preg_split("/[\n]/", $contenido);
            if (count($contenido) < 3) {
                return FALSE;
            } else {
                return $contenido;
            }
        }

        if (isset($_POST['envio1'])) {

            #COMPRABACION DE ERRORES
            if (!isset($_POST['contenido']) || empty($_POST['contenido'])) {
                $errores[] = 'Introduce datos en el text area';
            }if (!($contenido = getNombreCarreras($_POST['contenido']))) {
                $errores[] = 'Minimo tres carreras';
            }

            #PROCESAMIENTO DE DATOS
            if (empty($errores)) {
                include('form.php');
            }
        }
        if (!isset($_POST['envio1']) || isset($errores)) {
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
                Introduce las carreras: <textarea name='contenido'></textarea><br/>
                <input name="envio1" type="submit" value="Enviar"/>
            </form>
            <?php
        }
        ?>
    </body>
</html>
