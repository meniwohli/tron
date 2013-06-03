<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$date = $_SESSION["datum"];
	$zeit = $_POST["zeit"];
	$platz = $_POST["pid"];
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		if(isset($_POST["geklickt"])) {
			
		
			$zeit = $sql->call("SELECT * FROM tb_zeiten");
			
			$reservierung = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$date'");
			
			$mitglied = $sql->arrayCall("SELECT * FROM tb_mitglied");
			
			
			
			
			
			
			
			
			$daten["zeit"]=$zeit;
			$daten["datum"]=$date;
			$daten["reservierungen"]=$reservierung;
			$daten["mitglieder"]=$mitglied;
			$daten["platz"]=$platz;
		
		}else{
			header('Location: home.php');
		}
		
		
		
		
		
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('resformular.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>