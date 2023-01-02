<?php

	include 'database.php';

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
							<h1>Tu opinión es muy importante.</h1>	
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</header>

	<?php
		if($_SESSION['rol'] != "admin")
	{
	?>

	<div class="gtco-section border-bottom">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6 animate-box">
					<h3>¿Sugerencias?</h3>
					<form method = "POST">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Name</label>
								<input type="text" name="name" class="form-control" value = "<?php echo $_SESSION['nombre'] ?>" placeholder="Tu nombre" required>
							</div>
							
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Email</label>
								<input type="text" name="email" class="form-control" value = "<?php echo $_SESSION['email'] ?>" placeholder="Tu correo electrónico" required>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="subject">Subject</label>
								<input type="text" name="subject" class="form-control" placeholder="Motivo por el que manda este mensaje" required>
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Message</label>
								<textarea name="message" name="message" cols="30" rows="10" class="form-control" placeholder="Escribenos algo" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="submit" value="Send Message" class="btn btn-primary">
						</div>

					</form>

	<?php

	if(isset($_POST['submit'])){

		$conexion = mysqli_connect("localhost", "root", "");
        mysqli_select_db($conexion,"treno");

        if ($conexion == null) {
		
			echo "Error en la conexion";

		}

		$consulta = sprintf("INSERT INTO contacto(nombre, email, tema, texto) VALUES('%s', '%s', '%s', '%s')",
								mysqli_real_escape_string($conexion, $_POST['name']),
								mysqli_real_escape_string($conexion, $_POST['email']),
								mysqli_real_escape_string($conexion, $_POST['subject']),
								mysqli_real_escape_string($conexion, $_POST['message']));

								mysqli_query($conexion, $consulta);

	}
	?>

				</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	}else{
	?>
		<div class="gtco-section border-bottom">
							<center><h3>Ver mensajes</h3></center>
<table border="1" width="50%" align="center">
<thead>	
  <tr>
    <th>Nombre</th>
    <th>Correo electrónico</th>
    <th>Tema del mensaje</th>
    <th>Mensaje</th>
    <th>Acciones</th>
  </tr>
</thead>
	<?php

        $consulta = "SELECT * FROM contacto WHERE status != 2";
        $resultado = mysqli_query($conexion,$consulta);                                                

        while($fila=mysqli_fetch_array($resultado)) {
        ?>
        <tr>
        	<td><?php echo $fila['nombre']; ?></td>
        	<td><?php echo $fila['email']; ?></td>
        	<td><?php echo $fila['tema']; ?></td>
        	<td><?php echo $fila['texto']; ?></td>
        	<td>
        		<form action="" method="POST">
        			<input type="hidden" name="id" value="<?php echo $fila['id']; ?>" />
                    <input type="submit" name="btnEliminar" value="Eliminar">
                </form>
          </td>
    		</tr>
        <?php
        }
	?>  
	</table>
	</div>

	<?php
	}

	if(isset($_POST['btnEliminar'])){
						
            $consulta_eliminar=sprintf("UPDATE contacto SET status=2 WHERE id='%s'", mysqli_real_escape_string($conexion, $_POST['id'])); 
            mysqli_query($conexion,$consulta_eliminar);

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
	<!-- </div> -->

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

<style type="text/css">
td {
  text-align: center;
}
th {
  text-align: center;
}
table {
  border-collapse: collapse;
  width: 50%;
}
</style>