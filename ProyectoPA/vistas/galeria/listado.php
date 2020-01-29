<?php
$imagesDir = '../../uploads/';
//Cojo todas las ficheros con esa extension de la carpeta uploads
//glob — Buscar coincidencias de nombres de ruta con un patron
$images = glob($imagesDir . '*.{jpg,jpeg,png,gif,PNG,JPG,JPEG,GIF}', GLOB_BRACE);
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
        <script src="../../util/siema/siema.min.js"></script>
        <script src="../../recursos/js/galeria.js"></script>
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
                        <h2 class="ui block header">
                            <i class="photo video icon"></i>
                            <div class="content">
                                Galeria de Kaheddit
                            </div>
                        </h2>
                        <div class="ui center aligned top attached segment">
                            <button class="ui left labeled basic icon small button" id='prev'>
                                <i class="left arrow icon"></i>
                                Anterior
                            </button>
                            <button class="ui right labeled basic icon small button" id='next'>
                                <i class="right arrow icon"></i>
                                Siguiente
                            </button>
                        </div>
                        <div class="ui center aligned bottom attached secondary segment siema">
                            <?php
                            foreach ($images as $image) {
                                echo '<div><img src="' . $image . '"/></div>';
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