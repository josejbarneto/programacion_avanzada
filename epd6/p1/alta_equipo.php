<!DOCTYPE html>
<html>


    <head>
        <meta charset="UTF-8">
	</head>
	
	
<form action="form_alta_equipo.php" method="post">
<input type="text" name="nombre"> </br>
<select name="ciudad">

<?php
header('Content-Type: text/html; charset=UTF-8'); 


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

$sol=mysqli_query($con,"SELECT * FROM `ciudades`;");


if(!$sol){
mysqli_query($con,"CREATE TABLE `p1`.`ciudades` ( `nombre` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ) ENGINE = InnoDB;");
mysqli_query($con,"INSERT INTO `ciudades` (`nombre`) VALUES ('Almería'), ('Cádiz'), ('Córdoba'), ('Granada'), ('Huelva'), ('Jaén'), ('Málaga'), ('Sevilla')");
$sol=mysqli_query($con,"SELECT * FROM `ciudades`;");
}



while($row = mysqli_fetch_array($sol)) {
	echo '<option>'.$row['nombre']."</option>";
}

// Continua el procesamiento
mysqli_close($con);
?>
</select>
<input type="submit" value="Validar">
</form>

</html>