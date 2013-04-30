<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	//Wenn eingeloggt, weiter....
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok" && $recht->getRechteVerteilen() == 1) { 
	
		
		//alle Rechte für Dropdown in Array schreiben und eingehenden name abfragen
		$rechtarray = array();
		$cache = $sql->arrayCall("SELECT Recht_ID, RechtName FROM tb_recht");
		$gewaehltesrecht = $recht;

		
		// hallo das ist ein test
		foreach($cache as $x)
		{
			$rechtarray[$x["RechtName"]] = $x["Recht_ID"];
			$rname = $x["RechtName"];
			$rid = $x["Recht_ID"];
			
			if(isset($_POST["rechtnamen"]) && $_POST["rechtnamen"] == $rid)
			{
				$gewaehltesrecht = new Recht($rid);
			}
		}
		
		//Kontrolle, ob änderungen vorgenommen wurden
		// anzahlStunden
		if (isset($_POST['anzh']) && $gewaehltesrecht->getAnzahlStunden() != $_POST['anzh'])
		{
			if($_POST["anzh"] == "unbegrenzt" && $gewaehltesrecht->getAnzahlStunden() != 99)
			{
				$gewaehltesrecht->setAnzahlStunden(99);
				
			}elseif($_POST['anzh'] < 5 && $_POST['anzh'] > 0)
			{
				$gewaehltesrecht->setAnzahlStunden($_POST["anzh"]);
			}
		}
		
		// anzahlPlaetze
		if (isset($_POST['anzp']) && $gewaehltesrecht->getAnzahlPlaetze() != $_POST['anzp'])
		{
			if($_POST["anzp"] == "unbegrenzt" && $gewaehltesrecht->getAnzahlPlaetze() != 99)
			{
				$gewaehltesrecht->setAnzahlPlaetze(99);
			}elseif($_POST['anzp'] < 5 && $_POST['anzp'] > 0)
			{
				$gewaehltesrecht->setAnzahlPlaetze($_POST["anzp"]);
			}
		}
		
		// anzahlReservierungen
		if (isset($_POST['anzr']) && $gewaehltesrecht->getAnzahlReservierungen() != $_POST['anzr'])
		{
			if($_POST["anzr"] == "unbegrenzt" && $gewaehltesrecht->getAnzahlReservierungen() != 99)
			{
				$gewaehltesrecht->setAnzahlReservierungen(99);
			}elseif($_POST['anzr'] < 5 && $_POST['anzr'] > 0)
			{
				$gewaehltesrecht->setAnzahlReservierungen($_POST["anzr"]);
			}
		}
		
		// tageVoraus
		if (isset($_POST['tage']) && $gewaehltesrecht->getTageVoraus() != $_POST['tage'])
		{
			if($_POST["tage"] == "unbegrenzt" && $gewaehltesrecht->getTageVoraus() != 99)
			{
				$gewaehltesrecht->setTageVoraus(99);
			}elseif($_POST['tage'] < 8 && $_POST['tage'] > 0)
			{
				$gewaehltesrecht->setTageVoraus($_POST["tage"]);
			}
		}
		
		
		
		//Daten übergeben
		// Wenn ändern mitgegeben wird, leite weiter auf Rechte ändern
		if(isset($_POST["aendern"]))
		{
			$daten["aendern"] = 1;
		}
		
		$daten["gewaehltesrecht"] = $gewaehltesrecht;
		$daten["rechtarray"] = $rechtarray;
		
		//aktuelles recht übergen:
		$daten["recht"] = $recht->getRechtName();
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('rechte.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>