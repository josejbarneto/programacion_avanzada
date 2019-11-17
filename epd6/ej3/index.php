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

            $consulta = "select usuario, contrasena from usuarios where usuario='$usuario';";

            $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

            mysqli_close($conn);

            $r = mysqli_fetch_array($resultado);

            if(empty($r) || password_verify($contrasena, $r['contrasena'])){
                return false;
            }else{
                return true;
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
            $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);
            $contrasena = filter_input(INPUT_POST, "contrasena", FILTER_SANITIZE_SPECIAL_CHARS);

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
                session_start();
                $_SESSION['usuario'] = $usuario;
                header('Location: pagePrincipal.php');
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
