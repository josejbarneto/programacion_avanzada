<!DOCTYPE html>



<html>


    <head>
        <meta charset="UTF-8">
	</head>
	
	<body>
	<?php
		session_start();
		if(!isset($_SESSION['log'])){
			echo('<form action="clasificacion.php">
						<input type="submit" value="Clasificación">
					</form>
					<br/>
					<form action="login/index.php">
						<input type="submit" value="login">
					</form>');
		}
		elseif($_SESSION['log']==true){
			echo('<form action="alta_equipo.php">
					<input type="submit" value="Alta equipo">
				</form>
				<br/>
				<form action="alta_partido.php">
					<input type="submit" value="Alta partido">
				</form>
				<br/>
				<form action="clasificacion.php">
					<input type="submit" value="Clasificación">
				</form>
				<br/>
				<form action="logout.php">
					<input type="submit" value="Logout">
				</form>
				');
		}
		
	?>
		
		
	</body>
	
</html>