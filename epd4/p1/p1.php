<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
	<style>
		#texto{
			width: 500px;
			height: 300px;
		}
	</style>

    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
		
        <form action="paginas/form_1.php" method="post">
		Introduce el texto aqu&iacute; </br>
		<textarea id="texto" name="texto_analiza"></textarea>
			</br> </br> Buscar una palabra: </br>
			<input type="text" name="palabra_busca">
			<input type="submit" name="busca" value="palabra"/>
			
			</br> </br> Conteo: </br>
			<input type="radio" name="form_2" value="1">Número de palabras
			<input type="radio" name="form_2" value="2" checked>Número de frases
			<input type="radio" name="form_2" value="3">Número de caracteres
			<input type="submit" name="busca" value="conteo"/>
			
		</form>
    </body>
</html>