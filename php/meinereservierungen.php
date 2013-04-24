<!DOCTYPE html>
<?php
	
	include 'includeup.php';

	$result = array();
	$uebergabe = array();
	
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
			$platz = new Platz($reserve->getFk_Platz_ID());
			$uebergabe[] = 'begin';
			$uebergabe[] = $count . '.';
			$uebergabe[] = $reserve->getDatum();
			$uebergabe[] = $reserve->getReservierungVon();
			$uebergabe[] = $reserve->getReservierungBis();
			$uebergabe[] = $platz->getPlatzNr();
			if($benutzerrecht == 1)
			{
				foreach($mitglieder as $m)
				{
					if($m->getID() == $reserve->getFk_Mitglied_ID())
					{
						$uebergabe[] = $m->getVorname() . " " . $m->getNachname();
					}
				}
			}
			
			
			//$uebergabe[] = $reserve->getFk_S1_ID();
			//$uebergabe[] = $reserve->getFk_S2_ID();
			//$uebergabe[] = $reserve->getFk_S3_ID();
			//$uebergabe[] = $reserve->getFk_S4_ID();
			$uebergabe[] = 'end';
			
			$count++;
		}
		
		$daten["reservierungen"]=$uebergabe;
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('meinereservierungen.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
		
	include 'includedown.php';
	

?>