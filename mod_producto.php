<?php
session_start();

include 'Productos.php';
	$producto = new Productos;

	
	$ps= $producto->verProductos();
	
		if(isset($_POST['actualiza'])){
		$error=false;
		$msgError="";
		$ok=false;
		$msgOk="";
		$cod_producto=$_POST['seleccionar'];
		$stock=$_POST['stock'];
		
		$result=$producto->actualizarStock($cod_producto,$stock);
		if($result){
            $ok = true;
            $msgOk = "Se Modifico correctamente";
        }else{
            $error = true;
            $msgError = "No se pudo Modificar el Stock";
        }


        if($result){
			header('Location: mod_producto.php?actualiza=true');
		}else{
			header('Location: mod_producto.php?actualiza=false');
		}

	}



	if(isset($_POST['modificar'])){
		$error=false;
		$msgError="";
		$ok=false;
		$msgOk="";
		$cod_producto=$_POST['seleccionar'];
		$descripcion=$_POST['descripcion'];
		$proveedor=$_POST['proveedor'];
		$fecha_ingreso=$_POST['fecha'];
		$result=$producto->modificarProd($cod_producto,$descripcion,$proveedor,$fecha_ingreso);
		if($result){
            $ok = true;
            $msgOk = "Se Modifico correctamente";
        }else{
            $error = true;
            $msgError = "No se lograron modificar los datos";
        }


        if($result){
			header('Location: mod_producto.php?modificar=true');
		}else{
			header('Location: mod_producto.php?modificar=false');
		}

	}

  ?>
<!-- Incluir archivos requeridos -->

<!DOCTYPE html> 
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Modificar producto</title>
		<link type="text/css" href="estilo.css" rel="stylesheet">

	</head>

	<body>
		<div class="contenedor">
			<div class= "encabezado">
				<div class="izq">
					<p>Bienvenido/a:<br>
						<?php
                //   include 'Personal.php';
                    echo  $_SESSION['nombre'].' '. $_SESSION['apellido'];

                 ?></p>
				</div>

				<div class="centro">
					<?php
						// Las siguientes 5 líneas verifican el cargo del usuario que esta viendo esta pagina para asignarle el flujo que tendra el links con imagen "Home".
						 if ($_SESSION['cargo']=='Admin') {
                            echo "<a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a>";
                    }else {
                            echo "<a href=principalBodega.php><img src='imagenes/home.png'><br>Home</a>";
                    };

                    error_reporting(E_ALL  ^  E_NOTICE  ^  E_WARNING);
				
	       			?> 
				</div>
				
				<div class="derecha">
					<!-- La siguiente línea corresponde al links con imagen para finalizar sesión, que redirige a la página salir.php con la varible "sal=si" que destruye la sesión y nos 
					muestra la pagina del login. -->
					<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
				</div>
			</div>
			<br><h1 align="center">PRODUCTOS EXISTENTES</h1><br>
			<?php
				//include('conexion.php');

				//$consulta="SELECT * FROM productos";
		//		$ejecutar=mysql_query($consulta,$conexion);
			
				echo "<table  width='80%' align='center'><tr>";	         	  
				echo "<th width='10%'>CODIGO PRODUCTO</th>";
				echo "<th width='20%'>DESCRIPCIÓN</th>";
				echo "<th width='10%'>STOCK</th>";
				echo "<th width='20%'>PROVEEDOR</th>";
				echo "<th width='20%'>FECHA DE INGRESO</th>";
				echo  "</tr>"; 
			
				for($i = 0; $i < count($ps); $i++){	
		          	
		          echo "<tr>";	         	  
				  echo '<td width=10%>'.$ps[$i]['cod_producto'].'</td>';
				  echo '<td width=20%>'.$ps[$i]['descripcion'].'</td>';
				  echo '<td width=20%>'. $ps[$i]['stock'].'</td>';
				  echo '<td width=20%>'.$ps[$i]['proveedor'].'</td>';
				  echo '<td width=20%>'.$ps[$i]['fecha_ingreso'].'</td>';
				  echo "</tr>";
				}
				echo "</table></br>";
			?>


			<div class="encabezado">
	                <h1>Modificar producto</h1>
	        </div>

	        <div class="formulario">

	            <form name="actualizar" method="post" action="" enctype="application/x-www-form-urlencoded">
	           		<div class="campo">
	               		<p>Para actualizar el stock de un producto ingresa el código del producto y la cantidad que deseas agregar. Para quitar deber ingresar la cantidad anteponiendo el signo menos (-) a la cantidad</p><br><br>

	                    <label name="Seleccionar">Ingresa el código del producto que deseas actualizar:</label>
			 			<input name='seleccionar' type="text" required>
	                </div>

	                <div class="campo">
	                    <div class="en-linea izquierdo">
	                        <label for="descrip">Stock:</label>
	                        <input type="number" name="stock" required/>
	                    </div>

	                    <div class="en-linea">
	                        <label for="apellido">Stock:</label>
	                        <input type="submit" name="actualiza" value="Actualizar" required/>
	                    </div>
	                </div>

	            </form>

	            <!-- Verificación del boton submit "actualizar".
	            	Actualizar stock del producto seleccionado.
	            	Redirigir a la misma pagina para visualizar los cambios.  -->
	            	<?php  if (isset($_GET['actualiza'])){
							if($_GET['actualiza']){

								
								echo '<div style="color:green;font-size:24px;">Se ha modificado correctamente</div>';
							}else{
								echo '<div style="color:red;font-size:24px;">No se pudo actualiza</div>';
							}

					}
					?>	







	            <form name="modificar" method="post" action="" enctype="application/x-www-form-urlencoded">

	                <div class="campo">
	                    <label name="Seleccionar">Ingresa el código del producto que deseas modificar:</label>
			 			<input name='seleccionar' type="text" required>
	                </div>

	                <div class="campo">
	                    <label for="descrip">Descripción:</label>
	                    <input type="text" name="descripcion" required/>
	                </div>

	                <div class="campo">
	                    <label for="cargo">Proveedor:</label>
		                <input type="text" name="proveedor" required/>
	                </div>

	                <div class="campo">
	                    <label for="cargo">Fecha ingreso:</label>
		                <input type="date" name="fecha" required/>
	                </div>

	                <div class="botones">
	                    <input type="submit" name="modificar" value="Modificar"/>
					</div>
				</form>
				<?php  if (isset($_GET['modificar'])){
							if($_GET['modificar']){

								
								echo '<div style="color:green;font-size:24px;">Se ha modificado correctamente</div>';
							}else{
								echo '<div style="color:red;font-size:24px;">No se pudo modificar</div>';
							}

					}
					?>	






				<!-- Verificación del boton sumbit "modificar".
					Recuperar las variables con los valores ingresados.
					Realizar modificación de datos en la tabla correspondiente. 
					Redirigir el flujo a esta misma página para visualizar los cambios. -->  
				
			</div>
		</div>
	</body>
</html>