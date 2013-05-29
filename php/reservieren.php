<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$datum = '2013-05-22';
	$colours = Array();
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		$zeit = $sql->call("SELECT * FROM tb_zeiten");
				
		$platz = $sql->arrayCall("SELECT * FROM tb_platz WHERE PlatzNr = 1");
		
		$reservierung = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$datum'");
		
		$mitglied = $sql->arrayCall("SELECT * FROM tb_mitglied");
		
		$farbzuweisung = $sql->arrayCall("SELECT * FROM tb_farbzuweisung");
		
		$farben = $sql->arrayCall("SELECT * FROM tb_farben");
		
		
		foreach($farbzuweisung as $f)
		{
			$abc = $f['fk_Farbe_ID'];
			$resart = $f['Reservierungsart'];
			$code = $sql->call("SELECT FarbCode FROM tb_farben WHERE Farbe_ID = $abc");
			$code = $code['FarbCode'];
			$colours[$resart] = $code;
		}
		
		
		
		
		
		
		
		
		
		
		$daten["zeit"]=$zeit;
		$daten["platz"]=$platz;
		$daten["reservierungen"]=$reservierung;
		$daten["mitglieder"]=$mitglied;
		//$daten['farbzuweisung']=$farbzuweisung;
		//$daten['farben']=$farben;
		$daten["farben"]= $colours;
		
		//auf Template verweisen
		$template = $twig->loadTemplate('reservieren.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>