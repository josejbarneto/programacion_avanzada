<!DOCTYPE html>



<html>


    <head>
        <meta charset="UTF-8">
	</head>
	
	<body>
	
	
	<form action="form_alta_partido.php" method="post">
	
<main>

	
Local 
<select name="equipo1">
<?php

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

$sol=mysqli_query($con,"SELECT * FROM `equipos`;");

while($row = mysqli_fetch_array($sol)) {
	echo '<option>'.$row['nombre']."</option>";
}
mysqli_close($con);
?>
</select>

<input type="number" name="puntos_1" class="pt"> - <input type="number" name="puntos_2" class="pt">

Visitante
<select name="equipo2">
<?php

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

$sol=mysqli_query($con,"SELECT * FROM `equipos`;");

while($row = mysqli_fetch_array($sol)) {
	echo '<option>'.$row['nombre']."</option>";
}
mysqli_close($con);
?>
</select>

<br/>

<input type="submit" value="Guardar" id="subm">
</form>
	</body>
</html>