<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok" && $recht->getRechteVerteilen() == 1) 
	{
				
		
		
		$rechtname = null;
		$anzh = null;
		$anzp = null;
		$anzr = null;
		$tage = null;
		$resloeschen = null;
		$resverschieben = null;
		$benverwalten = null;
		$rechteverteilen = null;
		$platzverwalten = null;
		$saisonfestlegen = null;
		$serienreservieren = null;
		$farbefestlegen = null;
		
		
		//Änderungen ausführen und in DB schreiben
		if (isset($_POST['rechtname']))
		{
			$rechtname = $_POST['rechtname'];
			$rechtname = htmlspecialchars($rechtname);
		
		
			//Anzahl Stunden
			if (isset($_POST['anzh']))
			{
				$anzh = $_POST['anzh'];
			}
			
			//Anzahl Plätze
			if (isset($_POST['anzp']))
			{
				$anzp = $_POST['anzp'];
			}
			
			//Anzahl Reservierungen
			if (isset($_POST['anzr']))
			{
				$anzr = $_POST['anzr'];
			}
			
			//Tage Voraus
			if (isset($_POST['tage']))
			{
				$tage = $_POST['tage'];
			}
		
			//Reservierungen löschen
			if (isset($_POST['resloeschen']))
			{
				$resloeschen = $_POST['resloeschen'];
			}
			
			//Reservierungen verschieben
			if (isset($_POST['resverschieben']))
			{
				$resverschieben = $_POST['resverschieben'];
			}
			
			//Benutzer verwalten
			if (isset($_POST['benverwalten']))
			{
				$benverwalten = $_POST['benverwalten'];
			}
			
			//Rechte verteilen
			if (isset($_POST['rechteverteilen']))
			{
				$rechteverteilen = $_POST['rechteverteilen'];
			}
			
			//Plätze verwalten
			if (isset($_POST['platzverwalten']))
			{
				$platzverwalten = $_POST['platzverwalten'];
			}
			
			//Saison verwalten
			if (isset($_POST['saisonfestlegen']))
			{
				$saisonfestlegen = $_POST['saisonfestlegen'];
			}
			
			//Serien reservieren
			if (isset($_POST['serienreservieren']))
			{
				$serienreservieren = $_POST['serienreservieren'];
			}
			
			//Farben festlegen
			if (isset($_POST['farbefestlegen']))
			{
				$farbefestlegen = $_POST['farbefestlegen'];
			}
		}
		
		
		if($rechtname != null || $rechtname != "")
		{
			
			$sql->change("INSERT INTO tb_recht(RechtName, AnzahlStunden, AnzahlPlaetze, AnzahlReservierungen, TageVoraus, ReservierungLoeschen, ReservierungVerschieben,
						BenutzerVerwalten, RechteVerteilen, PlatzVerwalten, SaisonFestlegen, SerienReservieren, FarbeFestlegen)
						VALUES ('$rechtname', '$anzh', '$anzp', '$anzr', '$tage', '$resloeschen', '$resverschieben', '$benverwalten', '$rechteverteilen', '$platzverwalten', 
						'$saisonfestlegen', '$serienreservieren', '$farbefestlegen')");
			
			
			$daten["angelegt"] = true;
		}
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('rechtanlegen.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
		
	include "includedown.php";
?>