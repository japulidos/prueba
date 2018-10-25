 <?php
	session_start();
	if (!empty($_SESSION["usuarioId"]))
	{
		
	}
	else {
			//si el usuario no es verificado volvera al formulario de ingreso
			header('Location:index.php');
		}
	//Incluir la clase Usuario
	include ('class/admin/ClssUsuarios.php');
	//Instanciamos en Objeto la Clase Usuario
	$Usuarios = new ClssUsuarios();

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>Prueba</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	
	
	<!-- Font -->
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700%7CAllura" rel="stylesheet">
	
	<!-- Stylesheets -->
	
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.css">
	<link href="css/ionicons.css" rel="stylesheet"> 
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	
</head>
<body>
	 
	
	<section class="intro-section">
		<div class="container">
			<div class="row">
				<div class="col-md-1 col-lg-2"></div>
				<div class="col-md-10 col-lg-8">
					<div class="intro">
						<div class="profile-img"><img src="<?php echo "images/".$_SESSION["usuarioFoto"];?>" alt=""></div>
						<h2><b>Bienvenido</b></h2> 
						<h3><b><? echo $_SESSION["personalNombre"]; ?></b></h3> 
						<ul class="information margin-tb-30">
							<li><b>Identificación : </b><? echo $_SESSION["usuarioIdentificacion"]; ?></li>
							<li><b>Email : </b><? echo $_SESSION["usuarioEmail"]; ?></li>
							<li> <a href="editar.php">Nuevo Usuario</a> </li>
							<li> <a href="class/seguridad/salir.php">Salir</a> </li>
						</ul> 
					</div><!-- intro -->
				</div><!-- col-sm-8 -->
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- intro-section --> 

	<section>
		<div class="container">
			<div class="row"> 

				<?php 
				for ($i=0; $i < sizeof($Usuarios->UsuarioCodigo); $i++) { 
					?>
						<div class="col-md-4">Usuario</div>
						<div class="col-md-4"><input class="form-control" type="text"  disabled="disabled" value="<?php echo $Usuarios->UsuarioNombre1[$i];?>"></div>	
						<div class="col-md-4"> <a href="editar.php?codigo=<?php echo$Usuarios->UsuarioCodigo[$i];?>"> Ver detalle</a></div> 
					<?php
				}
				?>
 
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- intro-section --> 
	
	 
	
	<footer>
		<p class="copyright">
			<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
		</p>


	</footer>
	
	 
	
</body>
</html>