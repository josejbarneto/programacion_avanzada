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

        function mostrarInformacion($usuario) {
            $conn = conectarBaseDatos();
            $consulta = "select nombre, tiempo from usuarios where usuario='$usuario';";

            $resultado = mysqli_query($conn, $consulta) or die("Algo ha ido mal en la consulta a la base de datos");

            while ($columna = mysqli_fetch_array($resultado)) {
                echo "Usuario: {$columna['nombre']} desde {$columna['tiempo']}";
            }

            mysqli_close($conn);
        }

        if (isset($_POST['logout'])) {
            $_SESSION['autentificado'] = false;
            header('Location: index.php');
        } else {
            session_start();
            $usuario = $_SESSION['usuario'];
            $_SESSION['autentificado'] = true;
            mostrarInformacion($usuario);
        
        ?>
        
        <form action="#" method="post">
            <input type="submit" name="logout" value="Log out">
        </form>
        <?php
        }
        ?>
    </body>
</html>
