<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
		
		
		if(isset($_POST["bearbeitet"]))
		{
			
			
			
			
			
			
			
			
			
			
			$sql->change("");
			$daten["bearbeitet"] = true;
		}
		
		
		
		$rid = $_POST["resbearb"];
		
		$reservierung = $sql->call("SELECT * FROM tb_reservierung WHERE Reservierung_ID = '$rid'");
		
		$zeit = $sql->call("SELECT * FROM tb_zeiten");
			
		$mitglieder = $sql->arrayCall("SELECT * FROM tb_mitglied");
			
		$art = $sql->arrayCall("SELECT * FROM tb_reservierungsart");
		
		
		
		
		
		
		$daten["zeit"]=$zeit;
		$daten["res"]=$reservierung;
		$daten["mitglieder"]=$mitglieder;
		$daten['art']=$art;
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('reservierungbearbeiten.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>