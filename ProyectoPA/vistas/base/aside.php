<?php
$imagesDir = '../../uploads/';

$images = glob($imagesDir . '*.{jpg,jpeg,png,gif,PNG,JPG,JPEG,GIF}', GLOB_BRACE);

$randomImage = $images[array_rand($images)];
?>
<div class="ui segment">
    <div class="ui middle aligned divided relaxed centered list">
        <?php if (isset($_SESSION['usuario'])) { ?>
            <div class="item">
                <div class="content">
                    <a class="header">MIS POST</a>
                </div>
            </div>
            <div class="item">
                <div class="content">
                    <a class="header">MIS CATEGORIAS</a>
                </div>
            </div>
            <a class="centered item" href="../../vistas/galeria/listado.php">
                <div class="ui centered header">
                    GALERIA KAHEDDIT
                </div>
                <img class="ui image" src="<?php echo $randomImage; ?>">
            </a>
            <a href="https://www.upo.es" class="centered item">
                <img class="ui image" src="../../recursos/img/publi1.jpg">
            </a>
        <?php } else { ?>
            <a class="centered item" href="../../vistas/galeria/listado.php">
                <div class="ui centered header">
                    GALERIA KAHEDDIT
                </div>
                <img class="ui image" src="<?php echo $randomImage; ?>">
            </a>
            <a href="https://www.upo.es" class="centered item">
                <img class="ui image" src="../../recursos/img/publimediamark.jpg">
            </a>
            <a href="https://www.upo.es" class="centered item">
                <img class="ui image" src="../../recursos/img/publipc.jpg">
            </a>
            <a href="https://www.upo.es" class="centered item">
                <img class="ui image" src="../../recursos/img/publi1.jpg">
            </a>
        <?php } ?>
    </div>
</div>