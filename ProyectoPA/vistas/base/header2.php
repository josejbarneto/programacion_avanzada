<?php ?>
<nav class="ui fixed menu">
    <a href="../../vistas/base/principal.php" class="item">
        <img src="../../recursos/img/logo.png">
    </a>
    <a href="../../vistas/categoria/listado.php" class="item"><i class="tags icon"></i>Kategorias</a>
    <a href="../../vistas/galeria/listado.php" class="item"><i class="photo video icon"></i>Galeria</a>
    <div class="right menu">
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
        <form action="login.php" method="post" class="formulario" onsubmit="return valida2()">

            <!--Errores-->
            <?php
            if (isset($_SESSION['intentoLogin'])) {
                foreach ($_SESSION['errores'] as $e) {
                    echo "<span style='color:red;'>$e</span><br/>";
                }
                echo '<br/>';
            }
            ?>

            Username:<br/>
            <input type="text" name='lusuario' class="textbox" placeholder="example: tuusuario1">
            <br/>Password:<br/>
            <input type="password"name='lpass' class="textbox">
            <br/>
            <input type="submit" value="LOG IN">
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
    <form action="signup.php" method="post" class="formulario" onsubmit="return valida()">

        <!--Errores-->
        <?php
        if (isset($_SESSION['intentoSignup'])) {
            foreach ($_SESSION['errores'] as $e) {
                echo "<span style='color:red;'>$e</span><br/>";
            }
            echo '<br/>';
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
</div>
</div>

<script src="../../recursos/js/header2.js"></script>
</nav>

