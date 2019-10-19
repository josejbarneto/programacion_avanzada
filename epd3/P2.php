<style>

table{
	margin-left: 30px;
	font-size: 15px;
}

td{
	padding-right: 50px;
}

p{
	font-size: 15px;
}

array{
	color: red;
}

</style>


<?php 

$array = [
["722444222Y", "Jorge Pérez", "FM","Madrid"],
["752324212M", "José Rodríguez", "TDT LOCAL", "Sevilla"]
];

$array2 = [
["722444222Y", "Jorge Pérez", "FM","Madrid"],
["752324212M", "José Rodríguez", "TDT LOCAL", "Sevilla"],
["722444222Y", "Jorge Pérez", "FM","Madrid"],
["752324212M", "José Rodríguez", "TDT LOCAL", "Sevilla"]
];



function imprimeTabla($array){
	
	
	
	echo("<p>REGISTRO DE PRESTADORES DE LA COMUNICACIÓN AUDIOVISUAL </br>PROVINCIA:</p><table>");
	
	echo("<tr><td>DNI</td><td>Denominación</td><td>Tipo de licencia</td><td>Población</td>");
	
	foreach ($array as $a) {
		echo("<tr>");
		
		foreach($a as $i){
			echo("<td>".$i."</td>");
		}
	echo("</tr>");
	}
	echo("</table>");
}


echo("<array>".'$array = [["722444222Y", "Jorge Pérez", "FM","Madrid"],["752324212M", "José Rodríguez", "TDT LOCAL", "Sevilla"]]'."</br></array>");

imprimeTabla($array);

echo("</br></br><array>".'$array2 = [
["722444222Y", "Jorge Pérez", "FM","Madrid"],
["752324212M", "José Rodríguez", "TDT LOCAL", "Sevilla"],
["722444222Y", "Jorge Pérez", "FM","Madrid"],
["752324212M", "José Rodríguez", "TDT LOCAL", "Sevilla"]
]'."</array></br></br>");

imprimeTabla($array2);

?>