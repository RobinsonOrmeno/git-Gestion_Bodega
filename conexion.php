<!-- Conexión a la base de datos,
codificación de caracteres,
seleccion de base de datos. -->

<?php  
	//Cree este objeto conexion para poder incluirlo dentro del objeto retiros

	 class conexion_bd{

	public $mysqli = null;

	function __construct(){
		

	}

	public function getDB(){
		$user = "root";
		$pass = "";
		$bd = "gestion_bodega";
		$server = "localhost";

		$this->mysqli = new mysqli($server,$user,$pass,$bd);
		if ($this->mysqli->connect_errno) {
		    echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;

		  
		}
		return $this->mysqli;
	}
}
?>