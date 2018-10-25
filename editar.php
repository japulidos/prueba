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

	if (empty($_GET["codigo"])) {
		$Codigo = "";
	}
	else{
		$Codigo =$_GET["codigo"];
	}

	$Usuarios->searchById($Codigo);


	if($_REQUEST['BtnNuevo'] == 'Nuevo'){
		$Usuarios->NuevoUsuario(); 	 
	}
	if($_REQUEST['BtnEditar'] == 'Editar'){
		$Usuarios->Editar($Codigo); 	 
	}
	if($_REQUEST['BtnEliminar'] == 'Eliminar'){
		$Usuarios->Eliminar($Codigo); 	 
	}
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
							<li> <a href="Usuario.php">Usuarios </a> </li>
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
				<form class="login100-form validate-form" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
					<div class="form-group row">
						<div class="col-md-2">Identificación</div>
						<div class="col-md-2">Nombre</div>
						<div class="col-md-2">Apellido</div>
						<div class="col-md-2">Mail</div>
						<div class="col-md-3">Foto</div>
						<div class="col-md-1"></div>

			

		  
						<div class="col-md-2"><input class="form-control" type="text" name="identificacion"  value="<?php echo $Usuarios->UsuarioIdentificacion; ?> " required="required"></div> 
						<div class="col-md-2"><input class="form-control" type="text" name="nombre" value="<?php echo $Usuarios->UsuarioNombre; ?>" required="required"></div> 
						<div class="col-md-2"><input class="form-control" type="text" name="apellidos" value="<?php echo $Usuarios->UsuarioApellido; ?>" required="required"></div> 
						<div class="col-md-2"><input class="form-control" type="text" name="email" value="<?php echo $Usuarios->UsuarioEmail; ?>" required="required"></div> 
						<div class="col-md-3"><input class="form-control" type="file" name="imagen" value="" ></div> 
						<div class="col-md-1"><img src="<?php echo "images/".$Usuarios->UsuarioFoto;?>"> </div>


						<div class="col-md-4 col-md-offset-5" ><input type="submit" name="BtnNuevo" value="Nuevo" class="btn btn-success"></div>
						<div class="col-md-4"><input type="submit" name="BtnEditar" value="Editar" class="btn btn-warning"></div>
						<div class="col-md-4 "><input type="submit" name="BtnEliminar" value="Eliminar" class="btn btn-danger"></div>
				 
					</div>
				</form>






			
 
			</div><!-- row -->
		</div><!-- container -->
	</section><!-- intro-section --> 
	
	 
	
	<footer>
		<p class="copyright">
			<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ion-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
		</p>


	</footer>
 
	 
	
</body>
</html>