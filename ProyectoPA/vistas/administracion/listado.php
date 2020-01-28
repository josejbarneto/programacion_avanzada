<?php
/*
 * SOLO ACCESO SI ES ADMINISTRADOR
 * 
 */

include_once '../../entidades/post.php';
$categoriaId = filter_input(INPUT_GET, 'categoria_id', FILTER_SANITIZE_NUMBER_INT);
if (isset($categoriaId)) {
    $posts = listarPostsPorCategoria($categoriaId);
}
/*
 * HAY QUE COGER TODOS LOS USUARIOS, TODAS LAS CATEGORIAS, TODOS LOS POST, TODOS LOS COMENTARIOS y TODAS LAS IMAGENES
 * 
 * $post = todos()
 * $categorias = todos()
 * $usuarios = todos()
 * $comentarios = todos()
 * $galerias = todos()
 * 
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kaheddit</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="../../recursos/css/base.css">
        <link rel="stylesheet" type="text/css" href="../../recursos/css/header2.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.7.8/semantic.min.js"></script>
        <script src="../../recursos/js/base.js"></script>
    </head>
    <body>
        <?php
//AÑADIMOS EL HEADER DE LA PAGINA. 
//Antes de incluirlo si añadimos variables al header las tocamos aqui
        include_once '../../vistas/base/cabecera.php';
        include_once '../../entidades/usuario.php';
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui top attached tabular menu menu-tab">
                        <div class="active item" data-tab="posts">One</div>
                        <div class="item" data-tab="usuarios">Two</div>
                        <div class="item" data-tab="categorias">Three</div>
                    </div>
                    <div class="ui bottom attached tab active segment" data-tab="posts">
                        <table class="ui celled striped table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Texto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if ($posts != false) {
                                    foreach ($posts as $post) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="../../vistas/post/post.php?id=<?php echo $post["id"]; ?>"></a>
                                            </td>
                                            <td>
                                                <?php echo $post["titulo"]; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $usuario = getUsuario($post["idUsuario"]);
                                                echo "{$usuario["usuario"]}";
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo substr($post["texto"], 0, 10); ?>    
                                            </td>
                                            <td>
                                                <a><i class="edit icon"></i></a>
                                                <a><i class="delete icon"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="ui bottom attached tab segment" data-tab="usuario">
                        <table class="ui celled striped table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if ($usuarios != false) {
                                    foreach ($usuarios as $usuario) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="../../vistas/usuario/usuario.php?id=<?php echo $usuario["id"]; ?>"></a>
                                            </td>
                                            <td>
                                                <?php echo $usuario["usuario"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuario["nombre"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuario["correo"]; ?>
                                            </td>
                                            <td>
                                                <a><i class="edit icon"></i></a>
                                                <a><i class="delete icon"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="ui bottom attached tab segment" data-tab="categorias">
                        <table class="ui celled striped table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if ($categorias != false) {
                                    foreach ($categorias as $categoria) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="../../vistas/post/listado.php?categoria=<?php echo $categoria["id"]; ?>"></a>
                                            </td>
                                            <td>
                                                <?php echo $post["nombre"]; ?>
                                            </td>
                                            <td>
                                                <a><i class="edit icon"></i></a>
                                                <a><i class="delete icon"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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
