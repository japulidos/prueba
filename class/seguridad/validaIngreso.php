<?php

@session_start();//Inicio de sesión para guardar todos los datos del usuario	
include ('../admin/ClssGeneral.php');//Incluir la clase general 
$Ingreso = new ClssGeneral();//Instanciamos en Objeto la Clase general

//Obtener datos
 $txt_login=addslashes($_POST["email"]);//Usuario 

$consulta="SELECT * FROM usuarios WHERE usuarioEmail='$txt_login'";//SQL que se almacena la variable consulta
$resultado =  $Ingreso->MySQL->Consultar($consulta);//Metodo para consultar 
if ($Ingreso->MySQL->NumeroFilas($resultado)>0)//Saber si devolvio algun dato la consulta
{

	$fila = $Ingreso->MySQL->AvanzarFila($resultado);//Recorre las fila para conocer los datos


	$_SESSION["usuarioId"]		        = $fila["usuarioId"];//Asignar registros de la consulta a variables de sesión
	$_SESSION["usuarioIdentificacion"]	= $fila["usuarioIdentificacion"];//Asignar registros de la consulta a variables de sesión
	$_SESSION["personalNombre"]	        = $fila["usuarioNombre"];//Asignar registros de la consulta a variables de sesión
	$_SESSION["usuarioApellido"]        = $fila["usuarioApellido"];//Asignar registros de la consulta a variables de sesión
	$_SESSION["usuarioEmail"]	        = $fila["usuarioEmail"];//Asignar registros de la consulta a variables de sesión
	$_SESSION["usuarioFoto"]	        = $fila["usuarioFoto"];//Asignar registros de la consulta a variables de sesión 
  


	 header('Location:../../Usuario.php');//Envielo a la pagina especificada
}
else//Si no cumple la condición muestre el siguiente mensaje
{
		?>
			<script type="text/javascript">
				alert('<?php echo $txt_login ?> no existe en nuestra base de datos, cree una cuenta.');
				window.location.href = '../../index.php'; 
			</script>
		<?php
		exit;
}
?>
