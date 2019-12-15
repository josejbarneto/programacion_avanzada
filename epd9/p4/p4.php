<!DOCTYPE html>
<html>
    <head>
        <title>Captcha Javascript</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            #captcha{
                border: 1px solid black;
                font-size: 40px;
                width: 50%;
            }

            #codigo{
                min-width: 50%;
                font-size: 20px;
            }

            #error{
                color: red;
            }
        </style>
    </head>
    <body>
        <script>
            var ultimoNumeroAleatorio = false;
            function generarNumeroAleatorio() {
                var cifras = 4;
                var max = Math.pow(10, cifras + 1);
                var min = max / 10;
                var number = Math.floor(Math.random() * (max - min + 1)) + min;

                ultimoNumeroAleatorio = ("" + number).substring(1);
                document.getElementById("captcha").innerText = ultimoNumeroAleatorio;
            }

            function ocultarNumero() {
                var frase = "Pase el raton por aquí para ver el codigo";
                document.getElementById("captcha").innerText = frase;
            }

            function submitForm() {
                document.getElementById("error").innerText = "";
                var codigo = document.forms["formulario"]["codigo"].value;
                if (codigo !== ultimoNumeroAleatorio) {
                    document.getElementById("error").innerText = "El código introducido no es correcto";
                    return false;
                }
            }

            function removeError() {
                document.getElementById("error").innerText = "";
            }
            
            function reload(){
                window.location.href = window.location.href;
            }
        </script>
        <?php
        if (isset($_POST["form"])) {
            ?>
            <div>Formulario enviado correctamente.</div>
            <button onclick="reload()">Reiniciar</button>
            <?php
        } else {
            ?>
            <div id="captcha" onmouseover="generarNumeroAleatorio()" onmouseout="ocultarNumero()">Pase el raton por aquí para ver el codigo</div>
            <br>
            <br>
            <form onsubmit="return submitForm()" method="POST" name="formulario">
                <input id="codigo" type="text" onchange="removeError()" name="codigo" placeholder="Introduzca el último código proporcionado"/><br>
                <span id="error"></span><br>
                <input id="boton" type="submit" value="Enviar" name="form"/>
            </form>
            <?php
        }
        ?>
    </body>
</html>
