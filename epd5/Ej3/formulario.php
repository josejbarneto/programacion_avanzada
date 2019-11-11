<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">



<style>
	#name, #corr, #tel, #fijo, #pos{
		color: red;
	}
</style>




    <head>
        <title>FORMULARIO</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    </head>
    <body>
        <nav>
            <div class="menu">
                <a href="#">MENÚ</a>

                <img src="imgs/logo.png" alt="logo">

                <a href="#">GALERÍA</a>
            </div>
        
            
            
            <h1>Campeonato EPD1</h1>            
            
            <details>
                
                <summary><strong>Campeonato organizado</strong></summary>

                <p>
                    <strong>¡Dentro de dos semanas comienza!</strong> Es el campeonato de la <em>EPD1.</em>
                    Consistirá en varios partidos entre los equipos inscritos.
                </p>
            
            </details>
            </nav>
            <br/>
            
            
            <h2>Rellena el siguiente formulario para inscribirte:</h2>
            <form action="formulario.php" method="post">
            <p>
			
			
			
			
			
			
			
                Nombre completo: <input type="text" name="nombre" value="
<?php 			
					if(isset($_POST['nombre'])){
							echo($_POST['nombre']);	
					}				
?>"/>
				
				
<?php
		if(isset($_POST['nombre'])){
			$nombre=$_POST['nombre'];
			if(preg_match("/^[A-Za-z\s]+$/",$nombre)){
						if(!preg_match("/[A-Z]/",$nombre[0])){
							echo('<span id="name">'."Error en el nombre, Ejemplo: Francisco de la olla Ramirez".'</span>'.'<br/>');
						}
			}else{
				echo('<span id="name">'."Error en el nombre, Ejemplo: Francisco de la olla Ramirez".'</span>'.'<br/>');
			}
		}
?>				
				
				<br/>
				
				
				
				
                Direcci&oacute;n de Correo Electr&oacute;nico:
                <input type="email" name="correo" value="
<?php 

	if(isset($_POST['correo'])){
			echo($_POST['correo']);
	}	
				
?>"/>

<?php
		if(isset($_POST['correo'])){
			if(!filter_var($_POST['correo'],FILTER_VALIDATE_EMAIL)){
				echo('<span id="corr">'."Error en el correo, ejemplo: correo@gmail.com".'</span>');
			}
		}
?>

                <br/>
				
				
				
				
				
				
				
				
                Direcci&oacute;n de Tel&eacute;fono fijo: 
                <input type="tel" name="telefono1" id="telefonof" value="
<?php 
	if(isset($_POST['telefono1'])){
			echo($_POST['telefono1']);  
		}
?>"/>

<?php
		if(isset($_POST['telefono1'])){
			$options = array('options'=>array('min_range'=>800000000, 'max_range' => 999999999)); 
			if(!filter_var($_POST['telefono1'], FILTER_VALIDATE_INT, $options)){  
				echo('<span id="tel">'."Tel&eacute;fono fijo incorrecto, ejemplo: 821232123".'</span>');
			} 
		}

?>

				<br/>
				
			
				
				
				
				
				
				
                Direcci&oacute;n de Tel&eacute;fono m&oacute;vil: 
                <input type="tel" name="telefono2" id="telefonom"	value="
<?php
	if(isset($_POST['telefono2'])){
			echo($_POST['telefono2']);
	}

?>"/>


<?php
		if(isset($_POST['telefono2'])){
			$options = array('options'=>array('min_range'=>600000000, 'max_range' => 799999999)); 
			if(filter_var($_POST['telefono2'], FILTER_VALIDATE_INT, $options) === false){  
				echo('<span id="fijo">'."Tel&eacute;fono m&oacute;vil incorrecto, ejemplo: 625152532".'</span>');
			}
		}

?>			
                <br/>
				
				
				
				
				
				
                Direcci&oacute;n postal: 
				<input type="text" name="postal" value="
<?php
		if(isset($_POST['postal'])){
				echo($_POST['postal']);
		}
				
?>">  

<?php
	if(isset($_POST['postal'])){
			if(!preg_match("/([a-zA-Z](?![0-9])*)+-+([a-zA-Z](?![0-9])*)+-+([a-zA-Z](?![0-9])*)/",$_POST['postal'])){
				echo('<span id="pos">'."Direcci&oacute;n postal incorrecta, ejemplo: Sierpes-Sevilla-Sevilla".'</span>');
			}
		}
?>            
                <br/>
				<br/>
				
				Categor&iacute;a en la que desea inscribirse:
				<br/>
				<input type="radio" name="cate" value="Primera" checked> Primera<br>
				<input type="radio" name="cate" value="Segunda"> Segunda<br>
				<input type="radio" name="cate" value="Tercera"> Tercera<br>  
				
				<br/>
				
				Selecciona la franja horaria:
				<br/>
				<select multiple name="horario" required>
					<option value="9:00 - 12:30">9:00 - 12:30</option>
					<option value="12:30 - 14:00">12:30 - 14:00</option>
					<option value="14:00 - 15:30">14:00 - 15:30</option>
					<option value="15:30 - 17:00">15:30 - 17:00</option>
				</select>


				<br/>
                <br/>
                <input type="submit" value="Enviar"/>
            </p>
            </form>
            <br/>
			

<!--main-->
			
<?php
	
	$arr=array(0,0,0,0,0,0);
		if(isset($_POST['correo'])){
			if(filter_var($_POST['correo'],FILTER_VALIDATE_EMAIL)){
				$arr[0]=1;
			}
		}
		
		if(isset($_POST['telefono1'])){
			$options = array('options'=>array('min_range'=>800000000, 'max_range' => 999999999));
			if(!filter_var($_POST['telefono1'], FILTER_VALIDATE_INT, $options) === false){  
				$arr[1]=1;
			} 
		}
		
		if(isset($_POST['telefono2'])){
			$options = array('options'=>array('min_range'=>600000000, 'max_range' => 799999999)); 
			if(!filter_var($_POST['telefono2'], FILTER_VALIDATE_INT, $options) === false){  
				$arr[2]=1;  
			}
		}
		
		if(isset($_POST['nombre'])){
			$nombre=$_POST['nombre'];
			if(preg_match("/^[A-Za-z\s]+$/",$nombre)){
						if(preg_match("/[A-Z]/",$nombre[0])){
							$arr[3]=1;
						}
			}
		}


		if(isset($_POST['postal'])){
			if(preg_match("/([a-zA-Z](?![0-9])*)+-+([a-zA-Z](?![0-9])*)+-+([a-zA-Z](?![0-9])*)/",$_POST['postal'])){
				$arr[4]=1;
			}
		}
		
		if(isset($_POST['horario'])){
			$arr[5]=1;
		}
		

		$sol=1;
		foreach($arr as $a){
			if($a==0){
				$sol=0;
			}
		}

		if($sol==1){
			echo("<h2>Resumen: </h2><br/>");
			echo("Nombre completo: ".$_POST['nombre']."<br/>");
			echo("Direcci&oacute;n de Correo Electr&oacute;nico: ".$_POST['correo']."<br/>");
			echo("Direcci&oacute;n de Tel&eacute;fono fijo: ".$_POST['telefono1']."<br/>");
			echo("Direcci&oacute;n de Tel&eacute;fono m&oacute;vil: ".$_POST['telefono2']."<br/>");
			echo("Direcci&oacute;n postal: ".$_POST['postal']."<br/>");
			echo("Categor&iacute;a en la que desea inscribirse: ".$_POST['cate']."<br/>");
			echo("Selecciona la franja horaria:".$_POST['horario']."<br/>");
		}
		
?>
			
			
			
			
            
            <section>
                <h2>Participantes</h2>
                <table>
                    <tr>
                        <td colspan="3"><strong>Participantes ya inscritos en el torneo</strong></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>Primer apellido</td>
                        <td>Segundo Apellido</td>
                    </tr>
                    <tr>
                        <td>Pepito</td>
                        <td>Pérez</td>
                        <td>Rodriguez</td>
                    </tr>
                    <tr>
                        <td>Rafael</td>
                        <td>Nadal</td>
                        <td>Canario</td>
                    </tr>
                    <tr>
                        <td>Roger</td>
                        <td>Federer</td>
                        <td>Suizo</td>   
                    </tr>
                    <tr>
                        <td>Novak</td>
                        <td>Djokovic</td>
                        <td>Ђоковић</td>
                    </tr>
                    <tr>
                        <td>John</td>
                        <td> <ruby>漢 <rt> ㄏㄢˋ </rt></ruby></td>
                        <td>P&eacute;rez</td>    <!--No soportado en todos los navegadores-->
                    </tr>
                    
                </table>
            </section>
            
            <br/>
            
            <div>
                Progreso de completar la inscripción: 
                <progress value="22" max="100"></progress>
            </div>
            
            <br/>
            
            <div>
                <h3>Los teléfonos de contacto son los siguientes: </h3>
                <ul>
                    <li>
                        <strong>Administración:</strong>
                        <ol>
                            <li>+34 643207394</li>
                            <li>+34 601823853</li>
                        </ol>
                    </li>
                    <li>
                        <strong>Gestión de entradas:</strong>
                        <ol>
                            <li>+34 629384628</li>
                            <li>+34 627949274</li>
                        </ol>
                    </li>
                    <li>
                        <strong>Mantenimiento:</strong>
                        <ol>
                            <li>+34 609823482</li>
                        </ol>
                    </li>
                </ul>
            </div>
            
            <br/>
                
            <footer>La inscripción del torneo terminará el día <time datetime="2019-10-14 20:00">14/10/2019 20:00</time></footer>
                
    </body>
</html>
