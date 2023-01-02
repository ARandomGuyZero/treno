<?php

	include 'database.php';

	if($_GET['id'] == null OR $_SESSION['rol'] != "usuario"){

		header("Location: index.php");

	}

?>

<!DOCTYPE HTML>
<html>
	<head>
	<title>TRENO</title>

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/modernizr-2.6.2.min.js"></script>
	</head>
	<body>
		
	<div class="gtco-loader"></div>	
	<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">	
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="gtco-logo"><a href="index.php">TRENO<em>.</em></a></div>
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
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">

						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<?php 
							if ($_SESSION['rol'] == "admin") {
								echo "<h1>Editar paquetes disponibles</h1>";
							}else{
								echo "<h1>Elige el mejor plan para ti y tu familia.</h1>";
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
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<?php

					if ($_SESSION['rol'] == "admin"){

						echo "<a href = 'agregar_precio.php'>
						<span class='btn btn-primary'>Agregar nuevo paquete</span>
						</a>";

					}else{

						echo "<h2>Te presentamos los mejores paquetes</h2>";

					}

					?>
				</div>
			</div>
			<div class="row">

			<?php

				$precios = "";

				$precioE = '<div class="col-md-4">
							<div class="price-box popular">
							<div class="popular-text">Exclusivo</div>
					<h2 class="pricing-plan">Paquete<br>#nombre#</h2>
						<div class="price"><sup class="currency">$</sup>#precio#<small>pesos</small></div>
						<p>#publico#</p>
						<hr>
						<ul class="pricing-info">
							<li>#descripcion#</li>
						</ul>';

				$precio = '<div class="col-md-4">
					<div class="price-box">
					<h2 class="pricing-plan">Paquete<br>#nombre#</h2>
						<div class="price"><sup class="currency">$</sup>#precio#<small>pesos</small></div>
						<p>#publico#</p>
						<hr>
						<ul class="pricing-info">
							<li>#descripcion#</li>
						</ul>';

				if ($_SESSION['rol'] == "admin") {
					$precio = $precio . '<a href="agregar_precio.php?idPrecio=#idPrecio#" class="btn btn-default btn-sm">Editar</a>
					</div>
				</div>';
					$precioE = $precioE . '<a href="agregar_precio.php?idPrecio=#idPrecio#" class="btn btn-default btn-sm">Editar</a>
					</div>
				</div>';
				}else{
					$precio = $precio . '<a href="reserva.php?idPrecio=#idPrecio#&idDestino=#idDestino#" class="btn btn-default btn-sm">¡Compra ya!</a>
					</div>
				</div>';
					$precioE = $precioE . '<a href="reserva.php?idPrecio=#idPrecio#&idDestino=#idDestino#" class="btn btn-default btn-sm">¡Compra ya!</a>
					</div>
				</div>';
				}

				$consulta = "SELECT * FROM precios WHERE status = 1";
				$resultado = mysqli_query($conexion, $consulta);

				while($fila = mysqli_fetch_array($resultado)) {

					if($fila[5] == 1){
						
						$precios = $precios . $precioE;

					}else{

						$precios = $precios . $precio;

					}

					$precios = str_replace("#idDestino#", $_GET['id'], $precios);
					$precios = str_replace("#idPrecio#", $fila[0], $precios);
                    $precios = str_replace("#nombre#", $fila[1], $precios);
                    $precios = str_replace("#precio#", $fila[2], $precios);
                    $precios = str_replace("#publico#", $fila[3], $precios);
                    $precios = str_replace("#descripcion#", $fila[4], $precios);
                    $precios = str_replace("#exclusivo#", $fila[5], $precios);

				}

				echo $precios;

			?>

			</div>
		</div>
	</div>

	<?php

	if($_SESSION['rol'] != "admin"){

	?>

	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>Preguntas frecuentes</h2>
					<p>Estas son algunas preguntas que nuestros clientes tienen usualmente antes de realizar una compra.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<ul class="fh5co-faq-list">
						<li class="animate-box">
							<h2>¿Qué es TRENO?</h2>
							<p>Somos una empresa web dedicada a la venta de boletos de Trenes alrededor del mundo.</p>
						</li>
						<li class="animate-box">
							<h2>¿Qué métodos de pagos utilizan?</h2>
							<p>Utilizamos sólo pagos por paypal, así no tenemos contacto con ninguna de sus cuentas bancarias, mejoramos la seguridad para el cliente.</p>
						</li>
						<li class="animate-box">
							<h2>¿Por dónde confirman mi pedido?</h2>
							<p>En su correo electrónico le mandamos su boleto o iniciando sesión en la sección de "Mis compras", usted puede descargar su documento.</p>
						</li>
						<li class="animate-box">
							<h2>¿Cómo podemos contactarnos con TRENO?</h2>
							<p>Al final de cada sección de nuestra página web podrá observar todos nuestras formas de contactarnos.</p>
						</li>
						<li class="animate-box">
							<h2>¿Se puede reembolsar alguna compra?</h2>
							<p>No, por eso son los términos y condiciones, para que el cliente sea puntual con los horarios de la ruta de su respectivo viaje.</p>
						</li>
						<li class="animate-box">
							<h2>¿Qué promociones tienen?</h2>
							<p>Para saber sobre nuestras promociones, necesitas subscribirte con tu correo o registrarte.</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div id="gtco-subscribe">
		<div class="gtco-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>¿Preguntas?</h2>
					<p>Mandanos un mensaje aqui</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form class="form-inline">
							<a href="contact.php">
								<button type="submit" class="btn btn-default btn-block">Mandar mensaje</button>
							</a>
					</form>
				</div>
			</div>
		</div>
	</div>

	<?php

	}

	?>

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
	
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.countTo.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/main.js"></script>

	</body>
</html>
