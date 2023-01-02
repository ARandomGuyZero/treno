<?php

	include 'database.php';

	if($_SESSION['rol'] != "admin"){

		header("Location: index.php");

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
							
							<a href = "#"> Destinos </a>
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
						<li><a href = "price.php">Precios</a></li>
						<?php

							if ($_SESSION['email'] != null){

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

							<?php

							if ($_GET['idPrecio']>0) {

								echo "<h1>Modificar paquete</h1>";

							}else{

								echo "<h1>Agregar nuevo paquete</h1>";

							}

							?>
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
					<?php

						if ($_GET['idPrecio'] > 0) {

							$consulta = "SELECT * FROM precios WHERE id = " . $_GET['idPrecio'];
							$resultado = mysqli_query($conexion, $consulta);
							$fila = mysqli_fetch_array($resultado);

						}

					?>
					<div class="col-md-6 animate-box">
					<?php

						if($_GET['idPrecio'] > 0){

							echo "<h3>Llena los siguientes cuadros de texto con información para modificar el paquete actual</h3>";

						}else{

							echo "<h3>Llena los siguientes cuadros de texto con información sobre un nuevo paquete.</h3>";

						}

					?>
					
					<form method = "POST">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="destino">Nombre del destino</label>
								<input type="text" name="nombre" class="form-control" value = "<?php if ($_GET['idPrecio']>0) echo $fila['nombre'] ?>" placeholder="Nombre del paquete" required>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="precio">Precio</label>
								<input type="number" name="precio" class="form-control" value = "<?php if ($_GET['idPrecio']>0) echo $fila['precio'] ?>" placeholder="Precio" required>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="destino">Publico destinado</label>
								<input type="text" name="publico" class="form-control" value = "<?php if ($_GET['idPrecio']>0) echo $fila['publico'] ?>" placeholder="Publico destinado" required>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="descripcion">Descripcion</label>
								<textarea name="descripcion" cols="30" rows="4" class="form-control" placeholder="Descripcion del paquete" required><?php if ($_GET['idPrecio']>0) echo $fila['descripcion'] ?></textarea>
							</div>
						</div><h4><center>¿Destacar paquete?</center></h4>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="cbox">Publico destinado</label>
								<input type="checkbox" name="exclusivo" class="form-control" <?php if ($_GET['idPrecio'] > 0 AND $fila['exclusivo'] == 1) echo "checked" ?>>
							</div>
						</div>
						<center>
						<div class="form-group">

							<?php

							if ($_GET['idPrecio'] > 0){

								echo "<input type='submit' name='submit' value='Guardar cambios' class='btn btn-primary'>
								<input type='submit' name='eliminar' value='Eliminar paquete' class='btn btn-primary'>";

							}else{

								echo "<input type='submit' name='submit' value='Agregar nuevo paquete' class='btn btn-primary'>";

							}

							?>
						</div>
						</center>
					</form>

	<?php

	//Guardar paquete
	if(isset($_POST['submit'])){

		$exclusivo = 0;

		if(isset($_POST['exclusivo'])) {

			$exclusivo = 1;

		}

		//Actualizar paquetes
		if(strlen($_GET['idPrecio']) > 0){

			$id = $_GET['idPrecio'];

			$consulta = sprintf("UPDATE precios SET nombre='%s', precio='%s', publico = '%s', descripcion = '%s', exclusivo = '" . $exclusivo . "' WHERE precios.id = $id",
								mysqli_real_escape_string($conexion, $_POST['nombre']),
								mysqli_real_escape_string($conexion, $_POST['precio']),
								mysqli_real_escape_string($conexion, $_POST['publico']),
								mysqli_real_escape_string($conexion, $_POST['descripcion']));

								mysqli_query($conexion, $consulta);

		//Insertar nuevo paquete de precio
		}else{

			$consulta = sprintf("INSERT INTO precios(nombre, precio, publico, descripcion, exclusivo, status) VALUES('%s', '%s', '%s', '%s', '" . $exclusivo . "', 1)",
								mysqli_real_escape_string($conexion, $_POST['nombre']),
								mysqli_real_escape_string($conexion, $_POST['precio']),
								mysqli_real_escape_string($conexion, $_POST['publico']),
								mysqli_real_escape_string($conexion, $_POST['descripcion']));

								mysqli_query($conexion, $consulta);

		}

		header("Location: price.php");

	}

	//Eliminar paquete de precio existente
	if(isset($_POST['eliminar'])){

		$id = $_GET['idPrecio'];

		$consulta = sprintf("UPDATE precios SET status = 2 WHERE precios.id = $id");

		mysqli_query($conexion, $consulta);

		header("Location: price.php");

	}

	?>

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