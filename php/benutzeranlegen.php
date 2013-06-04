<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok")	{
		
		if($benutzerrecht) {
		
		
			//alle rechte für administrator auslesen
			$rechte = $sql->arrayCall("SELECT Recht_ID FROM tb_recht");
			$rechtliste = array();
			
			foreach($rechte as $x)
			{
				$y = new Recht($x['Recht_ID']);
				$rechtliste[] = $y->getRechtName();
			}
			
			$daten["rechtliste"] = $rechtliste;
					
			
			
			$geschlecht = null;
			$titel = null;
			$vorname = null;
			$nachname = null;
			$geburtsdatum = null;
			$geburtstag = null;
			$geburtsmonat = null;
			$geburtsjahr = null;
			$plz = null;
			$ort = null;
			$strasse = null;
			$hausnummer = null;
			$useremail = null;
			$telefon = null;
			$rechtid = null;
			$namerecht = null;
			$passwort = null;
			$gesperrt = 0;
			
			
			
			//Änderungen ausführen und in DB schreiben
			if (isset($_POST['geschlecht']))
			{
				$geschlecht = $_POST['geschlecht'];
			}
			
			if (isset($_POST['titel']))
			{
				$titel = $_POST['titel'];
			}
			
			if (isset($_POST['vorname']))
			{
				$vorname = $_POST['vorname'];
			}
			
			if (isset($_POST['nachname']))
			{
				$nachname = $_POST['nachname'];
			}
			
			//kontrolle ob name in datenbank bereits vorhanden ist
			if (isset($_POST['vorname']) && isset($_POST['nachname']))
			{
				$namentest = $nachname . " " . $vorname;
				
				$namentest2 = $sql->ArrayCall("SELECT Nachname, Vorname FROM tb_mitglied");
				
				foreach($namentest2 as $x)
				{
					$y = $x["Nachname"] . " " . $x["Vorname"];
					
					if($namentest == $y)
					{
						$daten["fehleruser"] = 1;
						$nachname = false;
						$vorname = false;
					}
				}
				
			}
			
			
			//geburtsdatum  einfügen
			if (isset($_POST['geburtstag']) && isset($_POST['geburtsmonat']) && isset($_POST['geburtsjahr']))
			{
				if(($_POST['geburtstag'] > 0) && ($_POST['geburtstag'] < 32))
				{
					$geburtstag = $_POST['geburtstag'];
					
				}
			
				if(($_POST['geburtsmonat'] > 0) && ($_POST['geburtsmonat'] < 13))
				{
					$geburtsmonat = $_POST['geburtsmonat'];
				}
					
				if(($_POST['geburtsjahr'] > 1920))
				{
					$geburtsjahr = $_POST['geburtsjahr'];
				}
					
				$geburtsdatum = $geburtsjahr . "-" . $geburtsmonat . "-" . $geburtstag;
					
				if(strlen($geburtsdatum) != 10)
				{
					$geburtsdatum = null;
				}
			}
			
			
			if (isset($_POST['plz']))
			{
				$plz = $_POST['plz'];
			}
			
			if (isset($_POST['ort']))
			{
				$ort = $_POST['ort'];
			}
			
			if (isset($_POST['strasse']))
			{
				$strasse = $_POST['strasse'];
			}
			
			if (isset($_POST['hausnummer']))
			{
				$hausnummer = $_POST['hausnummer'];
			}
			
			if (isset($_POST['useremail']))
			{
				$mailcheck = $_POST['useremail'];
				$mailcheck = $sql->call("SELECT EMail FROM tb_mitglied WHERE EMail = '$mailcheck'");
				if($mailcheck == null)
				{
					$useremail = $_POST['useremail'];
				}else{
					$daten['fehlermail'] = true;
				}
			}
			
			if (isset($_POST['telefon']))
			{
				$telefon = $_POST['telefon'];
			}
			
			
			if (isset($_POST['rechtuser']))
			{
				$namerecht = $_POST['rechtuser'];
				$nummerrecht = $sql->call("SELECT Recht_ID FROM tb_recht WHERE RechtName = '$namerecht'");
				$rechtid = $nummerrecht['Recht_ID'];
			}
			
			
			//Passwörter vergleichen und verschlüsseln
			if(isset($_POST['pas1']) && isset($_POST['pas2']))
			{
				$pastest = $_POST['pas1'];
				if($_POST['pas1'] == $_POST['pas2'] && strlen($pastest) >= 6)
				{
					$passwort = md5($_POST['pas1']);
				}else{
					$daten["fehlerpas"] = true;
				}
					
			}
			
			
			if($vorname == null || $nachname == null || $useremail == null || $rechtid == null || $passwort == null)
			{
				//wenn nicht zum ersten mal bearbeitet wird, fehler weiterleiten
				if(!isset($_POST['first']))
				{
					$daten["fehler"] = true;
				}
				
				$daten["geschlecht"] = $geschlecht;
				$daten["titel"] = $titel;
				$daten["vorname"] = $vorname;
				$daten["nachname"] = $nachname;
				$daten["geburtstag"] = $geburtstag;
				$daten["geburtsmonat"] = $geburtsmonat;
				$daten["geburtsjahr"] = $geburtsjahr;
				$daten["plz"] = $plz;
				$daten["ort"] = $ort;
				$daten["strasse"] = $strasse;
				$daten["hausnummer"] = $hausnummer;
				$daten["useremail"] = $useremail;
				$daten["telefon"] = $telefon;
				$daten["rechtuser"] = $namerecht;
				$daten["gesperrt"] = $gesperrt;
				
			}else{
				$sql->change(" INSERT INTO tb_mitglied(Geschlecht, Titel, Vorname, Nachname, Strasse, HNr, PLZ, Ort, 
							Geburtsdatum, EMail, Telefon, Passwort, Gesperrt, fk_Recht_ID)
							VALUES ('$geschlecht', '$titel', '$vorname', '$nachname', '$strasse', '$hausnummer', '$plz', 
							'$ort', '$geburtsdatum', '$useremail', '$telefon', '$passwort', '$gesperrt', '$rechtid')");
				
				
				$daten["angelegt"] = true;
			}
			
			
			
			
			//auf Template verweisen
			$template = $twig->loadTemplate('benutzeranlegen.twig');

		//sonst auf home.php
		}else{
			header('Location: home.php');
		}
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
		
	include "includedown.php";
?>