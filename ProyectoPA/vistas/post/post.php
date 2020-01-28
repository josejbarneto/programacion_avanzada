<?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
 * $usuario = getUsuario(); // O esto quiza lo hagamos con session
 * $post = getPost() coge el post que estamos visualizando
 * $comentarios = coger listado de Comentarios de ESE POST();
 * 
 */
//Este post es de ejemplo
include_once '../../entidades/post.php';
include_once '../../entidades/comentario.php';

$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$post = getPost($idPost);

if (isset($_POST['comentar'])) {
    $postId = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
    $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);
    session_start();
    crearComentario($comentario, $_SESSION['usuario']['id'], $postId);
}

$comentarios = listarComentariosPorPost($idPost);
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
        include_once '../../vistas/base/cabecera.php';
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segments">
                        <div class="ui segment">
                            <h2 class="ui block header">
                                <i class="pen alternate icon"></i>
                                <div class="content">
                                    <?php echo $post["titulo"]; ?>
                                    <div class="sub header">
                                        <?php echo $post["usuario"]; ?>
                                    </div>
                                </div>
                                <?php if ($_SESSION['usuario']['id'] == $post['idUsuario']) { ?>
                                    <a href="../../vistas/post/formulario.php?id_post=<?php echo $post["id"]; ?>">Editar</a>
                                <?php } ?>
                            </h2>
                            <img class="ui centered medium rounded image" src="<?php echo $post["imagen"]; ?>">
                            <div class="ui hidden divider"></div>
                            <div class="text">
                                <?php echo $post["texto"]; ?>
                            </div>
                        </div>
                        <div class="ui right aligned clearing segment">
                            <!-- SEGUN EL NAME DEL SUBMIT LO GUARDAS COMO LIKE O COMO DISLIKE -->
                            <form>
                                <?php /* si el usuario ya le ha dado like, podriamos ponerle color al boton, con añadirle la clase GREEN vale */ ?>
                                <button class="ui labeled icon basic right floated button" type="submit" name="like">
                                    <i class="thumbs up outline icon"></i>
                                    <span id="likes">20</span><?php /* poner aqui numero de likes */ ?>
                                </button>
                                <input type="hidden" value="<?php echo $post["id"]; ?>" name="post_id">
                                <input type="hidden" value="<?php /* poner aqui id usuario */ ?>" name="usuario_id">
                            </form>
                            <form>
                                <?php /* en el form habra que controlar que si ya tiene like y le da dislike hay que cambiarlo */ ?>
                                <button class="ui labeled icon basic right floated button" type="submit" name="dislike">
                                    <i class="thumbs down outline icon"></i>
                                    <span id="likes">12</span>
                                </button>
                                <input type="hidden" value="<?php echo $post["id"]; ?>" name="post_id">
                                <input type="hidden" value="<?php /* poner aqui id usuario */ ?>" name="usuario_id">
                            </form>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['usuario'])) { ?>
                        <div class="ui hidden divider"></div>
                        <div class="ui clearing top secondary attached segment">
                            <form class="ui form" method="post" >
                                <div class="field">
                                    <label>Escribe tu comentario:</label>
                                    <textarea name="comentario"></textarea>
                                </div>
                                <input type="hidden" value="<?php echo $post["id"]; ?>" name="post_id">
                                <button class="ui right floated blue button" name='comentar' type="submit"><i class="edit icon"></i>Publicar</button>
                            </form>
                        </div>
                    <?php } ?>

                    <div class="ui bottom attached segment">
                        <div class="ui comments">

                            <?php
                            if ($comentarios != false) {
                                foreach ($comentarios as $c) {
                                    ?>
                                    <div class="comment">
                                        <a class="avatar">
                                            <img src="/images/avatar/small/joe.jpg">
                                        </a>
                                        <div class="content">
                                            <a class="author"><?php echo $c['nombreUsuario'] ?></a>
                                            <div class="metadata">
                                                <span class="date"><?php echo $c['fechaCreacion'] ?></span>
                                            </div>
                                            <div class="text">
                                                <?php echo $c['texto'] ?>
                                            </div>
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
        include_once("../../vistas/base/footer.php")
        ?>
    </body>
</html>