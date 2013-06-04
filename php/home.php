<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$pruefen = true;
	
	$datumAktuell = date("d.m.Y");
	
	if (isset($_POST["datum"])) {
		$formatdate = $_POST["datum"];		
	} else {
		$formatdate = $datumAktuell;
	}
	
	
	$tag = substr($formatdate, 0, 2);
	$monat = substr($formatdate, 3, 2);
	$jahr = substr($formatdate, 6, 4);
	
	$date = $jahr . "-" . $monat . "-" . $tag;
	
	$_SESSION["formatdate"] = $formatdate;
	$_SESSION["datum"] = $date;
	
	
	
	
	
	$colours = Array();
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		$zeit = $sql->call("SELECT * FROM tb_zeiten");
				
		$platz = $sql->arrayCall("SELECT * FROM tb_platz ORDER BY PlatzNr");
		
		$reservierung = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$date'");
		
		$mitglieder = $sql->arrayCall("SELECT * FROM tb_mitglied");
		
		$farbzuweisung = $sql->arrayCall("SELECT * FROM tb_farbzuweisung");
		
		$farben = $sql->arrayCall("SELECT * FROM tb_farben");
		
		$art = $sql->arrayCall("SELECT * FROM tb_reservierungsart");
		
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
		$daten["mitglieder"]=$mitglieder;
		$daten["farben"]=$colours;
		$daten["datum"]=$date;
		$daten["formatdate"]=$formatdate;
		$daten["art"]=$art;
		$daten['online']=$mitglied;
		
		//auf Template verweisen
		$template = $twig->loadTemplate('home.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>