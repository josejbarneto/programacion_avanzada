<?php ?>
<button id="ir-arriba" class="ui icon blue big icon button"><i class="arrow up icon"></i></button>
<div class="ui hidden divider"></div>
<footer class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
        <div class="ui stackable inverted divided grid">
            <div class="eight wide column">
                <h4 class="ui inverted header">Herramientas utilizadas</h4>
                <div class="ui inverted link list">
                    <a href="https://fomantic-ui.com/" class="item">Fomantic UI</a>
                    <a href="https://jquery.com/" class="item">jQuery</a>
                    <a href="https://www.php.net/manual/en/index.php" class="item">PHP</a>
                    <a href="https://developer.mozilla.org/es/docs/Web/JavaScript" class="item">JavaScript</a>
                </div>
            </div>
            <div class="eight wide column">
                <h4 class="ui inverted header">Agradecimientos</h4>
                <div class="ui inverted link list">
                    <a href="https://www.w3schools.com/" class="item">w3schools</a>
                    <a href="https://www.upo.es/escuela-politecnica-superior/" class="item">Escuela Politécnica Superior</a>
                    <a href="https://netbeans.org/" class="item">NetBeans</a>
                    <a href="https://www.apachefriends.org/es/index.html" class="item">XAMPP</a>
                </div>
            </div>
        </div>
        <div class="ui inverted section divider"></div>
        <h4 class="ui inverted header">Copyright © 2020 Desarrollado por Grupo 14 Programaci&oacute;n Avanzada | Todos los derechos reservados.</h4>
        <p>Barneto del R&iacute;o, Jose Joaquín | Menacho de Gongora, Eugenio | Pumar Jimenez, Carlos</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.4/lib/darkmode-js.min.js"></script>
<script>
    var openNewTab = <?php echo (isset($_SESSION) && isset($_SESSION['preferencias'])) ? $_SESSION['preferencias']['open_post_new_tab'] : 0 ?>;
    var darkmode = <?php echo (isset($_SESSION) && isset($_SESSION['preferencias'])) ? $_SESSION['preferencias']['modo_nocturno'] : 0 ?>;
</script>
