<?php

	$host = htmlspecialchars($_SERVER["HTTP_HOST"]);
	$uri  = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
	
	$extra = "php/LogIn.php";
	header("Location: http://$host$uri/$extra");

?>