<?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
 * $usuario = getUsuario(); // O esto quiza lo hagamos con session
 * $post = getPost() coge el post que estamos visualizando
 * $comentarios = coger listado de Comentarios de ESE POST();
 * 
 */
//Este post es de ejemplo
$post = ["titulo" => "Post Ejemplo 1",
    "id" => "1",
    "texto" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
    "categoria" => "Categoria 1",
    "usuario" => "Autor",
    "imagen" => "https://d33v4339jhl8k0.cloudfront.net/docs/assets/5c814e0d2c7d3a0cb9325d1f/images/5c8bc20d2c7d3a154460eb97/file-1CjQ85QAme.jpg",
        ]
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kaheddit</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="../../recursos/css/base.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.js"></script>
        <script src="../../recursos/js/base.js"></script>
    </head>
    <body>
        <?php
        //AÑADIMOS EL HEADER DE LA PAGINA. 
        //Antes de incluirlo si añadimos variables al header las tocamos aqui
        include_once("../../vistas/base/header.php")
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segment">
                        <h2 class="ui block header">
                            <i class="pen alternate icon"></i>
                            <div class="content">
                                <?php echo $post["titulo"]; ?>
                                <div class="sub header">
                                    <?php echo $post["usuario"]; ?>
                                </div>
                            </div>
                        </h2>
                        <img class="ui centered medium rounded image" src="<?php echo $post["imagen"]; ?>">
                        <div class="ui hidden divider"></div>
                        <div class="text">
                            <?php echo $post["texto"]; ?>
                        </div>
                    </div>
                    <div class="ui hidden divider"></div>
                    <div class="ui clearing top secondary attached segment">
                        <form class="ui form">
                            <div class="field">
                                <label>Escribe tu comentario:</label>
                                <textarea name="comentario"></textarea>
                            </div>
                            <input type="hidden" value="<?php echo $post["id"]; ?>" name="post_id">
                                <button class="ui right floated blue button" type="submit"><i class="edit icon"></i>Publicar</button>
                        </form>
                    </div>
                    <div class="ui bottom attached segment">
                        <div class="ui comments">
                            <div class="comment">
                                <a class="avatar">
                                    <img src="/images/avatar/small/matt.jpg">
                                </a>
                                <div class="content">
                                    <a class="author">Matt</a>
                                    <div class="metadata">
                                        <span class="date">Today at 5:42PM</span>
                                    </div>
                                    <div class="text">
                                        How artistic!
                                    </div>
                                    <div class="actions">
                                        <a class="reply">Reply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">
                                <a class="avatar">
                                    <img src="/images/avatar/small/elliot.jpg">
                                </a>
                                <div class="content">
                                    <a class="author">Elliot Fu</a>
                                    <div class="metadata">
                                        <span class="date">Yesterday at 12:30AM</span>
                                    </div>
                                    <div class="text">
                                        <p>This has been very useful for my research. Thanks as well!</p>
                                    </div>
                                    <div class="actions">
                                        <a class="reply">Reply</a>
                                    </div>
                                </div>
                                <div class="comments">
                                    <div class="comment">
                                        <a class="avatar">
                                            <img src="/images/avatar/small/jenny.jpg">
                                        </a>
                                        <div class="content">
                                            <a class="author">Jenny Hess</a>
                                            <div class="metadata">
                                                <span class="date">Just now</span>
                                            </div>
                                            <div class="text">
                                                Elliot you are always so right :)
                                            </div>
                                            <div class="actions">
                                                <a class="reply">Reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">
                                <a class="avatar">
                                    <img src="/images/avatar/small/joe.jpg">
                                </a>
                                <div class="content">
                                    <a class="author">Joe Henderson</a>
                                    <div class="metadata">
                                        <span class="date">5 days ago</span>
                                    </div>
                                    <div class="text">
                                        Dude, this is awesome. Thanks so much
                                    </div>
                                    <div class="actions">
                                        <a class="reply">Reply</a>
                                    </div>
                                </div>
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
        include_once("../../vistas/base/footer.php")
        ?>
    </body>
</html>