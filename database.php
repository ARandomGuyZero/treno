<?php

	$error = "";

	ob_start();

	error_reporting(0);

	session_start();

		$conexion=mysqli_connect("localhost", "root", "");
		
        mysqli_select_db($conexion,"treno");

        if ($conexion == null) {
		
			echo "Error en la conexion";

		}

?>