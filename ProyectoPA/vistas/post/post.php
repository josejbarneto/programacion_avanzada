<?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
 * $usuario = getUsuario(); // O esto quiza lo hagamos con session
 * $post = getPost() coge el post que estamos visualizando
 * $comentarios = coger listado de Comentarios de ESE POST();
 * 
 */
include_once '../../entidades/post.php';
include_once '../../entidades/comentario.php';
include_once '../../entidades/reaccion.php';

session_start();

//si viene de clicar un post
$idPost = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

//al comentar
if (isset($_POST['comentar'])) {
    $idPost = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
    $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_STRING);
    if (strlen($comentario) < 2) {
        $errores[] = 'Error al comentar';
    } else {
        crearComentario($comentario, $_SESSION['usuario']['id'], $idPost);
    }
}

//eliminar comentario
if(isset($_POST['eliminarComentario'])){
    $idComentario = filter_input(INPUT_POST, 'comentario_id', FILTER_SANITIZE_NUMBER_INT);
    borrarComentario($idComentario);
}

//likes y dislike
if (isset($_POST['like']) || isset($_POST['dislike'])) {

    //reac contiene si es like o dislike
    $reac = isset($_POST['like']) ? 1 : 0;

    //get idpost e id usuario
    $idPost = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
    $idUsuario = filter_input(INPUT_POST, 'usuario_id', FILTER_SANITIZE_NUMBER_INT);

    //si existe reaccion y clicamos en el mismo boton, eliminamos la reaccion, si no, la editamos
    if (existReaccion($idUsuario, $idPost)) {
        $reaccion = getReaccion($idUsuario, $idPost);

        if ($reac == $reaccion['tipo']) {
            borrarReaccion($idUsuario, $idPost);
        } else {
            editarReaccion($idUsuario, $idPost, $reac);
        }
    } else {
        crearReaccion($idUsuario, $idPost, $reac); //si no esta creada la creamos
    }

    $reaccion = getReaccion($idUsuario, $idPost);
}

//Si el usuario esta logueado
if (isset($_SESSION['usuario'])) {
    $reaccion = getReaccion($_SESSION['usuario']['id'], $idPost);
}

$post = getPost($idPost);
$comentarios = listarComentariosPorPost($idPost);
$numReacciones = getReacciones($idPost);
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
        include_once '../../vistas/base/header.php';
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

                                <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $post['idUsuario']) { ?>
                                    <a class="editarMyPost" href="../../vistas/post/formulario.php?id_post=<?php echo $post["id"]; ?>"><i class="edit icon"></i>Editar</a>
                                <?php } ?>
                            </h2>
                            <?php if ($post["imagen"] != "") { ?>
                                <img class="ui centered medium rounded image" src="<?php echo $post["imagen"]; ?>">
                            <?php } elseif ($post["url"] != "") { ?>   
                                <?php if (is_array(getimagesize($post["url"]))) { ?>
                                    <img class="ui centered medium rounded image" src="<?php echo $post["url"]; ?>">
                                <?php } else { ?>   
                                    <iframe width="420" height="315"
                                            src="<?php echo $post["url"]; ?>">
                                    </iframe>
                                <?php } ?>
                            <?php } ?>

                            <div class="ui hidden divider"></div>
                            <div class="text">
                                <?php echo $post["texto"]; ?>
                            </div>
                        </div>


                        <div class="ui right aligned clearing segment">

                            <!--Solo se muestra span si no esta logueado un usuario-->
                            <?php if (isset($_SESSION['usuario'])) { ?>
                                <!-- SEGUN EL NAME DEL SUBMIT LO GUARDAS COMO LIKE O COMO DISLIKE -->
                                <form method="post">
                                <?php } ?>
                                <button class="ui labeled icon basic right floated button" type="submit" name="like" <?php
                                if (isset($reaccion) && $reaccion['tipo'] == 1) {
                                    echo "style='color:green;'";
                                }else{
                                    echo "style='color:none;'";
                                }
                                ?>>
                                    <i class="thumbs up outline icon"></i>
                                    <span id="likes"><?php echo $numReacciones['likes'] ?></span>
                                </button>
                                <input type="hidden" value="<?php echo $post["id"] ?>" name="post_id">
                                <input type="hidden" value="<?php echo $_SESSION['usuario']['id'] ?>" name="usuario_id">
                                <?php if (isset($_SESSION['usuario'])) { ?>
                                </form>

                                <form method="post">
                                <?php } ?>
                                <button class="ui labeled icon basic right floated button" type="submit" name="dislike" <?php
                                if (isset($reaccion) && $reaccion['tipo'] == 0) {
                                    echo "style='color:red;'";
                                }else{
                                    echo "style='color:none;'";
                                }
                                ?>>
                                    <i class="thumbs down outline icon"></i>
                                    <span id="dislikes"><?php echo $numReacciones['dislikes'] ?></span>
                                </button>
                                <input type="hidden" value="<?php echo $post["id"] ?>" name="post_id">
                                <input type="hidden" value="<?php echo $_SESSION['usuario']['id'] ?>" name="usuario_id">
                                <?php if (isset($_SESSION['usuario'])) { ?>
                                </form>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                    if (!empty($errores)) {
                        echo '<div class="ui negative message">';
                        echo '<div class="header">Errores en el formulario</div><ul class="list">';

                        foreach ($errores as $e) {
                            echo "<li'>$e</li>";
                        }
                        echo '</ul></div>';
                    }
                    ?>
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
                                        <div class="content">
                                            <a href='../../vistas/post/listado.php?id_usuario=<?php echo $c['idUsuario'] ?>' class="author"><?php echo $c['nombreUsuario'] ?></a>
                                            <div class="metadata">
                                                <span class="date"><?php echo $c['fechaCreacion'] ?></span>
                                            </div>
                                            <div class="text">
                                                <?php echo $c['texto'] ?>
                                            </div>
                                            <?php if (isset($_SESSION['usuario']) && $c['idUsuario']==$_SESSION['usuario']['id']) { ?>
                                                <div class="actions">
                                                    <form method="post">
                                                        <input class="delete" type="submit" value="Eliminar" name='eliminarComentario'>
                                                        <input type="hidden" value="<?php echo $c['id'] ?>" name='comentario_id'>
                                                    </form>
                                                </div>
                                            <?php } ?>
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
        include_once("../../vistas/base/footer.php");
        ?>
    </body>

</html>