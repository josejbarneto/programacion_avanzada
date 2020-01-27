<?php
include_once("../../entidades/usuario.php");

session_start();
$vistas = ["Clasica", "Compacta", "Ancha"];
$ordenes = ["Por novedad", "Por reacciones", "Alfabético"];
$usuario = getUsuario(htmlspecialchars($_GET['id']));
$preferencias = isset($_SESSION['preferencias']) ? $_SESSION['preferencias'] : [];
$comentarios = [];
$posts = [];
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
        include_once("../../vistas/base/header.php")
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui clearing segment">
                        <h2 class="ui block header">
                            <i class="user alternate icon"></i>
                            <div class="content">
                                Perfil de <?php echo $usuario["usuario"]; ?>
                            </div>
                        </h2>
                        <h3 class="ui dividing header">Últimos post</h3>
                        <div class="ui middle aligned very relaxed list">
                            <?php
                            foreach ($posts as $post) {
                                echo '<a class="item" href="">';
                                echo '<div class="content">';
                                echo '<a class="header">' . $post["titulo"] . '</a>';
                                echo '</div>';
                                echo '</a';
                            }
                            ?>
                        </div>
                        <h3 class="ui dividing header">Últimos comentarios</h3>
                        <div class="ui middle aligned very relaxed list">
                            <?php
                            foreach ($comentarios as $comentario) {
                                echo '<a class="item" href="">';
                                echo '<div class="content">';
                                echo '<a class="header">' . $comentario["post"] . '</a>';
                                echo $comentario["texto"];
                                echo '</div>';
                                echo '</a';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <aside class="ui four wide column">
                    <?php
                    include_once("../../vistas/base/aside.php")
                    ?>
                </aside>
            </section>
        </article>

        <?php
        include_once("../../vistas/base/footer.php")
        ?>
    </body>
</html>