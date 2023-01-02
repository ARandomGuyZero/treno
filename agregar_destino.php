<?php

	include 'database.php';

	if($_SESSION['rol'] != "admin"){

		header("Location: index.php");

	}

	//Subir info
	if(isset($_POST['submit'])){

		//si existe destino
		if(strlen($_GET['id']) > 0){

			$id = $_GET['id'];

			$consultaPais = "SELECT * FROM paises";
			$resultadoPais = mysqli_query($conexion, $consultaPais);
			$filaPais = mysqli_fetch_array($resultadoPais);

			$consulta = sprintf("UPDATE paises SET totalDestinos = totalDestinos - 1 WHERE paises.nombre = '" . $filaPais['nombre'] . "'");

			mysqli_query($conexion, $consulta);

			//si se edita la imagen
			if($_FILES["uploadfile"]["name"] != null){

				$filename = $_FILES["uploadfile"]["name"];
				$tempname = $_FILES["uploadfile"]["tmp_name"];
				$folder = "./destinos/" . $filename;

				$consulta = "UPDATE destino SET destino='" . $_POST['destino'] . "', pais='" . $_POST['pais'] . "', descripcion='" . $_POST['descripcion'] . "', imagen='" . $filename . "' WHERE destino.id = $id";

				if(mysqli_query($conexion, $consulta)){

						if (move_uploaded_file($tempname, $folder)) {

							echo "<h3> Image uploaded successfully!</h3>";

						} else {

							echo "<h3> Failed to upload image!</h3>";

						}

						$consulta = sprintf("UPDATE paises SET totalDestinos = totalDestinos + 1 WHERE paises.nombre = '" . $_POST['pais'] . "'");

						mysqli_query($conexion, $consulta);

				}

			//si no se edita la imagen
			}else{

				$consulta = "UPDATE destino SET destino = '" . $_POST['destino'] . "', pais = '" . $_POST['pais'] . "', descripcion = '" . $_POST['descripcion'] . "' WHERE destino.id = $id";

				//Cambiar los valores para del total de paises
				if (mysqli_query($conexion, $consulta)){

					$consulta = sprintf("UPDATE paises SET totalDestinos = totalDestinos + 1 WHERE paises.nombre = '" . $_POST['pais'] . "'");

					mysqli_query($conexion, $consulta);

				}

			}

			header("Location: destination.php");

		//si no existe el destino
		}else{

		$filename = $_FILES["uploadfile"]["name"];
		$tempname = $_FILES["uploadfile"]["tmp_name"];
		$folder = "./destinos/" . $filename;

		$consulta = "INSERT INTO `destino` (`id`, `destino`, `pais`, `descripcion`, `status`, `imagen`, `total`) VALUES (NULL, '" . $_POST['destino'] . "', '" . $_POST['pais'] . "', '" . $_POST['descripcion'] . "', '1', '" . $filename . "', '0')";

			if (mysqli_query($conexion, $consulta)){

				if (move_uploaded_file($tempname, $folder)) {

					echo "<h3> Image uploaded successfully!</h3>";

				} else {

					echo "<h3> Failed to upload image!</h3>";

				}

				$consulta = sprintf("UPDATE paises SET totalDestinos = totalDestinos + 1 WHERE paises.nombre = '" . $_POST['pais'] . "'");

				mysqli_query($conexion, $consulta);

			}else{

				echo "Error al subir nuevo destino";

			}

			header("Location: destination.php");
			
		}

	}

	if(isset($_POST['eliminar'])){

		if(strlen($_GET['id']) > 0){

			$id = $_GET['id'];

			$consultaPais = "SELECT * FROM destino WHERE destino.id = $id";
			$resultadoPais = mysqli_query($conexion, $consultaPais);
			$filaPais = mysqli_fetch_array($resultadoPais);

			$consulta = sprintf("UPDATE paises SET totalDestinos = totalDestinos - 1 WHERE paises.nombre = '" . $filaPais['pais'] . "'");

			mysqli_query($conexion, $consulta);

			$consulta = "UPDATE destino SET status = 2 WHERE destino.id = $id";

			mysqli_query($conexion, $consulta);

			$consultaDestino = "SELECT * FROM destino WHERE destino.id = $id";
			$resultadoDestino = mysqli_query($conexion, $consultaDestino);
			$filaDestino = mysqli_fetch_array($resultadoDestino);

			$consulta = sprintf("UPDATE viaje SET status = 2 WHERE viaje.destino = '" . $filaDestino['destino'] . "'");

			mysqli_query($conexion, $consulta);

		}

		header("Location: destination.php");

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
							if($_SESSION['rol'] != "admin"){

								echo "<li><a href='contact.php'>Contactos</a></li>";

							}else{

								echo "<li><a href='contact.php'>Ver mensajes</a></li>";

							}

							if ($_SESSION['email'] != null){

								if($_SESSION['rol'] != "admin"){

									echo "<li><a href='compras.php'>Perfil de " . $_SESSION['nombre'] . "</a></li>";

								}else{

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

							<?php

							if ($_GET['id']>0) {

								echo "<h1>Modificar destino</h1>";

							}else{

								echo "<h1>Agregar nuevo destino</h1>";

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

						if ($_GET['id'] > 0) {

							$consulta = "SELECT * FROM destino WHERE id = " . $_GET['id'];
							$resultado = mysqli_query($conexion, $consulta);
							$fila = mysqli_fetch_array($resultado);

						}

					?>
					<div class="col-md-6 animate-box">
					<?php

						if($_GET['id'] > 0){

							echo "<h3>Llena los siguientes cuadros de texto con información para modificar el destino actual</h3>";

						}else{

							echo "<h3>Llena los siguientes cuadros de texto con información sobre un nuevo destino</h3>";

						}

					?>
					<form method = "POST" enctype="multipart/form-data">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="destino">Nombre del destino</label>
								<input type="text" name="destino" class="form-control" value = "<?php if ($_GET['id']>0) echo $fila['destino'] ?>" placeholder="Nombre del destino" required>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="pais">Pais del destino</label>
								<select name="pais" class="form-control" placeholder="Nombre del pais" required>
								<?php

									$consultaPais = "SELECT * FROM paises";
									$resultadoPais = mysqli_query($conexion, $consultaPais); 
											
									$selectedPais = "<option selected value='#pais#'>#pais#</option>";
									$pais = "<option value='#pais#'>#pais#</option>";
									$paises = "";

									while($filaPais = mysqli_fetch_array($resultadoPais)){

										if($filaPais[2] == $fila['pais']){

											$paises = $paises . $selectedPais;

										}else{

											$paises = $paises . $pais;

										}

										$paises = str_replace("#id#", $filaPais[0], $paises);
										$paises = str_replace("#pais#", $filaPais[2], $paises);

									}

									echo $paises;

								?>
    							</select>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="destino">Nombre del destino</label>
								<textarea name="descripcion" cols="30" rows="4" class="form-control" placeholder="Descripcion del destino" required><?php if ($_GET['id']>0) echo $fila['descripcion'] ?></textarea>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<input class="form-control" type="file" onchange="readURL(this)" name="uploadfile" <?php if ($_GET['id']== 0){echo "required"; } ?>>
							</div>
						</div>

						<div class="form-group">

							<?php

							if ($_GET['id'] > 0){

								echo "<input type='submit' name='submit' value='Modificar destino' class='btn btn-primary'>
								<input type='submit' name='eliminar' value='Eliminar destino' class='btn btn-primary'>";

							}else{

								echo "<input type='submit' name='submit' value='Agregar nuevo destino' class='btn btn-primary'>";

							}

							?>

						</div>
					</form>
				</div>
				<div class="col-md-5 col-md-push-1 animate-box">
					
					<div class="gtco-contact-info">
						<h3>Imagen Actual</h3>
						<ul>

							<?php

								if($_GET['id'] > 0){

									echo "<img id = 'blah' src='./destinos/" . $fila['imagen'] . "' class='img-responsive'>";
							
								}else{

									echo "<img id = 'blah' class='img-responsive'>";

								}

							?>

						</ul>
					</div>
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
<script type="text/javascript">
	
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

</script>