<?php
//@created:04-04-2014
//@creator:Jesus Pulido
//@modified:
//Descripcion de la modificación:

//Función para verificar el usuario
function verificar_usuario()
{
	//continuar una sesion iniciada
	session_start();
	if (!empty($_SESSION["personalCedula"]))
	{
		return true;
	} 
}

?>