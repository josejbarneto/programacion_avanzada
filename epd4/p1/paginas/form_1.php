<?php
$texto=$_POST['texto_analiza'];

	if($_POST['busca']=="palabra"){
		
	$palabra=$_POST['palabra_busca'];
	
	if(isset($palabra)){
		$cambia='<mark>'.$palabra.'</mark>';

			$texto=str_replace($palabra, $cambia, $texto);

		echo($texto);
	}
}
else if ($_POST['busca']=="conteo")
{
  if($_POST['form_2']==1){
	  echo(str_word_count($texto));
	  
  }elseif($_POST['form_2']==2){
	  
	  $empieza=false;
	  $cont=0;
	  for($i=0; $i<strlen($texto);$i++){
		  if($texto[$i]!="."){
			  $empieza=true;
		  }
		  elseif($empieza==true){
			  $cont++;
		  }
	  }
	  echo($cont);
  }elseif($_POST['form_2']==3){
	  echo(strlen($texto));
  }else{
	  
  }
}
else
{
  // uhm, print form?
}
?>