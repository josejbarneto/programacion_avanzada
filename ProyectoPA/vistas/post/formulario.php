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
include_once("../../entidades/galeria.php");

session_start();
if (empty($_SESSION['usuario'])) {
    header('location: ../../vistas/base/principal.php');
}

//ver si estamos editando o creando un post. Si se edita se pasa el id del post por get
$idPost = filter_input(INPUT_GET, 'id_post', FILTER_SANITIZE_NUMBER_INT);
if(isset($idPost)){
    $post = getPost($idPost);
    if($post['idUsuario'] != $_SESSION['usuario']['id'] && $_SESSION['usuario']['admin']!=1){  //Comprobar que corresponde el post al usuario
        header('location: ../../vistas/base/principal.php');
    }
}

$categorias = getCategorias();

if (isset($_POST['submit'])) {
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
    $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
    $url=filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);

    if (empty($titulo) || empty($categoria) || empty($texto)) {
        $errores[] = "Rellene los campos necesarios";
    } else {
        
        
        /*Añadimos a la galería la imagen en el caso de que exista*/
        if($_FILES['archivo']['error']==0 && (!empty($url))){
            $errores[]="Por favor introduzca un archivo o una url, no ambos";
        }
        else{
            $id_post = crearPost($_SESSION['usuario']['id'], $categoria,$titulo, $texto);
            if($_FILES['archivo']['error']==0){
                $dir="../../uploads/".time().$_FILES['archivo']['name'];
                $tipo = pathinfo($dir, PATHINFO_EXTENSION);
                /*Guadamos la imagen*/
                
                move_uploaded_file($_FILES['archivo']['tmp_name'],$dir);
                
                /*Guardamos en la base de datos*/
                crearGaleria($_SESSION['usuario']['id'], $id_post, $dir, $tipo, 0);  //0 porque es fichero y no url
            }
            if(!empty($url)){
                /*Guardamos la url*/
                $tipo = pathinfo($url, PATHINFO_EXTENSION);
                
                crearGaleria($_SESSION['usuario']['id'], $id_post, $url, $tipo, 1);  //1 porque es url
            }
            header('Location: ../../vistas/base/principal.php');
        }     
    }
}

//editar
if (isset($_POST['edit'])) {
    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT);
    $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
    $url=filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);
    
    if (empty($titulo) || empty($categoria) || empty($texto)) {
        $errores[] = "Rellene los campos necesarios";
    }
    /*Añadimos a la galería la imagen en el caso de que exista*/
        if($_FILES['archivo']['error']==0 && (!empty($url))){
            $errores[]="Por favor introduzca un archivo o una url, no ambos";
        }
        else{
            editarPost($idPost, $categoria, $titulo, $texto);
            if($_FILES['archivo']['error']==0){
                $dir="../../uploads/".time().$_FILES['archivo']['name'];
                $tipo = pathinfo($dir, PATHINFO_EXTENSION);
                /*Guadamos la imagen*/
                
                move_uploaded_file($_FILES['archivo']['tmp_name'],$dir);
                
                /*Guardamos en la base de datos*/
                editarGaleria($idPost, $dir, $tipo, 0);  //0 porque es fichero y no url
            }
            if(!empty($url)){
                /*Guardamos la url*/
                $tipo = pathinfo($url, PATHINFO_EXTENSION);
                
                editarGaleria($idPost, $url, $tipo, 1);  //1 porque es url
            }
            header('Location: ../../vistas/base/principal.php');
        }
    
    
    
}

//borrar post
if (isset($_POST['eliminar'])) {
    borrarPost($idPost);
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
                    <div class="ui segment">
                        <h2 class="ui block header">
                            <i class="pen alternate icon"></i>
                            <div class="content">
                                <?php echo (!isset($post) ? "Nuevo Post" : "Editar Post");?>
                            </div>
                        </h2>
                        <form class="ui form" action="" method="post" enctype="multipart/form-data">
                            <?php
                            //AQUI DENTRO DEL HTML LO QUE HACEMOS SERA RECORRER LAS VARIABLES QUE RECOJAMOS ARRIBA
                            if (!empty($errores)) {
                                echo '<div class="ui negative message">';
                                echo '<div class="header">Errores en el formulario</div><ul class="list">';

                                foreach ($errores as $e) {
                                    echo "<li'>$e</li>";
                                }
                                echo '</ul></div>';
                            }
                            ?>
                            <div class="field">
                                <label>Titulo</label>
                                <input type="text" name="titulo" placeholder="Titulo del post" autocomplete="off" value="<?php echo (isset($post) ? $post['titulo'] : "");?>">
                            </div>
                            <div class="field">
                                <label>Categoria</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="categoria" value='<?php echo (isset($post) ? $post['idCategoria'] : "");?>'>
                                    <i class="dropdown icon"></i>
                                    <div class="<?php echo (!isset($post) ? 'default' : "");?> text"><?php echo (isset($post) ? $post['categoria'] : "Selecciona una categoria");?> </div>
                                    <div class="menu">
                                        <?php
                                        //AQUI HAY QUE IR PINTANDO SEGUN LAS CATEGORIAS QUE EXISTAN
                                        foreach ($categorias as $categoria) {
                                            echo (isset($post) && $categoria['id'] == $post['idCategoria']) ? "<div class='item active' data-value='{$categoria['id']}'>{$categoria['nombre']}</div>" : "<div class='item' data-value='{$categoria['id']}'>{$categoria['nombre']}</div>" ;
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
                                    <input type="file" accept="image/*" id="textupload" class="ui file input" name="archivo">
                                </div>
                                <div class="field">
                                    <label>Introduzca URL del vídeo o imagen</label>
                                    <input type="text" name="url" placeholder="Enlace al video o imagen" autocomplete="off">
                                </div>
                            </div>
                            <div class="field">
                                <label>Texto</label>
                                <textarea name="texto"><?php echo (isset($post) ? $post['texto'] : "");?></textarea>
                            </div>
                            <button class="ui button" type="reset">Resetear</button>
                            <!-- SI NO ES UN NUEVO POST, ESTAMOS VIENDO UNO HECHO ANTES, PODER BORRARLO AQUI -->
                            <?php if(isset($post)){?>
                            <button name='eliminar' class="ui button negative" type="submit" >Eliminar</button>
                            <?php } ?>
                            
                            
                            <button name="<?php echo isset($post) ? 'edit' : 'submit'?>" class="ui right floated positive button" type="submit">Guardar</button>
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