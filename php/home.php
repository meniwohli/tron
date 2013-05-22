<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		$speicher = $sql->call("SELECT * FROM tb_zeiten");
		/*$zeit["offenVon"] = $speicher["OffenVon"];
		$zeit["offenBis"] = $speicher["OffenBis"];
		$zeit["saisonvon"] = $speicher["SaisonVon"];
		$zeit["saisonbis"] = $speicher["SaisonBis"];*/
		
		$platz = $sql->call("SELECT * FROM tb_platz");
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$daten["zeit"]=$speicher;
		$daten["platz"]=$platz;
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('home.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>