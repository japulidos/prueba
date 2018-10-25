<?php
error_reporting(0);
//Include de la clase 
include('ClssMySQL.php');

class ClssUsuarios{
	//Atributos de la Clase ClssGeneral
	public $MySQL;
	
	

	//__construct encargada de cargar en memoria los datos de los atributos
	public function __construct()
	{


		$this->Dato1    = $_REQUEST['identificacion'];
		$this->Dato2          = $_REQUEST['nombre'];
		$this->Dato3          = $_REQUEST['apellidos'];
		$this->Dato4          = $_REQUEST['email'];   
		

		//Instancia el objeto ClssGeneral
			
		//////////////////////////////
		$this->MySQL = new ClssMySQL();
		$this->MySQL->Conectar();


		$sql="SELECT * FROM usuarios   ORDER BY  usuarioNombre ASC";
		$consulta = $this->MySQL->Consultar($sql);
		while($resultado = $this->MySQL->AvanzarFila($consulta)){ 
			$this->UsuarioCodigo[] = $resultado['usuarioId'];
			$this->UsuarioNombre1[] = $resultado['usuarioNombre']; 
		}
	}

	public function searchById($codigo)
	{
		$sql="SELECT * FROM usuarios  WHERE usuarioId='$codigo' LIMIT 1";
		$consulta = $this->MySQL->Consultar($sql);
		while($resultado = $this->MySQL->AvanzarFila($consulta)){ 
			$this->UsuarioCodigo     = $resultado['usuarioId'];
			$this->UsuarioIdentificacion   = $resultado['usuarioIdentificacion']; 
			$this->UsuarioNombre   = $resultado['usuarioNombre']; 
			$this->UsuarioApellido = $resultado['usuarioApellido']; 
			$this->UsuarioEmail    = $resultado['usuarioEmail']; 
			$this->UsuarioFoto     = $resultado['usuarioFoto']; 
		}
	}

	public function verificar_usuario()
		{
			//continuar una sesion iniciada
			session_start();
			if (!empty($_SESSION["personalCedula"]))
			{
				return true;
			}
		}

	public function CrearAfuera()
	{ 
		if ($this->Nuevo()==true) {
			$this->Sesion($this->Dato4);
		}
		
	}
	public function NuevoUsuario()
	{ 
		if ($this->Nuevo()==true) {
			?>
				<script type="text/javascript"> 
				window.location.href = 'Usuario.php'; 
				</script>
			<?php 
		}
		
	}
	public function Sesion($emailUser){
		@session_start();//Inicio de sesión para guardar todos los datos del usuario	

		//Obtener datos
		 $txt_login=addslashes($emailUser);//Usuario 

		$consulta="SELECT * FROM usuarios WHERE usuarioEmail='$txt_login'";//SQL que se almacena la variable consulta
		$resultado =  $this->MySQL->Consultar($consulta);//Metodo para consultar 
		if ($this->MySQL->NumeroFilas($resultado)>0)//Saber si devolvio algun dato la consulta
		{

			$fila = $this->MySQL->AvanzarFila($resultado);//Recorre las fila para conocer los datos

			$_SESSION["personalId"]		        = $fila["usuarioId"];//Asignar registros de la consulta a variables de sesión
			$_SESSION["usuarioIdentificacion"]	= $fila["usuarioIdentificacion"];//Asignar registros de la consulta a variables de sesión
			$_SESSION["personalNombre"]	        = $fila["usuarioNombre"];//Asignar registros de la consulta a variables de sesión
			$_SESSION["usuarioApellido"]        = $fila["usuarioApellido"];//Asignar registros de la consulta a variables de sesión
			$_SESSION["usuarioEmail"]	        = $fila["usuarioEmail"];//Asignar registros de la consulta a variables de sesión
			$_SESSION["usuarioFoto"]	        = $fila["usuarioFoto"];//Asignar registros de la consulta a variables de sesión 


			 header('Location:Usuario.php');//Envielo a la pagina especificada
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
	}

	public function Editar($codigo){
		if (!empty($this->Dato1) && !empty($this->Dato2)  && !empty($this->Dato3) && !empty($this->Dato4)) {


			//Buscamos los datos 
			$this->searchById($codigo);	

			if (trim($this->Dato1)==trim($this->UsuarioIdentificacion)) {
				$this->Dato1==$this->UsuarioIdentificacion;
				$this->ExisteIdentificacion = ""; 
			}
			else{
				$this->Dato1==$this->Dato1;
				$sql="SELECT  usuarioIdentificacion FROM usuarios WHERE usuarioIdentificacion = '$this->Dato1'";
				$consulta = $this->MySQL->Consultar($sql);
				while($resultado = $this->MySQL->AvanzarFila($consulta)){ 
					$this->ExisteIdentificacion = $resultado['usuarioIdentificacion'];;
				} 
			}
			if (trim($this->Dato4)==trim($this->UsuarioEmail)) {
				$this->Dato4==$this->UsuarioEmail;
				$this->ExisteMail = "";
			}
			else{
				$this->Dato4==$this->Dato4;
				$sql="SELECT  usuarioEmail FROM usuarios WHERE usuarioEmail = '$this->Dato4'";
				$consulta = $this->MySQL->Consultar($sql);
				while($resultado = $this->MySQL->AvanzarFila($consulta)){ 
					$this->ExisteMail = $resultado['usuarioEmail'];;
				}
			} 


			 ////Si el campo archivo no está vacío 
            if (!empty($_FILES['imagen']['name'])) 
            { 
                $ruta="images/";
				$archivo=$_FILES['imagen']['tmp_name'];
				$nom_archivo=$_FILES['imagen']['name'];
				$ext=  pathinfo($nom_archivo); 
				$subir = move_uploaded_file($archivo,$ruta."/".trim($this->Dato1).".".$ext['extension']);
				
				$this->Dato5    = trim($this->Dato1).".".$ext['extension'];
            } 
            else{                  

                $this->Dato5    =  $this->UsuarioFoto;
            }


			if (empty($this->ExisteIdentificacion)) {
					if (empty($this->ExisteMail)) {


						$sql="UPDATE usuarios
									SET
										usuarioIdentificacion = '$this->Dato1',
										usuarioNombre         = '$this->Dato2',
										usuarioApellido       = '$this->Dato3',
										usuarioEmail          = '$this->Dato4',
										usuarioFoto           = '$this->Dato5'
									WHERE usuarioId           = '$codigo'
								"; 
						$consulta = $this->MySQL->Consultar($sql);
							?>
								<script type="text/javascript">
									alert('Cuenta actualizada exitosamente'); 
								</script>
							<?php 

						$this->searchById($codigo);

						return true;
					}
					else{
						?>
							<script type="text/javascript">
								alert('Ya existe el email <?php echo $this->ExisteMail ?>'); 
							</script>
						<?php 
						return false;
					}
			}
			else{
				?>
					<script type="text/javascript">
						alert('Ya existe la identificacion <?php echo $this->ExisteIdentificacion ?>'); 
					</script>
				<?php 
				return false;
			}

		}
		else{
				
				?>
					<script type="text/javascript">
						alert('Ingrese todos los datos'); 
					</script>
				<?php
				return false;
		}
	}
	public function Nuevo(){


		if (!empty($this->Dato1) && !empty($this->Dato2)  && !empty($this->Dato3) && !empty($this->Dato4)) {



			$ruta="images/";
			$archivo=$_FILES['imagen']['tmp_name'];
			$nom_archivo=$_FILES['imagen']['name'];
			$ext=  pathinfo($nom_archivo); 
			$subir = move_uploaded_file($archivo,$ruta."/".trim($this->Dato1).".".$ext['extension']);
			
			$this->Dato5    = $this->Dato1.".".$ext['extension'];

			$sql="SELECT  MAX(usuarioId) AS maximo FROM usuarios";
			$consulta = $this->MySQL->Consultar($sql);
			while($resultado = $this->MySQL->AvanzarFila($consulta)){ 
				$this->UsuarioCodigo = $resultado['maximo']+1;;
			}

			$sql="SELECT  usuarioIdentificacion FROM usuarios WHERE usuarioIdentificacion = '$this->Dato1'";
			$consulta = $this->MySQL->Consultar($sql);
			while($resultado = $this->MySQL->AvanzarFila($consulta)){ 
				$this->ExisteIdentificacion = $resultado['usuarioIdentificacion'];;
			}

			$sql="SELECT  usuarioEmail FROM usuarios WHERE usuarioEmail = '$this->Dato4'";
			$consulta = $this->MySQL->Consultar($sql);
			while($resultado = $this->MySQL->AvanzarFila($consulta)){ 
				$this->ExisteMail = $resultado['usuarioEmail'];;
			}
			$this->Dato1 = trim($this->Dato1);

			if (empty($this->ExisteIdentificacion)) {
					if (empty($this->ExisteMail)) {
						$sql="INSERT INTO usuarios 
								VALUES
									   (
										   	'$this->UsuarioCodigo',
										   	'$this->Dato1',
										   	'$this->Dato2',
										   	'$this->Dato3',
										   	'$this->Dato4',
										   	'$this->Dato5'
									   	)
							";
						$consulta = $this->MySQL->Consultar($sql);
							?>
								<script type="text/javascript">
									alert('Cuenta creada exitosamente'); 
								</script>
							<?php 
						return true;
					}
					else{
						?>
							<script type="text/javascript">
								alert('Ya existe el email <?php echo $this->ExisteMail ?>'); 
							</script>
						<?php 
						return false;
					}
			}
			else{
				?>
					<script type="text/javascript">
						alert('Ya existe la identificacion <?php echo $this->ExisteIdentificacion ?>'); 
					</script>
				<?php 
				return false;
			}

			
		}
		else{
				
				?>
					<script type="text/javascript">
						alert('Ingrese todos los datos'); 
					</script>
				<?php
				return false;
		}
	}
	
	public function Eliminar($codigo){
			
		$sql=" DELETE FROM usuarios WHERE usuarioId = '$codigo' LIMIT 1";
		
		$consulta = $this->MySQL->Consultar($sql);
		?>
			<script type="text/javascript">
				alert('Registro eliminado'); 
				window.location.href = 'Usuario.php'; 
			</script>
		<?php  
 
	}

	
}
?>