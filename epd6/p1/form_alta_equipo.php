<?php

if(isset($_POST['nombre'])&&isset($_POST['ciudad'])){
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
 die ("No puedo usar la base de datos: " .mysqli_error($con));
}



//En caso de que la tabla no esté creada la crea y añade el formulario, en caso contrario añade el formulario a la tabla ya creada
$sol=mysqli_query($con,"SELECT * FROM `equipos`;");

if(!$sol){
	mysqli_query($con,"CREATE TABLE `p1`.`equipos` ( `nombre` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `ciudad` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL , `id` INT NOT NULL , `PJ` INT NOT NULL , `PG` INT NOT NULL , `PP` INT NOT NULL , `PF` INT NOT NULL , `PE` INT NOT NULL ) ENGINE = InnoDB;");
	mysqli_query($con,"INSERT INTO `equipos` (`nombre`, `ciudad`, `id`, `PJ`, `PG`, `PP`, `PF`, `PE`) VALUES ('".$_POST['nombre']."', '".$_POST['ciudad']."', '0', '0', '0', '0', '0', '0')");
}else{
	
	$id=mysqli_query($con,"SELECT count(*) FROM `equipos`;");
	$rows = mysqli_fetch_row($id);
	echo($rows[0]);

	mysqli_query($con,"INSERT INTO `equipos` (`nombre`, `ciudad`, `id`, `PJ`, `PG`, `PP`, `PF`, `PE`) VALUES ('".$_POST['nombre']."', '".$_POST['ciudad']."', '".$rows[0]."', '0', '0', '0', '0', '0')");
}
$sol=mysqli_query($con,"SELECT * FROM `equipos`;");

echo("<table>");

while($row = mysqli_fetch_array($sol)) {
	echo ('<tr><td>'.$row['nombre']."</td>");
	echo ('<td>'.$row['ciudad']."</td></tr>");
}
echo("</table>");

mysqli_close($con);

header("Location: index.php");
}
?>