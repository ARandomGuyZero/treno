<?php

	include 'database.php';

	if($_SESSION['email'] == null AND $_SESSION['rol'] != "admin"){

		header("Location: index.php");

	}

	if(isset(($_POST['submit']))){

		$consulta = sprintf("UPDATE usuario SET nombre = '" . $_POST['nombre'] . "', apellidos = '" . $_POST['apellidos'] . "', email = '" . $_POST['email'] . "', password = '" . $_POST['password'] . "', tarjeta = '" . $_POST['tarjeta'] . "', exp = '" . $_POST['exp'] . "', cvv = '" . $_POST['cvv'] . "' WHERE usuario.email = '" . $_SESSION['email'] . "'");

		if(mysqli_query($conexion, $consulta)){

			header("Location: compras.php");

		}

	}

?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TRENO</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="gtco-loader"></div>
	
	<div id="page">

	
	<!-- <div class="page-inner"> -->
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php">Treno <em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
						<li class = "has-dropdown">
							
							<a href = "destination.php"> Destinos </a>
							<ul class = "dropdown">
								
								<?php

									$consulta = "SELECT * FROM paises";
									$resultado = mysqli_query($conexion, $consulta);

									$pais = "<li><a href = 'destination.php?pais=#pais#'>#pais#</a></li>";
									$paises = "";

									while($fila = mysqli_fetch_array($resultado)){

										if($fila['totalDestinos'] > 0){

											$paises = $paises . $pais;
											$paises = str_replace("#id#", $fila[0], $paises);
											$paises = str_replace("#pais#", $fila[2], $paises);

										}
										
									}

									echo $paises;

								?>

							</ul>
						</li>
						<?php

							if ($_SESSION['email'] != null){

								if($_SESSION['rol'] != "admin"){
								
									echo "<li><a href='contact.php'>Contactos</a></li>";
									echo "<li><a href='compras.php'>Perfil de " . $_SESSION['nombre'] . "</a></li>";

								}else{
								
									echo "<li><a href='contact.php'>Ver mensajes</a></li>";
									echo "<li><a href='price.php'>Ver precios</a></li>";
									echo "<li><a href='compras.php'>Ver pasajeros</a></li>";
									echo "<li><a href='usuarios.php'>Ver usuarios</a></li>";

								}	

								echo "<li><a href='logout.php''>Cerrar Sesion</a></li>";

							}
							else{

								echo "<li><a href='login.php'>Iniciar Sesión</a></li>
								<li><a href='index.php'>Registrarme</a></li>";

							}
						?>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="row row-mt-15em">
						<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1>Editar perfil</h1>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</header>
	
	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box">
						<h3>Llena los siguientes cuadros de texto con información para editar su perfil.</h3>

						<?php

							$consulta = "SELECT * FROM usuario WHERE email = '" . $_SESSION['email'] . "'";
							$resultado = mysqli_query($conexion, $consulta);
							$fila = mysqli_fetch_array($resultado);

						?>
					
					<form method = "POST">
						<div class="row form-group">
							<div class="col-md-12">
								<label>Nombre(s)</label>
								<input type="text" name="nombre" class="form-control" value = "<?php echo $fila['nombre'] ?>" placeholder="Nombre(s)" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>Apellido(s)</label>
								<input type="text" name="apellidos" class="form-control" value = "<?php echo $fila['apellidos'] ?>" placeholder="Apellido(s)" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>Correo electrónico</label>
								<input type="email" name="email" class="form-control" value = "<?php echo $fila['email'] ?>" placeholder="Correo electrónico" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>Contraseña</label>
								<input type="text" name="password" class="form-control" value = "<?php echo $fila['password'] ?>" placeholder="Contraseña" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}" title="La contraseña debe de ser 8 a 16 caracteres, debe de contener al menos una letra minúscula, al menos una letra mayúscula, al menos un valor numérico y al menos un simbolo especial(!@#$%^&*=+-_)" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>Número de tarjeta</label>
								<input type="text" name="tarjeta" class="form-control" value = "<?php echo $fila['tarjeta'] ?>" placeholder="Número de tarjeta" pattern = "[0-9]{16}" title = "Fijate que estas escribiendo los 16 digitos de la tarjeta">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>Año de expiración</label>
								<input type="number" name="exp" class="form-control" value = "<?php $fila['exp'] ?>" placeholder="Año de expiración" pattern = "[0-9]{4}" title = "La longitud del año debe ser 4 (ejemplo: 2030)">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label>CVV</label>
								<input type="number" name="cvv" class="form-control" value = "<?php echo $fila['cvv'] ?>" placeholder="CVV" pattern = "[0-9]{3}" title = "Son 3 digitos los de CVV">
							</div>
						</div>

						<div class="row form-group">
						</div>
						<center>
						<div class="form-group">
							<input type='submit' name='submit' value='Guardar cambios' class='btn btn-primary'>
						</div>
						</center>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="gtco-widget">
						<h3>Acerca de nosotros.</h3>
						<p> Somos una empresa dedicada a la venta de boletos dígitales de trenes turísticos alrededor del mundo.</p>
					</div>
				</div>

				<div class="col-md-2 col-md-push-1">
					<div class="gtco-widget">
						<h3>Empresa 100% mexicana</h3>
					</div>
				</div>

				<div class="col-md-3 col-md-push-1">
					<div class="gtco-widget">
						<h3>Información</h3>
						<ul class="gtco-quick-contact">
							<li><a href="#"><i class="icon-phone"></i> +52 6692236808</a></li>
							<li><a href="#"><i class="icon-mail2"></i> trenomex@gmail.com</a></li>
							<li><a href="#"><i class="icon-chat"></i> Sugerencias</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2022 FIMAZ. All Rights Reserved.</small> 
						<small class="block">Diseñado por  <a href="https://freehtml5.co/" target="_blank">Patricia Amahirany Osuna Sarmiento & Alan Ramos López. <a href="#" target="_blank">Mazatlán, Sinaloa.</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>

				</div>
			</div>
		</div>
	</footer>

	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>

	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>

	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	
	<!-- Datepicker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	

	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>