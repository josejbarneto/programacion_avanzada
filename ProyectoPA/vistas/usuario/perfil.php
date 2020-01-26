<?php
/* AQUI LLAMAMOS A LAS FUNCIONES QUE RELLENEN LAS VARIABLES */
/*
 * 
 * si viene post hacer el guardado del usuario
 * IF $_POST(){
 * 
 * }
 * 
 * $usuario = getUsuario(); // O esto quiza lo hagamos con cookies
 * 
 */
$vistas = ["Clasica", "Compacta", "Ancha"];
$ordenes = ["Por novedad", "Por reacciones", "Alfabético"];
$usuario = [
    "nombre" => "Usuario de prueba",
    "email" => "user@mail.com",
    "pass" => "password",
    "vista" => 2,
    "orden" => 2,
    "nocturno" => false,
    "lenguaje" => false,
    "newtab" => true,
];
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
                    <div class="ui clearing segment">
                        <h2 class="ui block header">
                            <i class="user alternate icon"></i>
                            <div class="content">
                                Perfil de Usuario
                            </div>
                        </h2>
                        <form class="ui form" method="post" action="">
                            <div class="three fields">
                                <div class="field">
                                    <label>Nombre</label>
                                    <input type="text" name="name" autocomplete="off" value="<?php echo $usuario["nombre"]; ?>">
                                </div>
                                <div class="field">
                                    <label>Email</label>
                                    <input type="text" name="email" autocomplete="off" value="<?php echo $usuario["email"]; ?>">
                                </div>
                                <div class="field">
                                    <label>Contraseña</label>
                                    <input type="password" name="pass" autocomplete="off" value="<?php echo $usuario["pass"]; ?>">
                                </div>
                            </div>
                            <h4 class="ui dividing header">Preferencias</h4>
                            <div class="field">
                                <label>Vista predeterminada</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="vista" value="<?php echo $usuario["vista"]; ?>">
                                    <i class="dropdown icon"></i>
                                    <div class="text"><?php echo $vistas[$usuario["vista"]]; ?></div>
                                    <div class="menu">
                                        <div class="item <?php echo ($usuario["vista"] == 1 ? "active" : ""); ?>" data-value="1">Clasica </div>
                                        <div class="item <?php echo ($usuario["vista"] == 2 ? "active" : ""); ?>" data-value="2">Compacta</div>
                                        <div class="item <?php echo ($usuario["vista"] == 3 ? "active" : ""); ?>" data-value="3">Ancha</div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label>Ordenación predeterminada</label>
                                <?php
                                //AQUI VER QUE VISTA TIENE ESE USUARIO
                                ?>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="orden" value="<?php echo $usuario["orden"]; ?>">
                                    <i class="dropdown icon"></i>
                                    <div class="text"><?php echo $ordenes[$usuario["orden"]]; ?></div>
                                    <div class="menu">
                                        <div class="item <?php echo ($usuario["orden"] == 1 ? "active" : ""); ?>" data-value="1">Por novedad</div>
                                        <div class="item <?php echo ($usuario["orden"] == 2 ? "active" : ""); ?>" data-value="2">Por reacciones</div>
                                        <div class="item <?php echo ($usuario["orden"] == 3 ? "active" : ""); ?>" data-value="3">Alfabético</div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <?php
                                //AQUI VER QUE VISTA TIENE ESE USUARIO
                                ?>
                                <label>Categoria Inicial</label>
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
                            <div class="three inline fields">
                                <div class="field">
                                    <div class="ui toggle checkbox <?php echo $usuario["nocturno"] ? "checked" : ""; ?>">
                                        <input type="checkbox" tabindex="0" class="hidden" <?php echo $usuario["nocturno"] ? "checked" : ""; ?>>
                                        <label>Modo nocturno</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui toggle checkbox <?php echo $usuario["lenguaje"] ? "checked" : ""; ?>">
                                        <input type="checkbox" tabindex="0" class="hidden" <?php echo $usuario["lenguaje"] ? "checked" : ""; ?>>
                                        <label>Ocultar lenguaje malsonante</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui toggle checkbox <?php echo $usuario["newtab"] ? "checked" : ""; ?>">
                                        <input type="checkbox" tabindex="0" class="hidden" <?php echo $usuario["newtab"] ? "checked" : ""; ?>>
                                        <label>Abrir posts en nueva pestaña</label>
                                    </div>
                                </div>
                            </div>
                            <div class="ui hidden divider"></div>
                            <button class="ui right floated button positive" type="submit"><i class="save icon"></i>Actualizar Perfil</button>
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