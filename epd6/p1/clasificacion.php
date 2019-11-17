

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

$sol=mysqli_query($con,"SELECT * FROM `equipos` ORDER BY PG DESC, PF;");
if($sol){
echo('<table border="1"><tr><td>nombre</td><td>PJ</td><td>PG</td><td>PP</td><td>PE</td><td>PF</td></tr>');
while($row = mysqli_fetch_array($sol)) {
	echo '<tr><td>'.$row['nombre']."</td>";
	echo '<td>'.$row['PJ']."</td>";
	echo '<td>'.$row['PG']."</td>";
	echo '<td>'.$row['PP']."</td>";
	echo '<td>'.$row['PE']."</td>";
	echo '<td>'.$row['PF']."</td></tr>";
}
}
else{
	echo("No hay datos en los equipos");
}
echo("</table>");
mysqli_close($con);
?>

