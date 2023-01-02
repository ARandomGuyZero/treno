<?php

	include 'database.php';

	if($_SESSION['email'] == null){

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

								}else{
								
									echo "<li><a href='contact.php'>Ver mensajes</a></li>";
									echo "<li><a href='price.php'>Ver precios</a></li>";
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
	
	<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_6.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="row row-mt-15em">
						<div class="col-md-12 mt-text animate-box" data-animate-effect="fadeInUp">
							<?php
								if($_SESSION['rol'] != "admin"){
									echo "<h1>Mi perfil </h1>";
								}else{
									echo "<h1>Total de viajes actuales</h1>";
								}
							?>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</header>
	<?php
		if($_SESSION['rol'] != "admin")	{
	?>
	
	<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
					<h2>Aventuras seleccionadas</h2>
					<p>Estos son las rutas que tenemos para ti.</p>
				</div>
			</div>
			<center>
			<?php if ($_SESSION['rol'] == "admin")

				echo "<a href = 'agregar_destino.php'>
					<span class='btn btn-primary'>Agregar nuevo destino</span>
				</a><p>";

			?>
			</center>

			<div class="row form-group" id="destino">

			<?php

                    $destinos = "";
					$destino = '<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="fh5co-card-item">
							<figure>
							<div class="overlay"><i class="ti-plus"></i></div>
							<img src="./images/#imagen#" alt="#imagen#" class="img-responsive">
							</figure>
							<div class="fh5co-text">
							<h2>#destino#, #pais#</h2>
							<p>#id# #descripcion#</p>
							<p>Tipo de paquete: #paquete#</p>
							<p>#fecha#</p>
							</div></div></div>';

					$consulta = "SELECT * FROM viaje WHERE status = 1";
					$resultado = mysqli_query($conexion, $consulta);

					while($fila = mysqli_fetch_array($resultado)) {

						$destinos = $destinos . $destino;
						$destinos = str_replace("#id#", $fila[0], $destinos);
              			$destinos = str_replace("#destino#", $fila[2], $destinos);
              			$destinos = str_replace("#pais#", $fila[3], $destinos);
             			$destinos = str_replace("#descripcion#", $fila[4], $destinos);
              			$destinos = str_replace("#paquete#", $fila[5], $destinos);
              			$destinos = str_replace("#imagen#", $fila[6], $destinos);
              			$destinos = str_replace("#fecha#", $fila[8], $destinos);  

				 	}

				echo $destinos;

				?>
			</div>
		</div>
		<?php
		}else{
		?>
			<div class="gtco-section">
		<div class="gtco-container">
			<div class="row">
			</div>
			<div class="row form-group">
<div class="gtco-section border-bottom">
	<center><h3>Ver viajes actuales</h3></center>
<table border="1" width="70%" align="center">
<thead>	
  <tr>
    <th>Usuario</th>
    <th>Destino</th>
    <th>Descripción</th>
    <th>Paquete elegido</th>
    <th>Fecha</th>
    <th>Cancelar viaje</th>
  </tr>
</thead>
	<?php

        $consulta = "SELECT * FROM viaje WHERE status = 1";
        $resultado = mysqli_query($conexion,$consulta);                                                

        while($fila = mysqli_fetch_array($resultado)) {
    	?>
        <tr>
        	<td><?php echo $fila['usuario']; ?></td>
        	<td><?php echo $fila['destino']; ?></td>
        	<td><?php echo $fila['descripcion']; ?></td>
        	<td><?php echo $fila['paquete']; ?></td>
        	<td><?php echo $fila['fecha']; ?></td>
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
			</div>
		</div>
	<?php
        }

        if(isset($_POST['btnEliminar'])){
						
            $consulta_eliminar=sprintf("UPDATE viaje SET status=2 WHERE id='%s'", mysqli_real_escape_string($conexion, $_POST['id'])); 
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