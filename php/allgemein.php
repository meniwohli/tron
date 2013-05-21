<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		
		
		//Liest die Öffnungszeiten aus
		$speicher = $sql->call("SELECT * FROM tb_zeiten");
		$zeit["offenVon"] = $speicher["OffenVon"];
		$zeit["offenBis"] = $speicher["OffenBis"];
		$zeit["saisonvon"] = $speicher["SaisonVon"];
		$zeit["saisonbis"] = $speicher["SaisonBis"];
		
		
		
		if(isset($_POST["offenvon"]) && ($_POST["offenvon"] != $speicher["OffenVon"]) )
		{
			$x = $_POST["offenvon"];
			$sql->change("UPDATE tb_zeiten SET OffenVon = $x");
			$zeit["offenVon"] = $_POST["offenvon"];
		}
		
		if(isset($_POST["offenbis"]) && ($_POST["offenbis"] != $speicher["OffenBis"]) )
		{
			$x = $_POST["offenbis"];
			$sql->change("UPDATE tb_zeiten SET OffenBis = $x");
			$zeit["offenBis"] = $_POST["offenbis"];
		}
		
		if(isset($_POST["saisonvon"]) && ($_POST["saisonvon"] != $speicher["SaisonVon"]) )
		{
			$x = $_POST["saisonvon"];
			$sql->change("UPDATE tb_zeiten SET SaisonVon = '$x'");
			$zeit["saisonvon"] = $_POST["saisonvon"];
		}
		
		if(isset($_POST["saisonbis"]) && ($_POST["saisonbis"] != $speicher["SaisonBis"]) )
		{
			$x = $_POST["saisonbis"];
			$sql->change("UPDATE tb_zeiten SET SaisonBis = '$x'");
			$zeit["saisonbis"] = $_POST["saisonbis"];
		}
		
		
		
		
		
		
		
		$daten["zeit"] = $zeit;
		
		//auf Template verweisen
		$template = $twig->loadTemplate('allgemein.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>