<?php ?>
<nav class="ui fixed menu">
    <a href="../../vistas/base/principal.php" class="item">
        <img src="../../recursos/img/logo.png">
    </a>
    <a href="../../vistas/categoria/listado.php" class="item"><i class="tags icon"></i>Kategorias</a>
    <a href="../../vistas/galeria/listado.php" class="item"><i class="photo video icon"></i>Galeria</a>
    <div class="right menu">
        <!-- SI ESTA LOGADO Y ES ADMIN -->
<?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['admin'] == 1) { ?>
            <a href='../../vistas/administracion/listado.php' class="item"><i class="tools icon"></i>Administrar</a>
        <?php } ?>
        <!-- SI ESTA LOGADO Y ES USUARIO -->
        <?php if (isset($_SESSION['usuario'])) { ?>
            <a class="item" href="../../vistas/post/formulario.php"><i class="plus circle icon"></i>Nuevo Post</a>
            <a class="item" href="../../vistas/usuario/perfil.php"><i class="user circle icon"></i>Ver perfil</a>
            <a class="ui item" href="../../vistas/base/logout.php"><i class="sign in alternate icon"></i>Logout</a>
<?php } else { ?>

            <!--Formulario log in-->

            <button class="item" onclick='document.getElementById("login").style.display = "block";'><i class="sign in alternate icon"></i>Log-in</button>
    <?php
    if (isset($_SESSION['intentoLogin'])) {
        echo "<div class='log' id='login' style='display:block;'>";
    } else {
        echo "<div class='log' id='login'>";
    }
    ?>
            <span onclick="document.getElementById('login').style.display = 'none'" class="close" title="Close">&times;</span>
            <form action="../../vistas/base/login.php" method="post" class="formulario" onsubmit="return valida2()">

                <!--Errores-->
    <?php
    if (isset($_SESSION['intentoLogin'])) {

        echo '<div class="ui negative message">';
        echo '<div class="header">Errores en el formulario</div><ul class="list">';

        foreach ($_SESSION['errores'] as $e) {
            echo "<li'>$e</li>";
        }
        echo '</ul></div>';
    }
    ?>

                Username:<br/>
                <input type="text" name='lusuario' id="lusuario" class="textbox" placeholder="example: tuusuario1">
                <br/>Password:<br/>
                <input type="password"name='lpass' id="lpass" class="textbox">
                <br/>
                <input type="submit" name='login' value="LOG IN">
                <br/>
            </form>
        </div>

        <!--Formulario sign up-->
        <button class="item" onclick='document.getElementById("signup").style.display = "block";'><i class="sign in alternate icon"></i>Sign-up</button>
    <?php
    if (isset($_SESSION['intentoSignup'])) {
        echo "<div class='log' id='signup' style='display:block;'>";
    } else {
        echo "<div class='log' id='signup'>";
    }
    ?>
        <span onclick="document.getElementById('signup').style.display = 'none'" class="close" title="Close">&times;</span>
        <form action="../../vistas/base/signup.php" method="post" class="formulario" onsubmit="return valida()">

            <!--Errores-->
    <?php
    if (isset($_SESSION['intentoSignup'])) {
        echo '<div class="ui negative message">';
        echo '<div class="header">Errores en el formulario</div><ul class="list">';

        foreach ($_SESSION['errores'] as $e) {
            echo "<li'>$e</li>";
        }
        echo '</ul></div>';
    }
    ?>
            Email: <br/>
            <input type="email" name="correo" class="textbox" placeholder="example: tucorreo@gmail.com" required>
            <br/>
            Name:<br/>
            <input type="text" name="nombre" class="textbox" id="nombre" required>
            Username:<br/>
            <input type="text" name="usuario" class="textbox" placeholder="example: tuusuario1" id="usuario" required>
            <br/>Password:<br/>
            <input type="password" name="contrasena" class="textbox" id="pass" required>
            <br/>
            Repeat password:<br/>
            <input type="password" class="textbox" id="pass2" required>
            <br/>
            <input type="submit" value="SIGN UP">
            <br/>
        </form>


        <script src="../../recursos/js/header.js"></script>
<?php } ?>
</div>
</nav>


