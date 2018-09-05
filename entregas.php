
<?php
	include 'retiros.php';
	session_start();
	//iniciamos sesion y consultamos a la bd las entregas realizadas
	$prd = new Retiros;
	$ps=$prd->verEntregas();

	

  ?>

<!DOCTYPE html> 
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Entregas</title>
		<link type="text/css" href="estilo.css" rel="stylesheet">

	</head>

	<body>
		<div class="contenedor">
			<div class= "encabezado">
	        	<div class="izq">
	        		<p>Bienvenido/a:<br><?php
            
                    echo  $_SESSION['nombre'].' '. $_SESSION['apellido'];

                 ?></p>
	        	</div>

	            <div class="centro">
	            	<a href=principalBodega.php><img src='imagenes/home.png'><br>Home</a>
	            </div>
	            
	            <div class="derecha">
	                <a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
	            </div>
	        </div>

			<h1 align='center'>ENTREGAS REALIZADAS</h1>
			<br><br>
			<?php

		
				echo "<table  width='80%' align='center'><tr>";	         	  
				echo "<th width='20%'>RUT</th>";
				echo "<th width='20%'>CÓDIGO DEL PRODUCTO</th>";
				echo "<th width='20%'>CANTIDAD</th>";
				echo "<th width='20%'>FECHA DE ENTREGA</th>";
				echo  "</tr>"; 


					for($i = 0; $i < count($ps); $i++){	
	          	
		          echo "<tr>";	         	  
				  echo '<td width=20%>'.$ps[$i]['rut'].'</td>';
				  echo '<td width=20%>'.$ps[$i]['cod_producto'].'</td>';
				  echo '<td width=20%>'. $ps[$i]['cantidad'].'</td>';
				  echo '<td width=20%>'.$ps[$i]['fecha_entrega'].'</td>';
				  echo "</tr>";
				}
			 	echo "</table></br>";
			?>

	</body>
</html>