<?php
include 'bd.php';
//$personalTest = new Personal;
//$results=$personalTest->getDatos('153204209','1234');



class Personal{

	private $bd;

	function __construct(){
		$this->bd = new BD;
	

	}

	public function agregarPersonal($rut,$nombre,$apellido,$cargo,$contrasena)
	{	
		$result = false;
		$mysql = $this->bd->getDB();
		$query = "INSERT INTO personal(rut,nombre,apellido,cargo,contrasena) VALUES(?,?,?,?,?)";
		$ps = $mysql->prepare($query);
		$ps->bind_param("sssss",$rut,$nombre,$apellido,$cargo,$contrasena);
		if($ps->execute()){
			$result = true;
		}
		$ps->free_result();
		$ps->close();
		$mysql->close();
		return $result;
	}




	public function login($rut,$contrasena){

		session_start();
		$result = null;
		$mysql = $this->bd->getDB(); //SE ABRE CONEXIÒN A LA BASE DE DATOS
		$query = "SELECT * FROM personal WHERE rut = ? AND contrasena = ?"; // CONSULTA A CONSULTAR LA BD
		
		$ps = $mysql->prepare($query); //SE PREPARA LA CONSULTA
		$ps->bind_param("ss",$rut,$contrasena); //SE BINDEAN LOS DATOS A LA CONSULTA
		
	
		$ps->execute(); // SE EJECUTA LA CONSULTA
		$ps->store_result(); //SE ALMACENA LOS DATOS DE LA CONSULTA
		if($ps->num_rows > 0){ // SE VALIDA CANTIDAD DE FILAS RETORNADAS POR LA CONSULTA
			$ps->bind_result($rut,$nombre,$apellido,$cargo,$contrasena); // SE BINDEAN LOS DATOS DE LA CONSULTA A VARIABLES
			while($ps->fetch()){ // RECORRE LOS RESULTADOS
				$result['rut'] = $rut; //LLENO LOS DATOS
				$result['nombre'] = $nombre;
				$result['apellido'] = $apellido;
				
				$result['cargo'] = $cargo;

	

			
			}


			$_SESSION['rut']=$rut;
    		$_SESSION['nombre']=$nombre;
    		utf8_encode($_SESSION['apellido']=$apellido);
    		$_SESSION['cargo']=$cargo;


				if($cargo=='Bodega'){
						echo'Redireccionar a bodega';
						

						header('Location: principalBodega.php');
						

				}else{
						echo'Redireccionar a ADMIN';
							 header('Location: principalAdmin.php');
				}




		}

		$ps->free_result(); //LIBERO LA MEMORIA DE LA CONSULTA
		$ps->close(); //CIERRO EL PROCEDIMIENTO
		$mysql->close(); // CIERRO LA BASE DE DATOS

		return $result; // RETORNO EL RESULTADO

	}




	public function verTodoElPersonal(){
		$result = null;
		$mysql = $this->bd->getDB();
		$query = "SELECT rut,nombre,apellido,cargo FROM personal ORDER BY nombre ASC";
		$ps = $mysql->prepare($query);
		$ps->execute();
		$ps->store_result();
		if($ps->num_rows > 0){
			$result = array();
			$ps->bind_result($rut,$nombre,$apellido,$cargo);
			while($ps->fetch()){
				$row['rut'] = $rut;
				$row['nombre'] = $nombre;
				$row['apellido'] = $apellido;
				$row['cargo'] = $cargo;
				$result[] = $row;
			}
		}
		$ps->free_result();
		$ps->close();
		$mysql->close();
		return $result;
	}

	public function eliminarPersonal($rut){
		$result = false;
		$mysql = $this->bd->getDB();
		$query = "DELETE FROM personal WHERE rut = ?";
		$ps = $mysql->prepare($query);
		$ps->bind_param("s",$rut);
		if($ps->execute()){
			$result = true;
		}
		$ps->free_result();
		$ps->close();
		$mysql->close();
		return $result;
	}


	public function modificarPersonal($nombre,$apellido,$cargo,$rut){

		$result = false;
		$mysql = $this->bd->getDB();
		$query = "UPDATE  personal SET nombre =?,apellido =?,cargo =? WHERE rut=?";
		$ps = $mysql->prepare($query);
		$ps->bind_param("ssss",$nombre,$apellido,$cargo,$rut);
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







