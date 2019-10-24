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

        function formulario($contenido) {
            if (isset($_POST['envio'])) {

                #COMPRABACION DE ERRORES
                
                
                #PROCESAMIENTO DE DATOS
                if (empty($errores)) {
                    
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
                    <input type="radio" name="peticion" value="vencedor"/>Vencedor
                    <input type="radio" name="peticion" value="equipoVencedor"/>Equipo Vencedor<br/>
                    <textarea name="contenido"></textarea><br/>
                    <input name="envio" type="submit" value="Enviar"/>
                </form>
           <?php
            }
        }   

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
            if (!isset($POST['contenido']) || empty($POST['contenido'])) {
                $errores1 = 'Introduce datos en el text area';
            }if (!($contenido = getNombreCarreras($_POST['contenido']))) {
                $errores1 = 'Introduce minimo tres carreras';
            }

            #PROCESAMIENTO DE DATOS
            if (empty($errores1)) {
                foreach ($contenido as $c) {
                    formulario($c);
                }
            }
        }
        if (!isset($_POST['envio1']) || isset($errores1)) {
            echo '<h1>Formulario de peticiones</h1>';

            #TRATAMIENTO DE ERRORES

            if (isset($errores1)) {
                echo '<p style="color:red">Errores Cometidos</p>';
                echo '<ul style="color:red">';
                foreach ($errores1 as $e) {
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
