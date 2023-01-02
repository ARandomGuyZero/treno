<?php

	include 'database.php';

    if(isset($_POST['submit'])){    

		$email=$_POST['email'];
        $password=$_POST['password'];
        
        $consulta = sprintf("SELECT * FROM usuario WHERE email = '".$email."'",mysqli_real_escape_string($conexion,$usuario));
        $resultado = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultado) == 0){

            $consulta=sprintf("INSERT INTO usuario(nombre,apellidos,email,password,rol,status) VALUES('%s','%s','%s','%s','usuario','1')",
								mysqli_real_escape_string($conexion, $_POST['name']),
								mysqli_real_escape_string($conexion, $_POST['lastName']),
								mysqli_real_escape_string($conexion, $_POST['email']),
								mysqli_real_escape_string($conexion, $_POST['password']));

            if(mysqli_query($conexion, $consulta)){

            	session_start();

            	$_SESSION['email'] = $email;
            	$_SESSION['nombre'] = $_POST['name'];
            	$_SESSION['rol'] = 'usuario';

            	header("Location: destination.php");

            }
            
        }else{

        	$error = "La cuenta ya existe.";

        }

    }
    
?>

<html>
	<head>
	<meta charset = "utf-8">
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
	
	<title>TRENO</title>
			
		<meta name = "viewport" content = "width=device-width, initial-scale=1">
		<meta name = "description" content = "Free HTML5 Website Template by FreeHTML5.co" />
		<meta name = "keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
		<meta name = "author" content = "FreeHTML5.co" />

	<meta property = "og:title" content = ""/>
	<meta property = "og:image" content = ""/>
	<meta property = "og:url" content = ""/>
	<meta property = "og:site_name" content = ""/>
	<meta property = "og:description" content = ""/>
	<meta name = "twitter:title" content = "" />
	<meta name = "twitter:image" content = "" />
	<meta name = "twitter:url" content = "" />
	<meta name = "twitter:card" content = "" />

	<link href = "https://fonts.googleapis.com/css?family=Lato:300,400,700" rel = "stylesheet">
	
	<link rel = "stylesheet" href = "css/animate.css">
	<link rel = "stylesheet" href = "css/icomoon.css">
	<link rel = "stylesheet" href = "css/themify-icons.css">
	<link rel = "stylesheet" href = "css/bootstrap.css">
	<link rel = "stylesheet" href = "css/magnific-popup.css">
	<link rel = "stylesheet" href = "css/bootstrap-datepicker.min.css">
	<link rel = "stylesheet" href = "css/owl.carousel.min.css">
	<link rel = "stylesheet" href = "css/owl.theme.default.min.css">
	<link rel = "stylesheet" href = "css/style.css">

	<script src = "js/modernizr-2.6.2.min.js"></script>

	</head>
	<body>
		
	<div class = "gtco-loader"></div>

	<nav class = "gtco-nav" role = "navigation">
		<div class = "gtco-container">
			
			<div class = "row">
				<div class = "col-sm-4 col-xs-12">
					<div id = "gtco-logo"><a href = "index.php"> TRENO <em>.</em></a></div>
				</div>
				
				<div class = "col-xs-8 text-right menu-1">
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
								echo "<li><a href='contact.php'>Contactos</a></li>";
								echo "<li><a href='login.php'>Iniciar Sesión</a></li>";
							}
						?>
					</ul>	
				</div>
			</div>			
		</div>
	</nav>

    <header id = "gtco-header" class = "gtco-cover gtco-cover-md" role = "banner" style = "background-image: url(images/img_bg_2.jpg)">
		<div class = "overlay"></div>
		<?php if($_SESSION['email'] == null){
		?>
		<div class = "gtco-container">
			<div class = "row">
				<div class = "col-md-12 col-md-offset-0 text-left">
					<div class = "row row-mt-15em">
						<div class = "col-md-7 mt-text animate-box" data-animate-effect = "fadeInUp">
							<h1>Vive la experiencia de viajar en tren.</h1>	
						</div>
						<div class = "col-md-4 col-md-push-1 animate-box" data-animate-effect = "fadeInRight">
							<div class = "form-wrap">
								<div class = "tab">									
									<div class = "tab-content">
										<div class = "tab-content-inner active" data-content = "signup">
											<h3>Registrate para empezar tu viaje.</h3>
											<form action = "" method="post">

												<div class = "row form-group">
													<div class = "col-md-12">
														<label for = "fullname">Nombre(s)</label>
														<input type = "text" name = "name" id="fullname" class = "form-control" required>
													</div>
												</div>

												<div class = "row form-group">
													<div class = "col-md-12">
														<label for = "fullname">Apellidos</label>
														<input type = "text" name = "lastName" id="fullname" class = "form-control" required>
													</div>
												</div>

												<div class = "row form-group">
													<div class = "col-md-12">
														<label for = "fullname">Correo Electronico</label>
														<input type = "email" name = "email" id="fullname" class = "form-control" required>
													</div>
												</div>

												<div class = "row form-group">
													<div class = "col-md-12">
														<label for = "fullname">Contraseña</label>
														<input type = "password" name = "password" id = "fullname" class = "form-control" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}" title="La contraseña debe de ser 8 a 16 caracteres, debe de contener al menos una letra minúscula, al menos una letra mayúscula, al menos un valor numérico y al menos un simbolo especial(!@#$%^&*=+-_)" required>
													</div>
												</div>
												<div class = "row form-group">
													<div class = "col-md-12">
														<label for = "error"><?php if ($error) echo $error; ?></label>
													</div>
												</div>
												<div class="row form-group">
													<div class="col-md-12">
														<input type="submit" name = "submit" class="btn btn-primary btn-block"  value="Comenzar a viajar"> 
													</div>
												</div>
												<a href="login.php">¿Ya tienes una cuenta?</a>

											</form>

											<div class="error">

                							</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }else{


	$consulta = "SELECT * FROM usuario WHERE email = '1'";
	$resultado = mysqli_query($conexion, $consulta);
	$fila = mysqli_fetch_array($resultado)

		?>
	<div class = "gtco-container">
			<div class = "row">
				<div class = "col-md-12 col-md-offset-0 text-left">
					<div class = "row row-mt-15em">
						<div class = "col-md-7 mt-text animate-box" data-animate-effect = "fadeInUp">

							<?php

								if($_SESSION['rol'] == "admin")
								{
									echo "<h1>Bienvenido, administrador</h1>";
								}else {
									echo "<h1>Bienvenido " . $_SESSION['nombre'] ."</h1>
									<h2>¿Listo para tu siguiente viaje?</h2>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	</header>

	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Los destinos más populares</h2>
					<p>Nuestros clientes quedan satisfechos con nuestros tours, visita estas ciudades.</p>
				</div>
			</div>
			<div class="row">

			<?php

                    $destinos = "";

						if ($_SESSION['rol'] == "admin") {
							
							$destino = '<div class="col-lg-4 col-md-4 col-sm-6">
							<a href = "agregar_destino.php?id=#id#" class="fh5co-card-item">
							<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="./images/#imagen#" alt="#imagen#" class="img-responsive">
							</figure>
							<div class="fh5co-text">
							<h2>#destino#, #pais#</h2>
							<p>#descripcion#</p>
							<p><span class="btn btn-primary">Modificar destino</span></p>
							</div></a></div>';

						} else if ($_SESSION['email'] == null) {

							$destino = '<div class="col-lg-4 col-md-4 col-sm-6">
							<a href = "login.php?id=#id#" class="fh5co-card-item">
							<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="./images/#imagen#" alt="#imagen#" class="img-responsive">
							</figure>
							<div class="fh5co-text">
							<h2>#destino#, #pais#</h2>
							<p>#descripcion#</p>
							<p><span class="btn btn-primary">¡Reserva ya!</span></p>
							</div></a></div>';

						} else {

							$destino = '<div class="col-lg-4 col-md-4 col-sm-6">
							<a href = "price.php?id=#id#" class="fh5co-card-item">
							<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="./images/#imagen#" alt="#imagen#" class="img-responsive">
							</figure>
							<div class="fh5co-text">
							<h2>#destino#, #pais#</h2>
							<p>#descripcion#</p>
							<p><span class="btn btn-primary">¡Reserva ya!</span></p>
							</div></a></div>';

						}

					$consulta = "SELECT * FROM destino WHERE status = 1 ORDER BY total DESC";

					$resultado = mysqli_query($conexion, $consulta);

					for($i = 0; $i < 3; $i++) {

						$fila = mysqli_fetch_array($resultado);

						$destinos = $destinos . $destino;
                    	$destinos = str_replace("#id#", $fila[0], $destinos);
                    	$destinos = str_replace("#destino#", $fila[1], $destinos);
                    	$destinos = str_replace("#pais#", $fila[2], $destinos);
                    	$destinos = str_replace("#descripcion#", $fila[3], $destinos);
                    	$destinos = str_replace("#precio#", $fila[4], $destinos);
                    	$destinos = str_replace("#imagen#", $fila[5], $destinos);

				 	}

				echo $destinos;

				?>
			</div>
		</div>
	</div>

	<div id="gtco-counter" class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading animate-box">
					<h2>Resultados de este año</h2>
					<p>Creamos momentos inolvidables para todas las edades por medio de trenes. TRENO se encarga de tu felicidad.</p>
				</div>
			</div>

			<div class="row">
				
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="<?php echo "196"; ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Destinos</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="97" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Trenes</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="12402" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Viajeros</span>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-center">
						<span class="counter js-counter" data-from="0" data-to="12202" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">Clientes felices</span>

					</div>
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