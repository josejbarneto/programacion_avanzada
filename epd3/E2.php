<style>

	.prim{
		color:red;
	}


</style>



<?php

	function lista($numero, $primo){
		if(strcmp($primo,"PRIMO")==0){
			for($i=1; $i<$numero; $i++){
				if(esprimo($i)==1){
					echo('<span class="prim">'.$i.' </span>');
				}
				else{
					echo($i.' ');
				}
			}
		}elseif(strcmp($primo,"NOPRIMO")==0){
			for($i=1; $i<$numero; $i++){
				if(!esprimo($i)==1){
					echo('<span class="prim">'.$i.' </span>');
				}
				else{
					echo($i.' ');
				}
			}
		}
		else{
			echo("No es posible encontrar la cadena: ".$primo."</br> Prueba con: PRIMO / NOPRIMO");
		}
	}
	
	
	function esprimo($numero){
		if($numero<=1){
			return 0;
		}
		for($i=2; $i<$numero; $i++){
			if($numero%$i == 0){
				return 0;
			}
		}
		return 1;
	}
	
	echo("(10,PRIMO)</br>");
	lista(10, "PRIMO");
	
	echo("</br></br>(10,NOPRIMo)</br>");
	lista(10, "NOPRIMo");
	
	echo("</br></br>(20,PRIMO)</br>");
	lista(20, "PRIMO");
	
	echo("</br></br>(20,NOPRIMO)</br>");
	lista(20, "NOPRIMO");
	
	echo("</br></br>(30,PRIMO)</br>");
	lista(30, "PRIMO");
	
	echo("</br></br>(30,NOPRIMO)</br>");
	lista(30, "NOPRIMO");

?>

