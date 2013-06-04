<!DOCTYPE html>
<?php
	
	include 'includeup.php';
	
	$formatdate = date("d.m.Y");
	$mem;
	$alleDatum = Array();
	
	$tag = substr($formatdate, 0, 2);
	$monat = substr($formatdate, 3, 2);
	$jahr = substr($formatdate, 6, 4);
	
	$datumAktuell = $jahr . "-" . $monat . "-" . $tag;
	
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
		
		
		//Prüft ob BenutzerVerwalten-Recht gegeben und ruft alle Reservierungen auf
		if($benutzerrecht == 1)
		{
			$res = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum >= '$datumAktuell'");
			$mem = $sql->arrayCall("SELECT * FROM tb_mitglied");
		}
		//ruft nur Reservierungen des aktuellen Benutzers auf
		else
		{
			$benID = $mitglied->getID();
			$res = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE fk_Mitglied_ID = '$benID' AND Datum >= '$datumAktuell'");
		}
		
		$platz = $sql->arrayCall("SELECT * FROM tb_platz");
		
		foreach($res as $r)
		{
			$date = $r['Datum'];
			
			$tag = substr($date, 8, 2);
			$monat = substr($date, 5, 2);
			$jahr = substr($date, 0, 4);
			
			$datumFormatiert = $tag . "." . $monat . "." . $jahr;
			
			$alleDatum[$date] = $datumFormatiert;
		
		}
		
		
		
		$daten["reservierungen"]=$res;
		$daten["mitglieder"]=$mem;
		$daten["platz"]=$platz;
		$daten["date"]=$alleDatum;
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('meinereservierungen.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
		
	include 'includedown.php';
	

?>