<?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
  $usuario = getUsuario(); // O esto quiza lo hagamos con cookies
  $posts = getTodosLosPost();
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kaheddit</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="../recursos/css/base.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.js"></script>
    </head>
    <body>
        <?php
        //AÑADIMOS EL HEADER DE LA PAGINA. 
        //Antes de incluirlo si añadimos variables al header las tocamos aqui
        include_once("../base/header.php")
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui segment">
                        <div class="ui middle aligned divided relaxed list">
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
                            <div class="item">
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <a class="header">Ejemplo de Post 1</a>
                                </div>
                            </div>
                            <div class="item">
                                <img class="ui avatar image" src="/images/avatar/small/stevie.jpg">
                                <div class="content">
                                    <a class="header">Ejemplo de Post 2</a>
                                </div>
                            </div>
                            <div class="item">
                                <img class="ui avatar image" src="/images/avatar/small/elliot.jpg">
                                <div class="content">
                                    <a class="header">Ejemplo de Post 3</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui four wide column">
                    <div class="ui segment">
                        <div class="ui middle aligned divided relaxed list">
                            <div class="item">
                                <img class="ui avatar image" src="/images/avatar/small/daniel.jpg">
                                <div class="content">
                                    <a class="header">INFORMACION DE INTERES</a>
                                </div>
                            </div>
                            <div class="item">
                                <img class="ui avatar image" src="/images/avatar/small/stevie.jpg">
                                <div class="content">
                                    <a class="header">PUBLICIDAD</a>
                                </div>
                            </div>
                            <div class="item">
                                <img class="ui avatar image" src="/images/avatar/small/elliot.jpg">
                                <div class="content">
                                    <a class="header">OTRA COSA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </article>

        <?php
        //AÑADIMOS EL FOOTER DE LA PAGINA. 
        //Antes de incluirlo si añadimos variables al footer las tocamos aqui
        include_once("../base/footer.php")
        ?>
    </body>
</html>