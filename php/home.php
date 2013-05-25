<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$datum = '2013-05-22';
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		$zeit = $sql->call("SELECT * FROM tb_zeiten");
				
		$platz = $sql->arrayCall("SELECT * FROM tb_platz ORDER BY PlatzNr");
		
		$reservierung = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$datum'");
		
		$mitglied = $sql->arrayCall("SELECT * FROM tb_mitglied");
		
		$farbzuweisung = $sql->arrayCall("SELECT * FROM tb_farbzuweisung");
		
		$farben = $sql->arrayCall("SELECT * FROM tb_farben");
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$daten["zeit"]=$zeit;
		$daten["platz"]=$platz;
		$daten["reservierungen"]=$reservierung;
		$daten["mitglieder"]=$mitglied;
		$daten['farbzuweisung']=$farbzuweisung;
		$daten['farben']=$farben;
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('home.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>