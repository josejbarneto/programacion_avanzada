<?php ?>
<nav class="ui fixed menu">
    <a href="../../vistas/base/principal.php" class="item">
        <img src="../../recursos/img/logo.png">
    </a>
    <a href="../../vistas/categoria/listado.php" class="item"><i class="tags icon"></i>Kategorias</a>
    <a href="../../vistas/galeria/listado.php" class="item"><i class="photo video icon"></i>Galeria</a>
    <div class="right menu">
        <!-- SI ESTA LOGADO Y ES ADMIN -->
        <a class="item"><i class="tools icon"></i>Administrar</a>
        <!-- SI ESTA LOGADO Y ES USUARIO -->
        <a class="item" href="../../vistas/post/formulario.php"><i class="plus circle icon"></i>Nuevo Post</a>
        <a class="item" href="../../vistas/usuario/perfil.php"><i class="user circle icon"></i>Ver perfil</a>
        <a class="ui item"><i class="sign in alternate icon"></i>Logout/Log-in</a>
    </div>
</nav>
