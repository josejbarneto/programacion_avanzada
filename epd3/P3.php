<?php

$array=[["Rota",0],["Trebujena",43.7],["Los palacios y Villafranca", 81.7],["Sevilla", 121.0],
["Lebrija",55.4],["Las Cabezas de San Juan",70.9],["Sanlucar de Barrameda",21.5]
];



function ordena($array){
	$i=0;
	while($i<count($array)){
		for($j=0;$j<count($array);$j++){
			if($array[$j][1]<$array[$i][1]){
				$aux=$array[$i];
				$array[$i]=$array[$j];
				$array[$j]=$aux;
			}
		}
		$i++;
	}
	
	return $array;
}

function distancia($array, $name){
	$aux=ordena($array);
	$res=array();
	$cadena="Inicio [";
	$i=0; $cont=0;
	foreach ($aux as $a){
		if($a[0]===$name){
			$i=1;
			$res[0]=$a[0];
			$res[1]=$a[1];
			
		}
		if($i==1){
			if($cont!=(count($array)-1)){
				$cadena=$cadena.$a[0].", ";
			}
			else{
				$cadena=$cadena.$a[0]."] Final";
			}
		}
		$cont++;
	}
	$res[2]=$cadena;
	return $res;
}

foreach(ordena($array) as $a){
	foreach($a as $b){
		echo("$b    ");
	}
	echo("</br>");
}

echo("</br>");



$hola=distancia($array, "Lebrija");


$i=0;
foreach($hola as $a){
	
	if($i==0){
		echo("[Posicion / Distancia a Rota]: ".$a." / ");
	}
	else{
		echo($a."</br>");
	}
	$i++;
}

?>