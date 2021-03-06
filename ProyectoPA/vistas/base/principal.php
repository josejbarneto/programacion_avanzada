<?php
session_start();

/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
include_once '../../entidades/categoria.php';
$categorias = getCategorias();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kaheddit</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="../../recursos/css/base.css">
        <link rel="stylesheet" type="text/css" href="../../recursos/css/header.css">
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
        include_once '../../vistas/base/header.php';
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segment">
                        <div class="ui middle aligned divided relaxed list">
                            <?php
                            //AQUI DENTRO DEL HTML LO QUE HACEMOS SERA RECORRER LAS VARIABLES QUE RECOJAMOS ARRIBA
                            if (isset($_SESSION['preferencias'])) {
                                $posts = listarPostsPorCategoria($_SESSION['preferencias']['id_categoria_inicial'], $_SESSION['preferencias']['orden']);
                            } else {
                                $posts = listarPostsPorCategoria(1, 1);
                            }

                            if (!empty($posts)) {
                                foreach ($posts as $post) {
                                    ?>

                                    <div class = "ui segment">
                                        <h2 class = "ui block header">
                                            <i class = "pen alternate icon"></i>
                                            <div class = "content"><a href="../../vistas/post/post.php?id=<?php echo $post["id"]; ?>">
                                                    <?php echo $post["titulo"];
                                                    ?>
                                                </a>
                                                <div class="sub header">
                                                    <?php
                                                    $usuario = getUsuarioById($post["idUsuario"]);
                                                    echo "<a href='../../vistas/post/listado.php?id_usuario={$usuario['id']}' >{$usuario["usuario"]}</a>";
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