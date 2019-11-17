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

        function existeUsuario($usuario, $contrasena) {
            $conn = conectarBaseDatos();
            
            $consulta = "select COUNT(usuario) from usuarios where usuario='$usuario' and contrasena='$contrasena';";

            $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

            mysqli_close($conn);

            $r = mysqli_fetch_array($resultado);

            if ($r['COUNT(usuario)'] == 1) {
                return true;
            } else {
                return false;
            }
        }

        function mostrarInformacion($usuario) {
            $conn = conectarBaseDatos();
            $consulta = "select nombre, tiempo from usuarios where usuario='$usuario';";

            $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");
            
            while ($columna = mysqli_fetch_array($resultado)) {
                echo "Usuario: {$columna['nombre']} desde {$columna['tiempo']}";
            }

            mysqli_close($conn);
            
        }

        if (isset($_POST['login'])) {
            #Filtros y control de errores
            $usuario = $_POST['usuario'];
            $contrasena = $_POST['contrasena'];

            if (empty($usuario)) {
                $errores[] = 'Introduzca un usuario';
            }

            if (empty($contrasena)) {
                $errores[] = 'Introduzca una contraseña';
            }

            if (!isset($errores) && !existeUsuario($usuario, $contrasena)) {
                $errores[] = 'Error al iniciar sesión';
            }

            #Procesamiento
            if (empty($errores)) {
                mostrarInformacion($usuario);
            }
        }

        if (!isset($_POST['login']) || !empty($errores)) {

            #Errores
            if (!empty($errores)) {
                echo '<ul style="color:red;">';

                foreach ($errores as $e) {
                    echo "<li>$e</li>";
                }

                echo '</ul>';
            }


            #Formulario    
            ?>
            <form action="#" method="POST">
                Usuario: <input type="text" name="usuario"/><br/>
                Contraseña: <input type="password" name="contrasena"/><br/>
                <input type="submit" name="login" value="Log in"/>
                <a href="registro.php"><input type="button" name="registro" value="Registrarse"/></a>
            </form>

            <?php
        }
        ?>
    </body>
</html>
