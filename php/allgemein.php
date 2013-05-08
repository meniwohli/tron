<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('allgemein.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>