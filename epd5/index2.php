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
        
            $aerolineas = leerAerolineas();
            $destinosAerolineas = leerDestinosAerolineas();
            
            echo '<form action="" method="POST"/>';
            
            foreach ($aerolineas as $aerolinea) {
                echo "<p style='font-weight: bold;'>{$aerolinea['nombre']}</p>";
                $id = $aerolinea['id'];
                
                foreach ($destinosAerolineas as $destino) {
                    if($destino['id'] == $id){
                        echo "{$destino['nombre']}<input type='radio' value='{$destino['nombre']}$id' name='{$aerolinea['nombre']}'/>";
                    }
                }
                echo '<br/>';
            }
            
            echo '</form><br/>';
            echo '<input type="submit" name="envio" value="Enviar"/>';
        ?>
    </body>
</html>
