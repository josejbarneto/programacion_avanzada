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
		
        <form action="paginas/form_2.php" method="post">
		Introduce el texto aqu&iacute; </br>
		<textarea id="texto" name="texto_analiza"></textarea>
			</br> </br> Buscar pronombres y adjetivos: </br>
			
			<input type="submit" name="busca" value="palabra"/>		
		</form>
    </body>
</html>