<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$datum = '2013-05-22';
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		
		$zeit = $sql->call("SELECT * FROM tb_zeiten");
		
		$reservierung = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$datum'");
		
		$mitglied = $sql->arrayCall("SELECT * FROM tb_mitglied");
		
		
		
		
		
		
		
		
		$daten["zeit"]=$zeit;
		$daten["reservierungen"]=$reservierung;
		$daten["mitglieder"]=$mitglied;
		
		
		
		
		
		
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('resformular.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>