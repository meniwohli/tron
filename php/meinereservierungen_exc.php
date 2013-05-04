<!DOCTYPE html>
<?php
	
	include 'includeup.php';

	$result = array();
	$uebergabe = array();
	$members = array();
	$plaetze = array();

	try {
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
		
		//Prüft ob BenutzerVerwalten-Recht gegeben und ruft alle Reservierungen auf
		if($benutzerrecht == 1)
		{
			if(!method_exists($reservierungen, 'getAdllRes') or !method_exists($reservierungen, 'getMitgliedMail'))
			{
				throw new BadMethodCallException('Methode existiert nicht');
			}
			else {
				$result = $reservierungen->getAllRes();
				$mitglieder = $reservierungen->getMitgliedMail();
			}
		}
		//ruft nur Reservierungen des aktuellen Benutzers auf
		else
		{
			if(!method_exists($mitglied, 'getID') or !method_exists($reservierungen, 'getResID'))
			{
				throw new BadMethodCallException('Methode existiert nicht');
			}
			else {
				$benID = $mitglied->getID();
				$result = $reservierungen->getResID($benID);
			}
		}
		
		//Variable für fortlaufende Reservierungs-Nummer bei der Ausgabe
		$count = 1;
		
		foreach($result as $reserve)
		{
			if($reserve->getFk_Platz_ID() != null)
			{
			$platz = new Platz($reserve->getFk_Platz_ID());
			$plaetze[] = $platz;
			}
			$uebergabe[] = $reserve;
			
		}
		
		
		if($benutzerrecht == 1)
		{
			foreach($mitglieder as $m)
			{
				$members[] = $m;
				
				/*if($m->getID() == $reserve->getFk_Mitglied_ID())
				{
					$members[] = $m->getVorname() . " " . $m->getNachname();
				}*/
			}
		}
		
		
		$daten["reservierungen"]=$uebergabe;
		$daten["plaetze"]=$plaetze;
		$daten["mitglieder"]=$members;
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('meinereservierungen.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');

		
	}
		
	include 'includedown.php';
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}
	

?>