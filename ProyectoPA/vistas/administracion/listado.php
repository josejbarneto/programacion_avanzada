<?php
/*
 * SOLO ACCESO SI ES ADMINISTRADOR
 * 
 */

include_once '../../entidades/post.php';
include_once '../../entidades/comentario.php';
include_once '../../entidades/categoria.php';
include_once '../../entidades/usuario.php';

session_start();
$usuarios = getAllUsuarios();
$posts = getAllPost();
$categorias = getCategorias();
$comentarios = getAllComenarios();

//eliminar post
if (isset($_POST['eliminarPost'])) {
    $idPost = filter_input(INPUT_POST, 'id_post', FILTER_SANITIZE_NUMBER_INT);
    borrarPost($idPost);
    header('location: ../../vistas/administracion/listado.php');
}

//eliminar usuario
if (isset($_POST['usuario'])) {
    $idUsuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
    if ($idUsuario == $_SESSION['usuario'['id']]) {
        $errores[] = 'No puedes borrarte a ti mismo';
    } else {
        borrarUsuario($idUsuario);
        header('location: ../../vistas/administracion/listado.php');
    }
}

//eliminar categoria
if (isset($_POST['eliminarCategoria'])) {
    $idCategoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_NUMBER_INT);
    borrarCategoria($idCategoria);
    header('location: ../../vistas/administracion/listado.php');
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
        include_once '../../entidades/usuario.php';
        ?>
        <article class="ui very wide container" id="main">
            <div class="ui hidden divider"></div>
            <?php
            if (!empty($errores)) {
                foreach ($errores as $e) {
                    echo "<span style='color:red;'>$e</span>";
                }
            }
            ?>
            <section class="ui grid">
                <div class="ui twelve wide column">
                    <div class="ui pointing secondary menu menu-tab">
                        <div class="active item" data-tab="posts">Posts</div>
                        <div class="item" data-tab="usuarios">Usuarios</div>
                        <div class="item" data-tab="categorias">Categorias</div>
                        <div class="item" data-tab="comentarios">Comentarios</div>
                    </div>
                    <div class="ui tab active segment" data-tab="posts">
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
                                                <a href="../../vistas/post/post.php?id=<?php echo $post['id']; ?>"><?php echo $post['id']; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $post["titulo"]; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $usuario = getUsuarioById($post["idUsuario"]);
                                                echo "{$usuario["usuario"]}";
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo substr($post["texto"], 0, 10); ?>    
                                            </td>
                                            <td>
                                                <form method="post">
                                                    <a class="ui basic blue circular icon button" href="../../vistas/post/formulario.php?id_post=<?php echo $post['id']; ?>"><i class="edit icon"></i></a>
                                                    <button class='ui basic red circular icon button' type="submit" name='eliminarPost'><i class="delete icon"></i></button>
                                                    <input type='hidden' name='id_post' value='<?php echo $post['id']; ?>'/>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="ui bottom attached tab segment" data-tab="usuarios">
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
                                                <a href="../../vistas/usuario/usuario.php?id=<?php echo $usuario["id"]; ?>"><?php echo $usuario["id"]; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $usuario["usuario"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuario["nombre"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $usuario["email"]; ?>
                                            </td>
                                            <td>
                                                <form method="post">
                                                    <a class="ui blue basic circular icon button" href="../../vistas/usuario/perfil.php?id_usuario=<?php echo $usuario["id"]; ?>"><i class="edit icon"></i></a>
                                                    <button class='ui red basic circular icon button' type="submit" name='eliminarUsuario'><i class="delete icon"></i></button>
                                                    <input type='hidden' name='id_usuario' value='<?php echo $usuario['id']; ?>'/>
                                                </form>
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
                        <a class="ui green right labeled icon button" href="../../vistas/categoria/formulario.php"><i class="plus icon"></i>Nueva Kategoría</a>
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
                                                <a href="../../vistas/post/listado.php?categoria=<?php echo $categoria["id"]; ?>"><?php echo $categoria["id"]; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $categoria["nombre"]; ?>
                                            </td>
                                            <td>
                                                <form method="post">
                                                    <a class="ui blue basic circular icon button" href="../../vistas/categoria/formulario.php?categoria=<?php echo $categoria["id"]; ?>"><i class="edit icon"></i></a>
                                                    <button class='ui basic circular red icon button' type="submit" name='eliminarCategoria'><i class="delete icon"></i></button>
                                                    <input type='hidden' name='id_categoria' value='<?php echo $categoria["id"]; ?>'/>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="ui bottom attached tab segment" data-tab="comentarios">
                        <table class="ui celled striped fixed table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Autor</th>
                                    <th>Texto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                if ($comentarios != false) {
                                    foreach ($comentarios as $comentario) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="../../vistas/post/post.php?id=<?php echo $comentario["idPost"]; ?>"><?php echo $comentario["idPost"]; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $comentario["nombreUsuario"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $comentario["texto"]; ?>
                                            </td>
                                            <td>
                                                <form method="post">
                                                    <?php /* No editamos comentarios  <a class="ui blue basic circular icon button" href="../../vistas/usuario/perfil.php?id_usuario=<?php echo $usuario["id"]; ?>"><i class="edit icon"></i></a> */ ?>
                                                    <button class='ui red basic circular icon button' type="submit" name='eliminarComentario'><i class="delete icon"></i></button>
                                                    <input type='hidden' name='id_comentario' value='<?php echo $comentario['id']; ?>'/>
                                                </form>
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
