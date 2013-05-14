<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		
		
		//Liest die Öffnungszeiten aus
		$speicher = $sql->call("SELECT * FROM tb_zeiten");
		$zeit["offenVon"] = $speicher["OffenVon"];
		$zeit["offenBis"] = $speicher["OffenBis"];
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$daten["zeit"] = $zeit;
		
		//auf Template verweisen
		$template = $twig->loadTemplate('allgemein.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>