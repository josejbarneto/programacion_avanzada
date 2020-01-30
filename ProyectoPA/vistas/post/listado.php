<?php
/* LISTADO DE POST ES COMO PRINCIPAL PERO YA FILTRADO POR USUARIO O CATEGORIA */
/*
  $usuario = getUsuario(); // O esto quiza lo hagamos con cookies
  $posts = ListarPostPOrcategoria() / listarPostPorUsuario() segun;
 */
include_once '../../entidades/post.php';
$categoriaId = filter_input(INPUT_GET, 'categoria_id', FILTER_SANITIZE_NUMBER_INT);
$usuarioId = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

session_start();
if (isset($categoriaId)) {
    $posts = listarPostsPorCategoria($categoriaId, isset($_SESSION['preferencias'])?$_SESSION['preferencias']['orden']:1);
} else if (isset($usuarioId)) {
    $posts = listarPostsPorUsuario($usuarioId,isset($_SESSION['preferencias'])?$_SESSION['preferencias']['orden']:1);
}
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
    </head>
    <body>
        <?php
        //AÑADIMOS EL HEADER DE LA PAGINA. 
        //Antes de incluirlo si añadimos variables al header las tocamos aqui
        include_once '../../vistas/base/header.php';
        include_once '../../entidades/usuario.php';
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segment">
                        <div class="ui middle aligned divided relaxed list">
                            <?php
                            if ($posts != false) {
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
        include_once("../../vistas/base/footer.php")
        ?>
    </body>
</html>