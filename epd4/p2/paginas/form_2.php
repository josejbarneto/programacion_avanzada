<style>
		.adjetivo{
			color: blue;
		}
		.pronombre{
			color: green;
		}
</style>

<style>
	table,  td{
		border: solid black 1px;
	}
</style>
		<span>$adjetivos=[guapo, feo, alto, bajo, grande, pequeño];<br/>
		$pronombre=[yo,tú,él,ella,nosotros,nosotras,vosotros,vosotras,ellos,ellas];");
		</span>
		<br/><br/>

<?php



$texto=$_POST['texto_analiza'];
$tabla='<table>'.'<tr>'.'<td colspan="2">'."Pronombres".'</td>'.'</tr>';

	if(isset($texto)){
		$adjetivos=["guapo", "feo", "alto", "bajo", "grande", "pequeño"];
		$pronombre=["yo","tú","él","ella","nosotros","nosotras","vosotros","vosotras","ellos","ellas"];
		
		for($i=0;$i<sizeof($pronombre);$i++){
			
			$texto=str_ireplace($pronombre[$i],'<span class="pronombre">'.$pronombre[$i].'</span>'.'(pronombre)' , $texto);
			if(substr_count($texto, $pronombre[$i])>0){
				$tabla=$tabla.'<tr>'.'<td>'.$pronombre[$i].'</td>'.'<td>'.substr_count($texto, $pronombre[$i]).'</tr>';
			}
		}
		
		$tabla=$tabla.'<tr>'.'<td colspan="2">'."Adjetivos".'</td>'.'</tr>';
		
		for($i=0;$i<sizeof($adjetivos);$i++){
			
			$texto=str_ireplace($adjetivos[$i],'<span class="adjetivo">'.$adjetivos[$i].'</span>'.'(adjetivo)' , $texto);
			if(substr_count($texto, $adjetivos[$i])>0){
				$tabla=$tabla.'<tr>'.'<td>'.$adjetivos[$i].'</td>'.'<td>'.substr_count($texto, $adjetivos[$i]).'</tr>';
			}
		}
		
		echo($_POST['texto_analiza']);
		echo('</br>'.'</br>'."Texto corregido: ".'</br>');
		echo($texto);
		
		echo('</br>'.'</br>'."Tabla".'</br>'.$tabla.'</table>');
		
	}

else
{
  echo("Por favor introduce algún texto");
}
?>