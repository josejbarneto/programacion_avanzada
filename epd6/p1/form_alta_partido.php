<?php

if(isset($_POST['equipo1'])&&isset($_POST['equipo2'])&&isset($_POST['puntos_1'])&&isset($_POST['puntos_2'])){

if($_POST['equipo1']==$_POST['equipo2']){
	echo("Los equipos no pueden ser iguales");
}else{
	//Conexión principal
$con = mysqli_connect("localhost:3306","root","");
if (!$con) {
	die(' No puedo conectar: ' . mysqli_error());
}

$con->query("SET NAMES 'utf8'");	//Seteo las tíldes

//Conexión con la base de datos
 $db_selected = mysqli_select_db($con,"p1");
if (!$db_selected) {
mysqli_close($con);
 die ("No puedo usar la base de datos: " .
 mysqli_error($con));
}

//Crea la tabla de las ciudades en caso de que no este creada

$sol=mysqli_query($con,"SELECT * FROM `partidos`;");


if(!$sol){
mysqli_query($con,"CREATE TABLE `p1`.`partidos` ( `local` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `ptl` INT NOT NULL , `visitante` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `ptv` INT NOT NULL ) ENGINE = InnoDB;");
mysqli_query($con,"INSERT INTO `partidos` (`local`, `ptl`, `visitante`, `ptv`) VALUES ('".$_POST['equipo1']."', '".$_POST['puntos_1']."', '".$_POST['equipo2']."', '".$_POST['puntos_2']."');");

}else{
	mysqli_query($con,"INSERT INTO `partidos` (`local`, `ptl`, `visitante`, `ptv`) VALUES ('".$_POST['equipo1']."', '".$_POST['puntos_1']."', '".$_POST['equipo2']."', '".$_POST['puntos_2']."');");
}



$res=-1;
if($_POST['puntos_1']>$_POST['puntos_2']){
			//Gana equipo1
	mysqli_query($con, "UPDATE `equipos` SET `PJ`= `PJ` + 1 WHERE nombre='".$_POST['equipo1']."' OR nombre = '".$_POST['equipo2']."';");	
	mysqli_query($con, "UPDATE `equipos` SET `PG`= `PG` + 1 WHERE nombre='".$_POST['equipo1']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PP`= `PP` + 1 WHERE nombre='".$_POST['equipo2']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PF`= `PF` + ".$_POST['puntos_1']." WHERE nombre='".$_POST['equipo1']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PF`= `PF` + ".$_POST['puntos_2']." WHERE nombre='".$_POST['equipo2']."';");

}elseif($_POST['puntos_1']<$_POST['puntos_2']){
			//Gana equipo2
	mysqli_query($con, "UPDATE `equipos` SET `PJ`= `PJ` + 1 WHERE nombre='".$_POST['equipo1']."' OR nombre = '".$_POST['equipo2']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PG`= `PG` + 1 WHERE nombre='".$_POST['equipo2']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PP`= `PP` + 1 WHERE nombre='".$_POST['equipo1']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PF`= `PF` + ".$_POST['puntos_1']." WHERE nombre='".$_POST['equipo1']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PF`= `PF` + ".$_POST['puntos_2']." WHERE nombre='".$_POST['equipo2']."';");
}else{		//empate
	mysqli_query($con, "UPDATE `equipos` SET `PJ`= `PJ` + 1 WHERE nombre='".$_POST['equipo1']."' OR nombre = '".$_POST['equipo2']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PE`= `PE` + 1 WHERE nombre='".$_POST['equipo1']."' OR nombre = '".$_POST['equipo2']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PF`= `PF` + ".$_POST['puntos_1']." WHERE nombre='".$_POST['equipo1']."';");
	mysqli_query($con, "UPDATE `equipos` SET `PF`= `PF` + ".$_POST['puntos_2']." WHERE nombre='".$_POST['equipo2']."';");
}


	
	
}

}

header("Location: index.php");
?>