<?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
  $usuario = getUsuario(); // O esto quiza lo hagamos con cookies
  $posts = getTodosLosPost();
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kaheddit</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="../../recursos/css/base.css">
        <link rel="stylesheet" type="text/css" href="../../recursos/css/header2.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.js"></script>
        <script src="../../recursos/js/base.js"></script>
    </head>
    <body>
        <?php
        //AÑADIMOS EL HEADER DE LA PAGINA. 
        //Antes de incluirlo si añadimos variables al header las tocamos aqui

        include_once '../../entidades/post.php';
        include_once '../../entidades/usuario.php';
        include_once '../../vistas/base/cabecera.php';
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segment">
                        <div class="ui middle aligned divided relaxed list">
                            <?php
                            //AQUI DENTRO DEL HTML LO QUE HACEMOS SERA RECORRER LAS VARIABLES QUE RECOJAMOS ARRIBA

                            if (isset($_SESSION['usuario'])) {
                                $posts = listarPostsPorCategoria(1);
                            } else {
                                $posts = listarPostsPorCategoria(1);
                            }

                            foreach ($posts as $post) {
                                ?>

                                <div class = "ui segment">
                                    <h2 class = "ui block header">
                                        <i class = "pen alternate icon"></i>
                                        <div class = "content"><a href="../../vistas/post/post.php">
                                                <?php echo $post["titulo"];
                                                ?>
                                            </a>
                                            <div class="sub header">
                                                <?php
                                                $usuario = getUsuario($post["idUsuario"]);
                                                echo "{$usuario["usuario"]}";
                                                ?>
                                            </div>
                                        </div>
                                    </h2>
                                    <div class="ui hidden divider"></div>
                                    <div class="text">
                                        <?php echo $post["texto"]; ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
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
        include_once("footer.php")
        ?>
    </body>
</html>