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
include_once("../../entidades/categoria.php");
include_once("../../entidades/usuario.php");
include_once("../../entidades/preferencias.php");

session_start();

if (isset($_SESSION['usuario'])) {
    $ordenes = ["Por novedad", "Por reacciones", "Alfabético"];
    $usuario = $_SESSION['usuario'];
    $preferencias = $_SESSION['preferencias'];
    $categorias = getCategorias();

    if (isset($_POST['actualizar'])) {
        $nombre = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
        $orden = filter_input(INPUT_POST, 'orden', FILTER_SANITIZE_NUMBER_INT);
        $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
        $nocturno = filter_input(INPUT_POST, 'nocturno', FILTER_SANITIZE_);
        $lenguaje = filter_input(INPUT_POST, 'lenguaje', FILTER_SANITIZE_NUMBER_INT);
        $newTab = filter_input(INPUT_POST, 'newTab', FILTER_SANITIZE_NUMBER_INT);

        if (!preg_match("/^[a-zA-Z0-9_-]{5,16}$/", $nombre)) {
            $errores[] = "Error en el nombre";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "Error en el correo";
        }

        if (empty($pass)) {
            $pass = $_SESSION['usuario']['contrasena'];
        } else if (!preg_match("/^[a-zA-Z0-9_-]{7,20}$/", $pass)) {
            $errores[] = "Error en la contraseña";
        } else {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
        }

        if (!filter_var($orden, FILTER_VALIDATE_INT) || $orden < 1 || $orden > 3) {
            $errores[] = "Error en tipo de ordenación";
        }

        if (!filter_var($categoria, FILTER_VALIDATE_INT)) {
            $errores[] = "Error en categoría";
        }

        if (!filter_var($_POST['nocturno'], FILTER_VALIDATE_BOOLEAN)) {
            $errores[] = "Error en nocturno";
        }

        if (!filter_var($lenguaje, FILTER_VALIDATE_INT)) {
            $errores[] = "Error en lenguaje";
        }

        if (!filter_var($newTab, FILTER_VALIDATE_INT)) {
            $errores[] = "Error en newTab";
        }

        editarUsuario($_SESSION['usuario']['id'], $nombre, $email, $pass);
        editarPreferencia($_SESSION['usuario']['id'], $nocturno, $categoria, $lenguaje, $newTab, $orden);

        $_SESSION['usuario'] = getUsuario($usuario['usuario']);
        $_SESSION['preferencias'] = getPreferenciasDeUsuario($_SESSION['usuario']['id']);

        header('location: ../../vistas/base/principal.php');
    }
} else {
    header('location: ../../vistas/base/principal.php');
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
                                    <input type="password" name="pass" autocomplete="off" value="">
                                </div>
                            </div>
                            <h4 class="ui dividing header">Preferencias</h4>
                            <div class="field">
                                <label>Ordenación predeterminada</label>
                                <?php
                                //AQUI VER QUE VISTA TIENE ESE USUARIO
                                ?>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="orden" value="<?php echo $preferencias["orden"]; ?>">
                                    <i class="dropdown icon"></i>
                                    <div class="text"><?php echo $ordenes[$preferencias["orden"] - 1]; ?></div>
                                    <div class="menu">
                                        <div class="item <?php echo ($preferencias["orden"] == 1 ? "active" : ""); ?>" data-value="1">Por novedad</div>
                                        <div class="item <?php echo ($preferencias["orden"] == 2 ? "active" : ""); ?>" data-value="2">Por reacciones</div>
                                        <div class="item <?php echo ($preferencias["orden"] == 3 ? "active" : ""); ?>" data-value="3">Alfabético</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label>Categoria Inicial</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="categoria" value='<?php echo $preferencias['id_categoria_inicial']; ?>'>
                                    <i class="dropdown icon"></i>
                                    <div class="text"><?php $preferencias['nombre_categoria_inicial']; ?> </div>
                                    <div class="menu">
                                        <?php
                                        //AQUI HAY QUE IR PINTANDO SEGUN LAS CATEGORIAS QUE EXISTAN
                                        foreach ($categorias as $categoria) {
                                            echo ($categoria['id'] == $preferencias['id_categoria_inicial']) ? "<div class='item active' data-value='{$categoria['id']}'>{$categoria['nombre']}</div>" : "<div class='item' data-value='{$categoria['id']}'>{$categoria['nombre']}</div>";
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
                            <div class="three inline fields">
                                <div class="field">
                                    <div class="ui toggle checkbox <?php echo $usuario["nocturno"] ? "checked" : ""; ?>">
                                        <input id='nocturno' name='nocturno' type="checkbox" tabindex="0" class="hidden" <?php echo $preferencias["modo_nocturno"] ? "checked" : ""; ?>>
                                        <label>Modo nocturno</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui toggle checkbox <?php echo $usuario["lenguaje"] ? "checked" : ""; ?>">
                                        <input name='lenguaje' type="checkbox" tabindex="0" class="hidden" <?php echo $preferencias["lenguaje_obsceno"] ? "checked" : ""; ?>>
                                        <label>Ocultar lenguaje malsonante</label>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="ui toggle checkbox <?php echo $usuario["newtab"] ? "checked" : ""; ?>">
                                        <input tname='newTab' type="checkbox" tabindex="0" class="hidden" <?php echo $preferencias["open_post_new_tab"] ? "checked" : ""; ?>>
                                        <label>Abrir posts en nueva pestaña</label>
                                    </div>
                                </div>
                            </div>
                            <div class="ui hidden divider"></div>
                            <button name='actualizar' class="ui right floated button positive" type="submit"><i class="save icon"></i>Actualizar Perfil</button>
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