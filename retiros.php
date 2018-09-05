<?php

	include 'conexion.php';



	 class Retiros {
	 	private $bd;

		function __construct(){
			$this->bd = new conexion_bd;


		}

		public function crearEntrega($rut,$cod_producto,$cantidad,$fecha_entrega){
			$result = false;
			$mysql = $this->bd->getDB();
			$query = "INSERT into entregas (rut,cod_producto,cantidad,fecha_entrega)values(?,?,?,?)";
			$ps = $mysql->prepare($query);
			$ps->bind_param("ssss",$rut,$cod_producto,$cantidad,$fecha_entrega);
			if($ps->execute()){
				$result = true;
				$this->updateStock($cod_producto,$cantidad);

			}


			$ps->free_result();
			$ps->close();
			$mysql->close();



			return $result;

		}

		
		public function updateStock($cod_producto,$cantidad){

			//capturo el stock del producto gracias al codigo de este mismo

			$result= null;
			$mysql = $this->bd->getDB();
			$queryConsulta="SELECT stock from productos where cod_producto = ?";
			$ps = $mysql->prepare($queryConsulta);

			$ps->bind_param("s",$cod_producto);
			if($ps->execute()){
				$result = array();
				$ps->bind_result($stock);
				while($ps->fetch()){
					
					$row['stock']=$stock;
			
					$result[]=$row;


				}
				
			}
			//Luego capturo el stock actual con la consulta a la bdd y actualizo el stock restando la cantidad
			//ingresada por el usuario 

			$queryUp="UPDATE productos SET stock= $stock - $cantidad WHERE cod_producto = $cod_producto";
			$ps = $mysql->prepare($queryUp);
			if($ps->execute()){
				$result = true;
				
			}

			$ps->free_result();
			$ps->close();
			$mysql->close();
			return  $result;



		}

		public function verEntregas(){
			//Cuando llamamos a esta función hacemos una consulta a la bdd especificamente a la tabla de entregas
			$result= null;
			$mysql = $this->bd->getDB();
			$query = "SELECT * FROM entregas";


			$ps=$mysql->prepare($query);
			$ps->execute();
			$ps->store_result();
			if($ps->num_rows>0){
				$result = array();
				$ps->bind_result($rut,$cod_producto,$cantidad,$fecha_entrega);
				while($ps->fetch()){
					$row['rut']=$rut;
					$row['cod_producto']=$cod_producto;
					$row['cantidad']=$cantidad;
					$row['fecha_entrega']=$fecha_entrega;
					
					$result[]=$row;


				}
			}

			$ps->free_result();
			$ps->close();
			$mysql->close();
			return $result;

		}


}

  ?>