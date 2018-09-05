<?php 
	include 'Personal.php';
	$personal = new Personal;
	session_start();
	// la variable ps la suelo utilizar para crear un nuevo objeto ps=prepare statement

	$ps= $personal->verTodoElPersonal();
	
	if(isset($_POST['modificar'])){
		$error=false;
		$msgError="";
		$ok=false;
		$msgOk="";
		$rut=$_POST['seleccionar'];
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$cargo=$_POST['cargo'];
		$result=$personal->modificarPersonal($nombre,$apellido,$cargo,$rut);
		if($result){
            $ok = true;
            $msgOk = "Se Modifico correctamente";
        }else{
            $error = true;
            $msgError = "No se pudo Modificar el personal";
        }


        if($result){
			header('Location: mod_personal.php?modificar=true');
		}else{
			header('Location: mod_personal.php?modificar=false');
		}
					
	}

 ?>


<!DOCTYPE html> 
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Modificar personal</title>
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
					<a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a> 
				</div>
				
				<div class="derecha">
					<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
				</div>
			</div>
			<br><h1 align='center'>REGISTROS EXISTENTES</h1><br>
			<?php
				include('conexion.php');

				$consulta="SELECT * FROM personal";
			//	$ejecutar=mysqli_query($consulta,$conexion);
			
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


			<div class="encabezado">
	            <h1>Modificar personal</h1>
	        </div>

	        <div class="formulario">
	            <form ="registro" method="post" action="" enctype="application/x-www-form-urlencoded">

	                <div class="campo">
	                    <label name="Seleccionar">Ingresa el 
	                    Rut del registro a modificar:</label>
			 			<input name='seleccionar' type="text" required>
	                </div>

	                <div class="campo">
	                    <div class="en-linea izquierdo">
	                        <label for="nombre">Nombre:</label>
	                        <input type="text" name="nombre" required/>
	                    </div>

	                    <div class="en-linea">
	                        <label for="apellido">Apellido:</label>
	                        <input type="text" name="apellido" required/>
	                    </div>
	                </div>

	                <div class="campo">
	                    <label for="cargo">cargo:</label>
		                <select name="cargo" required/>
		                    <option>Admin</option>
		                    <option>Bodega</option>
	                    </select>
	                </div>

	                <div class="botones">
	                    <input type="submit" name="modificar" value="Modificar"/>
					</div>
				</form>
				<?php
						 
				
					if(isset($_GET['modificar'])){
							if($_GET['modificar']){

								
								echo '<div style="color:green;font-size:24px;">Se ha modificado correctamente</div>';
							}else{
								echo '<div style="color:red;font-size:24px;">No se pudo modificar</div>';
							}

					}


					
				    // La siguiente línea verifica que la varible del boton submit "modificar" este creada.	
					if (isset($_POST['modificar'])) {

						//La siguiente linea recupera la variable donde se ingreso el rut a modificar.
						$seleccionar = $_POST['seleccionar'];

						// Las siguientes 2 líneas verifican que el registro que se desea modificar no corresponda al rut del Admin y se muestra alerta con mensaje. 
						if ($seleccionar == '180332403') {
							echo "<script lenguaje='javascript'>alert('Admin general no puede ser modificado');</script>";
						}else {

							
							
						};

						
					};
						 
				?>
			</div>
		</div>
	</body>
</html>		