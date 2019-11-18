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

        include 'baseDatos.php';

        function isUsuarioExistente($usuario) {
            $conn = conectarBaseDatos();
            $consulta = "select COUNT(usuario) from usuarios where usuario='$usuario';";

            $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

            mysqli_close($conn);
            
            $r = mysqli_fetch_array($resultado);
            
            if ($r['COUNT(usuario)'] == 1) {
                return true;
            } else {
                return false;
            }
        }
        
        function introducirNuevoUsuario($usuario, $contrasena, $nombre, $date){
            $conn = conectarBaseDatos();
            
            $dateBD = "{$date['year']}-{$date['mon']}-{$date['mday']}";

            $consulta = "insert into usuarios (nombre, usuario, contrasena, tiempo) VALUES ('$nombre', '$usuario', '$contrasena', '$dateBD');";
            
            mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

            mysqli_close($conn);
        }


        if (isset($_POST['registrar'])) {
            $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
            $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
            $contrasena = filter_input(INPUT_POST, "contrasena", FILTER_SANITIZE_SPECIAL_CHARS);

            if (!preg_match('/^[a-zA-z]{4,20}/', $nombre)) {
                $errores[] = 'Error en el nombre';
            }if (!preg_match('/[a-zA-Z0-9_]{4,20}/', $usuario)) {
                $errores[] = 'Error en el usuario';
            }if (!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', $contrasena)) {
                $errores[] = 'Error en la contraseña';
            }

            if (empty($errores) && isUsuarioExistente($usuario)) {
                $errores[] = 'Este usuario YA existe';
            }

            if (empty($errores)) {
                introducirNuevoUsuario($usuario, $contrasena, $nombre, getdate());
                header('Location: index.php');
            }
        }

        if (!isset($_POST['registrar']) || !empty($errores)) {
            #Errores
            if (!empty($errores)) {
                echo '<ul style="color:red;">';

                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }

                echo '</ul>';
            }
            ?>       
            <form action="#" method="POST">
                Nombre: <input type="text" name="nombre"/><br/>
                Usuario: <input type="text" name="usuario"/><br/><br/>
                La contraseña debe contener 8 caracteres una mayúscula una minúscula y un número mínimo.<br/>
                Contraseña: <input type="password" name="contrasena"/><br/>
                <input type="submit" name="registrar" value="Registrarse"/>
            </form>
            <?php
        }
        ?>
    </body>
</html>
