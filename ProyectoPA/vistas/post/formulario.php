<?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
  $usuario = getUsuario(); // O esto quiza lo hagamos con cookies
  $post = getPost() coge el post que queremos editar, o si no hay ninguno crea uno nuevo;
 * 
 * EN CASO DE QUE HAYA POST, EN CADA CAMPO RELLENAMOS EL VALOR QUE TENGA EN BASE DE DATOS
 */
include_once("../../entidades/post.php");
include_once("../../entidades/categoria.php");

session_start();
if (empty($_SESSION['usuario'])) {
    header('location: principal.php');
}

$categorias = getCategorias();

if (isset($_POST['submit'])) {
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
    $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);

    if (empty($titulo) || empty($categoria) || empty($texto)) {
        $errores[] = "$titulo, $categoria, $texto";
    } else {
        crearPost($_SESSION['usuario']['id'], $categoria,$titulo, $texto);
        header('Location: ../../vistas/base/principal.php');
    }
}
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
        if (isset($_POST['submit'])) {
            echo 'holaaaa';
        }
        //AÑADIMOS EL HEADER DE LA PAGINA. 
        //Antes de incluirlo si añadimos variables al header las tocamos aqui
        include_once("../../vistas/base/header.php");
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segment">
                        <h2 class="ui block header">
                            <i class="pen alternate icon"></i>
                            <div class="content">
                                Nuevo Post 
                            </div>
                        </h2>
                        <form class="ui form" action="" method="post">
                            <?php
                            //AQUI DENTRO DEL HTML LO QUE HACEMOS SERA RECORRER LAS VARIABLES QUE RECOJAMOS ARRIBA
                            if (!empty($errores)) {
                                foreach ($errores as $e) {
                                    echo "<span style='color:red;'>$e</span>";
                                }
                            }
                            /*
                             * for (post in post){
                             * echo <div classitem> post[titulo]</div>
                             * }
                             * 
                             * ETC.
                             */
                            ?>
                            <div class="field">
                                <label>Titulo</label>
                                <input type="text" name="titulo" placeholder="Titulo del post" autocomplete="off">
                            </div>
                            <div class="field">
                                <label>Categoria</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="categoria">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Seleccone categoría</div>
                                    <div class="menu">
                                        <?php
                                        //AQUI HAY QUE IR PINTANDO SEGUN LAS CATEGORIAS QUE EXISTAN
                                        foreach ($categorias as $categoria) {
                                            echo "<div class='item' data-value='{$categoria['id']}'>{$categoria['nombre']}</div>";
                                        }
                                        /*
                                         * for (categoria in categorias){
                                         * echo <div class="item" data-value="categoria["id"]">categoria["nombre]</div>;
                                         * }
                                         */
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <h4 class="ui dividing header">Media</h4>
                            <div class="two fields">
                                <div class="field">
                                    <label>Imagen o Gif</label>
                                    <label for="textupload" class="ui icon button">
                                        <i class="file icon"></i>
                                        Selecciona aquí para añadir archivo...
                                    </label>
                                    <input type="file" accept="image/*" id="textupload" class="ui file input">
                                </div>
                                <div class="field">
                                    <label>Introduzca URL del vídeo o imagen</label>
                                    <input type="text" name="url" placeholder="Enlace al video o imagen" autocomplete="off">
                                </div>
                            </div>
                            <div class="field">
                                <label>Texto</label>
                                <textarea name="texto"></textarea>
                            </div>
                            <button class="ui button" type="reset">Resetear</button>
                            <!-- SI NO ES UN NUEVO POST, ESTAMOS VIENDO UNO HECHO ANTES, PODER BORRARLO AQUI -->
                            <button class="ui button negative" type="submit">Eliminar</button>
                            <button name="submit" class="ui right floated positive button" type="submit">Guardar</button>
                        </form>
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