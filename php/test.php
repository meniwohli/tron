<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
		
		
$testArray = Array();
			
$testArray[] = 1;
$testArray[] = 2;
$testArray[] = 3;
			
$daten["test"] = $testArray;
			
$template = $twig->loadTemplate('test.twig');
			
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";

?>