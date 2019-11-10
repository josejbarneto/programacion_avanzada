<!DOCTYPE html>
<html>


    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
		
        <form method="post" action="Ej1.php">
		Introduce el texto aqu&iacute; </br>
		<textarea id="texto" name="texto_analiza"></textarea>
			</br> </br> Buscar ips y puertos: </br>
			
			<input type="submit" name="busca" value="busqueda"/>		
		</form>
    </body>



<?php
// Variable to check

  if(isset($_POST['texto_analiza'])){
	  $ip=$_POST['texto_analiza'];
  $contip=0;
preg_match_all('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $ip, $ip_match);	//Filtrado de ips
  echo("<br/>"."Direcciones ip: "."<br/><br/>");
	foreach ($ip_match as $value) {
      foreach ($value as $val){
          if (filter_var($val, FILTER_VALIDATE_IP)) {		//Chequeo que son correctas las ip
              echo($val."<br/>");
            	$contip++;									//Contador de ips
          }
          else {
              echo("$val is not a valid IP address");
          }
      }
	}
	echo("Total: ".$contip."<br/><br/>");
  
  $contp=0;
preg_match_all('/\d{4}/',$ip, $ip_match);	//Filtrado de puertos
   echo("<br/>"."Puertos: "."<br/><br/>");
  	foreach ($ip_match as $value) {
      foreach ($value as $val){
			if($val<=1500 && $val>=1000){	//Comprobación de puertos
              echo($val."<br/>");
              $contp++;						//Contador de puertos
            }
      }
	}
	echo("Total: ".$contp."<br/><br/>");
  
  if($contip<2 || $contp<2){
  	echo("Por favor introduce al menos 2 direcciones ip y 2 puertos");
  }
  else{
  	echo("La entrada del texto es correcta");
  }
  
  }
  
  
?>

</html>