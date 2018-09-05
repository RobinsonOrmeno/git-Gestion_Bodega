<?php 
	session_start();
	include 'Productos.php';
	$producto = new Productos;

	
	$ps= $producto->verProductos();
	if (isset($_POST['eliminar'])) {
	$cod_producto = $_POST['eliminar-producto'];
	$resultEliminar = $producto->eliminarProducto($cod_producto);
	if ($resultEliminar){
		header('Location: eliminar_producto.php?eliminar=true');
	}else{
		header('Location: eliminar_producto.php?eliminar=false');
	}
		
}


  ?>
<!DOCTYPE html> 
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>formulario eliminar producto</title>
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
					<?php
						
						if ($_SESSION['cargo']=='Admin') {
								echo "<a href=principalAdmin.php><center><img src='imagenes/home.png'><br>Home<center></a>";
						}else {
								echo "<a href=principalBodega.php><img src='imagenes/home.png'><br>Home</a>";
						}
	       			?> 


		<?php

		if(isset($_GET['eliminar'])){
			if($_GET['eliminar']){
				echo '<div style="color:green;font-size:24px;">Se ha eliminado correctamente</div>';
			}else{
				echo '<div style="color:red;font-size:24px;">No se pudo eliminar</div>';
			}
		}

		?>




				</div>
				
				<div class="derecha">
					
					<a href="salir.php?sal=si"><img src="imagenes/cerrar.png"><br>Salir</a>
				</div>
			</div>
				
			
			<br><h1 align='center'>REGISTROS EXISTENTES</h1><br>
			<?php
				
			
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
				  echo '<td width=20%>'.$ps[$i]['stock'].'</td>';
				  echo '<td width=20%>'.$ps[$i]['proveedor'].'</td>';
				  echo '<td width=20%>'.$ps[$i]['fecha_ingreso'].'</td>';
				  echo "</tr>";
				}
				echo "</table></br>";
			?>

			<form action="" method="post" align='center'>
			 	<label name="elimina">Ingresa el código del producto a eliminar:</label>
			 	<input name='eliminar-producto' type="text">
			 	<input name='eliminar' type="submit" value="ELIMINAR">
			</form>

		
			
		    	
		</div>
	</body>
</html>		 