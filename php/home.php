<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	
	$datum = date("Y-m-d");
	$_SESSION["datum"] =$datum;
	$date = $_SESSION["datum"];
	
	
	$colours = Array();
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		$zeit = $sql->call("SELECT * FROM tb_zeiten");
				
		$platz = $sql->arrayCall("SELECT * FROM tb_platz ORDER BY PlatzNr");
		
		$reservierung = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$date'");
		
		$mitglied = $sql->arrayCall("SELECT * FROM tb_mitglied");
		
		$farbzuweisung = $sql->arrayCall("SELECT * FROM tb_farbzuweisung");
		
		$farben = $sql->arrayCall("SELECT * FROM tb_farben");
		
		
		foreach($farbzuweisung as $f)
		{
			$fid = $f['fk_Farbe_ID'];
			$resart = $f['Reservierungsart'];
			$code = $sql->call("SELECT FarbCode FROM tb_farben WHERE Farbe_ID = $fid");
			$code = $code['FarbCode'];
			$colours[$resart] = $code;
		}
		
		
		
		
		
		
		
		
		
		
		$daten["zeit"]=$zeit;
		$daten["platz"]=$platz;
		$daten["reservierungen"]=$reservierung;
		$daten["mitglieder"]=$mitglied;
		$daten["farben"]=$colours;
		$daten["datum"]=$date;
		
		//auf Template verweisen
		$template = $twig->loadTemplate('home.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>