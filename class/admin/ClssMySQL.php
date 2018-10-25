<?Php
include_once 'psl-config.php';    


class ClssMySQL{
	//Atributos de la clase MySQL
	//Atributos de la clase MySQL
	private $dbhost=HOST;
	private $dbuser=USER;
	private $dbpass=PASSWORD;
	private $db=DATABASE;
	private $conexion;


	//Conexion funcion/Metodo que nos conecta al motor de base de datos
	function Conectar() {
	//Revisamos si la conexion est vacia 
		if(!isset($this->conexion)){
			$this->conexion = (mysqli_connect($this->dbhost,$this->dbuser,$this->dbpass,$this->db)) 
				or die ("ERROR: NO se puede conectar al Gestor de Base de Datos." . mysqli_connect_error($this->conexion));
			//funcion/Metodo para seleccionar la base de datos
		}	
	}
	
	//Consulta funcion/Metodo encargada den ejecutar la sentencia SQL
	//Nos permite ejecutar cualquier consulta y a la ves reutilizar codigo fuente
	public function Consultar($consulta){
		$resultado=mysqli_query($this->conexion, $consulta);
		if (!$resultado){
				echo ' ERROR:' . mysqli_error($this->conexion);
				exit;
			}
		return $resultado;
	}

	//Fect_Array retorna los datos de los select en forma de arreglo/array
	public function AvanzarFila($consulta){
		return mysqli_fetch_array($consulta);
	}
	//Devuelve la cantidad de filas del resultado
	function NumeroFilas($resultado){
		return mysqli_num_rows($resultado);
	}
	function Cerrar(){
		return mysqli_close();
	}

}
?>