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
        
            if(isset($_POST['envioAerolinea'])){
                
               #SANETIZAR!!!
                
               #TRATAMIENTO ERRORES
               if(!isset($_POST['nombreAerolinea']) || empty($_POST['nombreAerolinea'])){
                   $errores[]='Rellenar campo nombre aerolinea';
               }if(!isset($_POST['numeroDestinos']) || empty($_POST['numeroDestinos'])){
                   $errores[]='Rellenar campo numero destinos';
               }
                
                
               #PROCESAMIENTO
               if(empty($errores)){
                   session_start();
                   $_SESSION['nombreAerolinea'] = $_POST['nombreAerolinea'];
                   $_SESSION['numeroDestinos']=$_POST['numeroDestinos'];
                   include 'destinos.php';
               }
            }
            
            if (!isset($_POST['envioAerolinea']) || !empty($errores)){
                if(!empty($errores)){
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
