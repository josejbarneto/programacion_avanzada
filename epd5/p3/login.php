<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login | P3</title>
    </head>
    <body>
        <?php
        include 'funcionesFicheros.php';

        $file = "usuarios.csv";
        $header = ["user", "pass", "mail", "tipo"];

        $usuarios = leerFichero($file, $header);

        function buscarUsuario($user, $array) {
            if ($user) {
                foreach ($array as $val) {
                    if (strcmp($val['user'], $user) == 0) {
                        return $val;
                    }
                }
            }
            return false;
        }

        function testPass($user, $pass) {
            if ($pass && $user) {
                return strcmp($user['pass'], $pass) == 0;
            } else {
                return false;
            }
        }

        if (isset($_POST['login'])) {
            $user = buscarUsuario($_POST['user'], $usuarios);
            if ($user) {
                if (testPass($user, $_POST['pass'])) {
                    include 'index.php';
                } else {
                    echo ("Contraseña incorrecta");
                    pintarLogin();
                }
            } else {
                echo ("El usuario no existe");
                pintarLogin();
            }
        } else {
            pintarLogin();
        }

        function pintarLogin() {
            echo '<form action="login.php" method="post">
                <input name="user" type="text" placeholder="Escribe tu nombre de usuario" required>
                <br><br>
                <input name="pass" type="password" placeholder="Contraseña" required>
                <br><br>
                <input type="submit" name="login" value="Iniciar sesión">
            </form>';
        }
        ?>
    </body>
</html>
