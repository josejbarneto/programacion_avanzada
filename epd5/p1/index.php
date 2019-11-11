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

        if (isset($_POST['envioAerolinea'])) {

            #SANETIZAR Y TRATAMIENTO ERRORES
            if (empty($_POST['nombreAerolinea'])) {
                $errores[] = 'Rellenar campo nombre aerolinea';
            } else {
                $nombreAerolinea = filter_input(INPUT_POST, 'nombreAerolinea', FILTER_SANITIZE_STRING);
            }
            
            if (empty($_POST['numeroDestinos'])) {
                $errores[] = 'Rellenar campo numero destinos';
            } else {
                $numeroDestinos = filter_input(INPUT_POST,'numeroDestinos', FILTER_SANITIZE_NUMBER_INT);
                if(!filter_var($numeroDestinos, FILTER_VALIDATE_INT) || $numeroDestinos > count(leerDestinos()) || $numeroDestinos < 1){
                    $errores[]='Introduzca un numero de destinos correcto';
                }
            }

            #PROCESAMIENTO
            if (empty($errores)) {
                session_start();
                $_SESSION['nombreAerolinea'] = $nombreAerolinea;
                $_SESSION['numeroDestinos'] = $numeroDestinos;
                include 'destinos.php';
            }
        }

        if (!isset($_POST['envioAerolinea']) || isset($errores)) {
            if (isset($errores)) {
                echo '<ul style="color:red;">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }
            ?>
            <form action="#" method="POST">
                Nombre de la Aerolinea: <input name="nombreAerolinea" type="text"/><br/>
                Numero de destinos: <input name="numeroDestinos" type=""text/><br/>
                <input name="envioAerolinea" type="submit" value="Enviar"/>
            </form>
            <?php
        }
        ?>
    </body>
</html>
