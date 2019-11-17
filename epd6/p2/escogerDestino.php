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
        if (isset($_POST['EnvioEscogerDestino'])) {
            include 'funcionesLecturaEscritura.php';
            session_start();
        }


        if (isset($_POST['EnvioEscogerDestino'])) {
            #TRATAMIENTO DE ERRORES
            if (empty($_POST['tiempo'])) {
                $errores[] = 'Introducir el tiempo';
            }
            
            #PROCESAMIENTO
            if (empty($errores)) {
                #comprobar hora y destinos
                $aux = preg_split('/[;]/', $_POST['destinos']);
                escribirConexiones($aux[0], $_SESSION['origen'], $aux[1], $_POST['tiempo']);
            }
        }

        #FORMULARIO
        if (!isset($_POST['EnvioEscogerDestino']) || isset($errores)) {

            #ERRORES
            if (!empty($errores)) {
                echo '<ul style="color:red;">';
                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }
                echo '</ul>';
            }
            
            #CREACION DEL FORMULARIO
            ?>
            <form action="escogerDestino.php" method="POST">
                Introduce el tiempo: <input name="tiempo" type="time"/><br/>
                <select name="destinos">
                    <?php
                    foreach ($_SESSION['destinos'] as $d) {
                        echo "<option value='{$d['id']};{$d['nombre']}'>{$d['nombre']}</option>";
                    }
                    ?>
                </select><br/>
                <input name="EnvioEscogerDestino" type="submit" value="Enviar"/>
            </form>
    <?php
}
?>
    </body>
</html>
