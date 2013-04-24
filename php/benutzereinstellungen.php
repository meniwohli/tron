<!DOCTYPE html>
<?php

include "includeup.php";
		

		
		//Wenn eingeloggt, weiter..
		if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {


		//Mitglied und Recht abfragen
		$mitglied2 = new Mitglied($_SESSION["email"]);

		
		//alle benutzer übergeben, wenn benutzerrecht = 1
		$changeuser;
		if($benutzerrecht == 1)
		{
			$mitglieder = $sql->arrayCall("SELECT Mitglied_ID, Nachname, Vorname FROM tb_mitglied ORDER BY Nachname");
				
			$arraymitglieder = array();
		
			//Mitgliedernamen als key und email als value übergeben
			foreach($mitglieder as $x)
			{
				$mname = $x["Nachname"] . " " . $x["Vorname"];
				$arraymitglieder[$mname] =  $x["Mitglied_ID"];
				
			}
				
			//übergabe an twig
			$daten["mitglieder"] = $arraymitglieder;
			
			
			
			//wenn ein name übergeben wurde, passende emailadresse in $changeuser schreiben
			foreach($arraymitglieder as $key => $value)
			{
				//$daten["changeuser"] =$_POST["m.meni90@gmail.com"];
				if(isset($_POST["$value"]))
				{
					$y = $sql->call("SELECT EMail FROM tb_mitglied WHERE Mitglied_ID = $value");
					$changeuser = $y["EMail"];
					$daten["changeuser"] = $value;
					
				}elseif(isset($_POST["id"]))
				{
					$z = $_POST["id"];
					$y = $sql->call("SELECT EMail FROM tb_mitglied WHERE Mitglied_ID = $z");
					$changeuser = $y["EMail"];
					$daten["changeuser"] = $_POST["id"];
				}
			}
		}
		
		
		
	
		
		if (isset($_POST["aendern"])) {
		
			$daten["aendern"] = 1;
				
		}
		
		
		//Mitglied erzeugen
		if (isset($changeuser)) {
		
			//$daten["changeuser"] = 1;
			$mitglied = new Mitglied($changeuser);
			
		}else{
			
			$mitglied = new Mitglied($_SESSION["email"]);
		}
		
		
		//Änderungen ausführen und in DB schreiben
		if (isset($_POST['geschlecht']) && $mitglied->getGeschlecht() != $_POST['geschlecht'])
		{
			$mitglied->setGeschlecht(htmlspecialchars($_POST['geschlecht']));
		}
		
		if (isset($_POST['titel']) && $mitglied->getTitel() != $_POST['titel'])
		{
			$mitglied->setTitel(htmlspecialchars($_POST['titel']));
		}
		
		if (isset($_POST['vorname']) && $mitglied->getVorname() != $_POST['vorname'])
		{
			$mitglied->setVorname(htmlspecialchars($_POST['vorname']));
		}
		
		if (isset($_POST['nachname']) && $mitglied->getNachname() != $_POST['nachname'])
		{
			$mitglied->setNachname(htmlspecialchars($_POST['nachname']));
		}
		
		
		//geburtsdatum vergleichen und einfügen
		$datgesamt = null;
		
		if (isset($_POST['geburtstag']) && isset($_POST['geburtsmonat']) && isset($_POST['geburtsjahr']))
		{
			$cgebtag = 0;
			$cgebmon = 0;
			$cgebjah = 0;
			if(($_POST['geburtstag'] > 0) && ($_POST['geburtstag'] < 32))
			{
				$cgebtag = $_POST['geburtstag'];
			}
			 
			if(($_POST['geburtsmonat'] > 0) && ($_POST['geburtsmonat'] < 13))
			{
				$cgebmon = $_POST['geburtsmonat'];
			}
			
			if(($_POST['geburtsjahr'] > 1920))
			{
				$cgebjah = $_POST['geburtsjahr'];
			}
			
			$datgesamt = $cgebjah . "-" . $cgebmon . "-" . $cgebtag;
			
			if(strlen($datgesamt) != 10)
			{
				$datgesamt = null;
			}
		}
		
		if ($datgesamt != null && $mitglied->getGeburtsdatum() != $datgesamt)
		{
			$mitglied->setGeburtsdatum(htmlspecialchars($datgesamt));
		}
		
		
		
		
		if (isset($_POST['plz']) && $mitglied->getPLZ() != $_POST['plz'])
		{
			$mitglied->setPLZ(htmlspecialchars($_POST['plz']));
		}
		
		if (isset($_POST['ort']) && $mitglied->getOrt() != $_POST['ort'])
		{
			$mitglied->setOrt(htmlspecialchars($_POST['ort']));
		}
		
		if (isset($_POST['strasse']) && $mitglied->getStrasse() != $_POST['strasse'])
		{
			$mitglied->setStrasse(htmlspecialchars($_POST['strasse']));
		}
		
		if (isset($_POST['hausnummer']) && $mitglied->getHNr() != $_POST['hausnummer'])
		{
			$mitglied->setHNr(htmlspecialchars($_POST['hausnummer']));
		}
		
	
		if (isset($_POST['useremail']) && $mitglied->getEMail() != $_POST['useremail'])
		{
			$mitglied->setEMail(htmlspecialchars($_POST['useremail']));
		}
		
		if (isset($_POST['telefon']) && $mitglied->getTelefon() != $_POST['telefon'])
		{
			$mitglied->setTelefon(htmlspecialchars($_POST['telefon']));
		}
		
		//Passwörter vergleichen und verschlüsseln
		if(isset($_POST['pas']) && isset($_POST['pasneu']) && isset($_POST['pastest']))
		{

			if($_POST['pasneu'] == $_POST['pastest'] && strlen($_POST['pastest']) >= 6)
			{
				$passwort = md5($_POST['pas']);
				
				//Administrator kann mit seinem Passwort, alle alten Passwörter ersetzen
				if($benutzerrecht == 1)
				{
					$pasalt = $mitglied2->getPasswort();
				}else{
					$pasalt = $mitglied->getPasswort();
				}
				
				//passwort in DB setzen
				if($pasalt == $passwort)
				{
					$pasneu =  md5($_POST['pasneu']);
					$mitglied->setPasswort($pasneu);
				}
			}
		}
			
		if (isset($_POST['gesperrt']) && $_POST['gesperrt'] == "JA")
		{
			$mitglied->setGesperrt(1);
		}elseif(isset($_POST['gesperrt']) && $_POST['gesperrt'] == "NEIN")
		{
			$mitglied->setGesperrt(0);
		}
		
		
		
		//Rechte verarbeiten
		$rechtid = $mitglied->getFk_Recht_ID();
		$urecht = new Recht($rechtid);
		$urecht = $urecht->getRechtName();
		if (isset($_POST['rechtuser']) && $_POST['rechtuser'] != $urecht)
		{
			$namerecht = $_POST['rechtuser'];
			$nummerrecht = $sql->call("SELECT Recht_ID FROM tb_recht WHERE RechtName = '$namerecht'");
			$nummerrecht = $nummerrecht['Recht_ID'];
			$mitglied->setFk_Recht_ID($nummerrecht);
		}
		
		
		
		//array mit standarddaten füllen
		
		//Geburtsdatum verarbeiten
		$gebroh = $mitglied->getGeburtsdatum();
		$gebtag = substr($gebroh, 8, 2);
		$gebmon = substr($gebroh, 5, 2);
		$gebjah = substr($gebroh, 0, 4);
		$daten["geburtstag"] = $gebtag;
		$daten["geburtsmonat"] = $gebmon;
		$daten["geburtsjahr"] = $gebjah;
		
		$daten["geschlecht"] = $mitglied->getGeschlecht();
		$daten["hausnummer"] = $mitglied->getHNr();
		$daten["nachname"] = $mitglied->getNachname();
		$daten["plz"] = $mitglied->getPLZ();
		$daten["ort"] = $mitglied->getOrt();
		$daten["strasse"] = $mitglied->getStrasse();
		$daten["telefon"] = $mitglied->getTelefon();
		$daten["titel"] = $mitglied->getTitel();
		$daten["vorname"] = $mitglied->getVorname();
		$daten["emailuser"] = $mitglied->getEMail();
		$daten["gesperrt"] = $mitglied->getGesperrt();
		$daten["uid"] = $mitglied->getID();
		
		//rechtname des Users übergeben übergeben
		$userrecht = $mitglied->getFk_Recht_ID();
		$userrecht = new Recht($userrecht);
		$userrecht = $userrecht->getRechtName();
		$daten["rechtuser"] = $userrecht;
		
		
		//alle rechte für administrator auslesen
		$rechte = $sql->arrayCall("SELECT Recht_ID FROM tb_recht");
		$rechtliste = array();
		
		foreach($rechte as $x)
		{
			$y = new Recht($x['Recht_ID']);
			$rechtliste[] = $y->getRechtName();
		}
		
		$daten["rechtliste"] = $rechtliste;
		
		
		
		//array füllen
		$daten["email"] = $_SESSION["email"];
		
		//auf Template verweisen
		$template = $twig->loadTemplate('benutzer.twig');
		
		
		//sonst auf anmeldeseite
		}else{
		
			$template = $twig->loadTemplate('anmelde.twig');
		
		}

		include "includedown.php";
?>