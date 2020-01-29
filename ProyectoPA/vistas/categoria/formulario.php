<?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
  $usuario = getUsuario(); // O esto quiza lo hagamos con cookies
  $posts = getTodosLosPost();
 */

include_once '../../entidades/categoria.php';

if (isset($_POST['crear'])) {
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);

    if (count($nombre) < 3) {
        $errores[] = 'Minimo 3 caracteres para el titulo';
    }if (count($desc) < 3) {
        $errores[] = 'Minimo 3 caracteres para la descripcion';
    }

    crearCategoria($nombre, $desc);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kaheddit</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="../recursos/css/base.css">
        <link rel="stylesheet" type="text/css" href="../../recursos/css/header.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.js"></script>
    </head>
    <body>
        <?php
        //AÑADIMOS EL HEADER DE LA PAGINA. 
        //Antes de incluirlo si añadimos variables al header las tocamos aqui
        include_once '../../vistas/base/header.php';
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segment">
                        <div class="ui middle aligned divided relaxed list">
                            <?php
                            foreach ($_SESSION['errores'] as $e) {
                            echo "<span style='color:red;'>$e</span><br/>";
                            }
                            echo '<br/>';
                            ?>
                            <form method="post">
                                Nombre: <input name='nombre'/><br/>
                                Desc: <input name='desc'/>
                                <button type="submit" name='crear'>Crear</button>
                            </form>

                        </div>
                    </div>
                </div>
                </div>
                <aside class="ui four wide column">
                    <?php
                    //AÑADIMOS EL ASIDE DE LA DERECHA. 
                    include_once("../../vistas/base/aside.php")
                    ?>
                </aside>
            </section>
        </article>

        <?php
        //AÑADIMOS EL FOOTER DE LA PAGINA. 
        //Antes de incluirlo si añadimos variables al footer las tocamos aqui
        include_once("../base/footer.php")
        ?>
    </body>
</html>