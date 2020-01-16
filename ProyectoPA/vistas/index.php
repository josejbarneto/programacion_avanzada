<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .log {
                display: none;
                background-color: black;
                color: black;
                margin: auto;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                font-family: 'Google Sans',arial,sans-serif;
            }
            
            .formulario{
                background-color: #fefefe;
                margin: 5% auto 15% auto;
                width: 80%;
                padding: 20px;
                border-radius: 4px;
            }
            
            .textbox{
                width:100%;
                border-radius: 4px;
                padding: 10px 15px;
                margin-top: 10px;
                margin-bottom: 10px;
                margin-left: 5px;
                margin-right: 5px;
                border: 1px solid #666666;
                box-sizing: border-box;
            }
            
            input[type=submit]{
                width:100%;
                border-radius: 4px;
                padding: 15px;
                margin-left: 5px;
                margin-right: 5px;
                margin-top: 10px;
                margin-bottom: 10px;
                background-color: #0066cc;
                color: #fefefe;
            }
            
            .close {
                position: absolute;
                right: 30px;
                top: 10px;
                font-size: 40px;
                color: #f1f1f1;
            }
            
            .close:hover, .close:focus {
                color: brown;
                cursor: pointer;
            }
        </style>
    </head>
    <body>

        <!--Formulario log in-->
        
        <button onclick='document.getElementById("login").style.display = "block";'>LOG IN</button>
        <div class="log" id="login">
        <span onclick="document.getElementById('login').style.display='none'" class="close" title="Close">&times;</span>
        <form action="login.php" method="post" class="formulario" onsubmit="return valida2()">
            Username:<br/>
            <input type="text" name='lusuario' class="textbox" placeholder="example: tuusuario1">
            <br/>Password:<br/>
            <input type="text"name='lpass' class="textbox">
            <br/>
            <input type="submit" value="LOG IN">
            <br/>
        </form>
        </div>
        
        <!--Formulario sign up-->
        <button onclick='document.getElementById("signup").style.display = "block";'>SIGN UP</button>
        <div class="log" id="signup">
        <span onclick="document.getElementById('signup').style.display='none'" class="close" title="Close">&times;</span>
        <form action="signup.php" method="post" class="formulario" onsubmit="return valida()">
            Email: <br/>
            <input type="email" name="correo" class="textbox" placeholder="example: tucorreo@gmail.com" required>
            <br/>
            Username:<br/>
            <input type="text" name="usuario" class="textbox" placeholder="example: tuusuario1" id="usuario" required>
            <br/>Password:<br/>
            <input type="text" name="contrasena" class="textbox" id="pass" required>
            <br/>
            Repeat password:<br/>
            <input type="text" class="textbox" id="pass2" required>
            <br/>
            <input type="submit" value="SIGN UP">
            <br/>
        </form>
        </div>
        
        
        
        <script type="text/javascript">
            
            //Valida el singup
            
            function valida(){
                var salida = '';
                // Comprobamos el nombre (Mínimo 2 palabras)
                var expr = /^[a-zA-Z0-9_-]{5,16}$/;
                if(!expr.test(document.getElementById('usuario').value)){
                    salida += 'El nombre de usuario debe ser de caracteres o números y debe ser de una longitud entre 5 y 16\n';
                }
                expr = /^[a-zA-Z0-9_-]{7,20}$/;
                if(!expr.test(document.getElementById('pass').value)){
                    salida += 'La contraseña debe ser de caracteres o números no podrá ser menor de 7 caracteres y deberá ser menor de 20\n';
                }
                if(document.getElementById('pass').value != document.getElementById('pass2').value){
                    salida+= 'La contraseña debe coincidir';
                }
                if(salida!=''){
                    alert(salida);
                    return false;
                }else{
                    return true;
                }
            }
            
            //valida el login
            
            function valida2(){
                var salida = '';
                // Comprobamos el nombre (Mínimo 2 palabras)
                var expr = /^[a-zA-Z0-9_-]{5,16}$/;
                if(!expr.test(document.getElementById('lusuario').value)){
                    salida += 'El nombre de usuario debe ser de caracteres o números y debe ser de una longitud entre 5 y 16\n';
                }
                expr = /^[a-zA-Z0-9_-]{7,20}$/;
                if(!expr.test(document.getElementById('lpass').value)){
                    salida += 'La contraseña debe ser de caracteres o números no podrá ser menor de 7 caracteres y deberá ser menor de 20\n';
                }
                
                if(salida!=''){
                    alert(salida);
                    return false;
                }else{
                    return true;
                }
            }
        </script>
        
        
    </body>
</html>
