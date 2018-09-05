<?php
	include 'bd.php';
	

 	//$prodTest = new Productos;


 //	$se=$prodTest->getEntregas();

	class Productos {
		private $bd;

		function __construct(){
			$this->bd = new BD;


		}

		public function verProductos(){
			$result= null;
			$mysql = $this->bd->getDB();
			$query = "SELECT cod_producto,descripcion,stock,proveedor,fecha_ingreso FROM productos ORDER BY cod_producto ASC";


			$ps=$mysql->prepare($query);
			$ps->execute();
			$ps->store_result();
			if($ps->num_rows>0){
				$result = array();
				$ps->bind_result($cod_producto,$descripcion,$stock,$proveedor,$fecha_ingreso);
				while($ps->fetch()){
					$row['cod_producto']=$cod_producto;
					$row['descripcion']=$descripcion;
					$row['stock']=$stock;
					$row['proveedor']=$proveedor;
					$row['fecha_ingreso']=$fecha_ingreso;
					$result[]=$row;


				}
			}

			$ps->free_result();
			$ps->close();
			$mysql->close();
			return $result;


		}





		public function agregarProducto($cod_producto,$descripcion,$stock,$proveedor,$fecha_ingreso){

			$result = false;
			$mysql = $this->bd->getDB();
			$query = "INSERT into productos (cod_producto,descripcion,stock,proveedor,fecha_ingreso)values(?,?,?,?,?)";
			$ps = $mysql->prepare($query);
			$ps->bind_param("sssss",$cod_producto,$descripcion,$stock,$proveedor,$fecha_ingreso);
			if($ps->execute()){
				$result = true;
			}
			$ps->free_result();
			$ps->close();
			$mysql->close();
			return $result;


		}

		public function actualizarStock($cod_producto,$stock){
			$result = false;
		$mysql = $this->bd->getDB();
		$query = "UPDATE productos SET stock=? WHERE cod_producto=?";
		$ps = $mysql->prepare($query);
		$ps->bind_param("ss",$stock,$cod_producto);
		if($ps->execute()){
			$result = true;
		}
		$ps->free_result();
		$ps->close();
		$mysql->close();
		return $result;



		}

		public function modificarProd($cod_producto,$descripcion,$proveedor,$fecha_ingreso){
					$result = false;
		$mysql = $this->bd->getDB();
		$query = "UPDATE productos SET descripcion=? , proveedor = ?, fecha_ingreso = ? WHERE cod_producto=? "; 
		$ps = $mysql->prepare($query);
		$ps->bind_param("ssss",$descripcion,$proveedor,$fecha_ingreso,$cod_producto);
		if($ps->execute()){
			$result = true;
		}
		$ps->free_result();
		$ps->close();
		$mysql->close();
		return $result;



		}


		public function eliminarProducto($cod_producto){
				$result = false;
			$mysql = $this->bd->getDB();
			$query = "DELETE FROM productos WHERE cod_producto = ?";
			$ps = $mysql->prepare($query);
			$ps->bind_param("s",$cod_producto);
			if($ps->execute()){
				$result = true;
			}
			$ps->free_result();
			$ps->close();
			$mysql->close();
			return $result;


		}





		


}






  ?>