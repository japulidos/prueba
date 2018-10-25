<?php

//@created:15-07-2014
//@creator:Jesus Pulido
//@modified:
//Descripcion de la modificación:

//Include de la clase 
include('ClssMySQL.php');

class ClssGeneral{
	//Atributos de la Clase ClssGeneral
	public $MySQL;
	
	

	//__construct encargada de cargar en memoria los datos de los atributos
	public function __construct()
	{


		//Instancia el objeto ClssGeneral
			
		//////////////////////////////
		$this->MySQL = new ClssMySQL();
		$this->MySQL->Conectar();
	}


	
}
?>