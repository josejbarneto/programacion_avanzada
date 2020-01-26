 <?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
  $usuario = getUsuario(); // O esto quiza lo hagamos con cookies
  $post = getPost() coge el post que queremos editar, o si no hay ninguno crea uno nuevo;
 * 
 * EN CASO DE QUE HAYA POST, EN CADA CAMPO RELLENAMOS EL VALOR QUE TENGA EN BASE DE DATOS
 */
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
                                Nuevo Post 
                            </div>
                        </h2>
                        <form class="ui form" action="">
                            <?php
                            //AQUI DENTRO DEL HTML LO QUE HACEMOS SERA RECORRER LAS VARIABLES QUE RECOJAMOS ARRIBA

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
                                        <div class="item" data-value="1">Categoria 1</div>
                                        <div class="item" data-value="2">Categoria 2</div>
                                        <?php
                                        //AQUI HAY QUE IR PINTANDO SEGUN LAS CATEGORIAS QUE EXISTAN

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
                                <textarea></textarea>
                            </div>
                            <button class="ui button" type="reset">Resetear</button>
                            <!-- SI NO ES UN NUEVO POST, ESTAMOS VIENDO UNO HECHO ANTES, PODER BORRARLO AQUI -->
                            <button class="ui button negative" type="submit">Eliminar</button>
                            <button class="ui right floated positive button" type="submit">Guardar</button>
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