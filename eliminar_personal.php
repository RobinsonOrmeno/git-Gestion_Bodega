<?php
include 'Personal.php';
session_start();

//iniciamos sesión y llamamos inmediatamente al metodo verpersonal donde consultamos a la bd 
//el personal actual

$personal = new Personal;

$ps = $personal->verTodoElPersonal();

//consultamos el rut a eliminar con el valor extraido del formulario
if (isset($_POST['eliminar'])) {
	$rut = $_POST['rut'];
	$resultEliminar = $personal->eliminarPersonal($rut);
	if ($resultEliminar){
		header('Location: eliminar_personal.php?eliminar=true');
	}else{
		header('Location: eliminar_personal.php?eliminar=false');
	}		
}

?>
<!DOCTYPE html> 
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>formulario eliminar PERSONAL</title>
		<link type="text/css" href="estilo.css" rel="stylesheet">

	</head>

	<body>
		<div class="contenedor">
		<div class= "encabezado">
			<div class="izq">
			
				<p>Bienvenido/a:<br><?php
                 //  include 'Personal.php';
                    echo  $_SESSION['nombre'].' '. $_SESSION['apellido'];

                 ?></p>

			</div>

			<div class="centro">
				<a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a>
			</div>
				
			<div class="derecha">
				<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
			</div>
		</div>
		
		<?php

		if(isset($_GET['eliminar'])){
			if($_GET['eliminar']){
				echo '<div style="color:green;font-size:24px;">Se ha eliminado correctamente</div>';
			}else{
				echo '<div style="color:red;font-size:24px;">No se pudo eliminar</div>';
			}
		}

		?>
		
		<br><br><h1 align='center'>REGISTROS EXISTENTES</h1><br>
		<?php
			echo "<table  width='80%' align='center'><tr>";	         	  
			echo "<th width='20%'>RUT</th>";
			echo "<th width='20%'>NOMBRE</th>";
			echo "<th width='20%'>APELLIDO</th>";
			echo "<th width='20%'>CARGO</th>";
			echo  "</tr>"; 
			
			for($i = 0; $i < count($ps); $i++){	
	          	
	          echo "<tr>";	         	  
			  echo '<td width=20%>'.$ps[$i]['rut'].'</td>';
			  echo '<td width=20%>'.$ps[$i]['nombre'].'</td>';
			  echo '<td width=20%>'. $ps[$i]['apellido'].'</td>';
			  echo '<td width=20%>'.$ps[$i]['cargo'].'</td>';
			  echo "</tr>";
			}
			echo "</table></br>";
		?>

		<form action="eliminar_personal.php" method="post" align='center'>
			<label name="elimina">Ingresa el Rut del personal a eliminar:</label>
			<input name='rut' type="text">
			<input name='eliminar' type="submit" value="ELIMINAR">
		</form>
		    	
		</div>
	</body>
</html>		 