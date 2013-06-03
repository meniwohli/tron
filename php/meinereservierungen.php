<!DOCTYPE html>
<?php
	
	include 'includeup.php';

	$result = array();
	$uebergabe = array();
	$members = array();
	$plaetze = array();
	$result;
	$mitglieder;
	
	//Test-Kommentar
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
		
		
		//Prüft ob BenutzerVerwalten-Recht gegeben und ruft alle Reservierungen auf
		if($benutzerrecht == 1)
		{
			$result = $reservierungen->getAllRes();
			$mitglieder = $reservierungen->getMitgliedMail();
		}
		//ruft nur Reservierungen des aktuellen Benutzers auf
		else
		{
			$benID = $mitglied->getID();
			$result = $reservierungen->getResID($benID);
		}
		
		//Variable für fortlaufende Reservierungs-Nummer bei der Ausgabe
		$count = 1;
		
		foreach($result as $reserve)
		{
			$uebergabe[] = $reserve;
		}
		
		$place = $sql->arrayCall("SELECT * FROM tb_platz");
		
		
		if($benutzerrecht == 1)
		{
			foreach($mitglieder as $m)
			{
				$members[] = $m;
			}
		}
		
		
		$daten["reservierungen"]=$uebergabe;
		$daten["mitglieder"]=$members;
		$daten["place"]=$place;
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('meinereservierungen.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
		
	include 'includedown.php';
	

?>