<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		//alle Farben übergeben
		$speicher = $sql->arrayCall("SELECT * FROM tb_farben");
		$farben = array();
		
		foreach($speicher as $x)
		{
			$farben[$x['FarbCode']] = $x['FarbName'];
		}
		
		//farbzuweisung auslesen und übergeben
		$speicher = $sql->arrayCall("SELECT f.FarbCode, f.FarbName, fz.Reservierungsart FROM tb_farben as f, 
									tb_farbzuweisung as fz WHERE f.Farbe_ID = fz.fk_Farbe_ID");
		//array durchlaufen und einzelne werte zuweisen
		$farbenaktuell;
		foreach($speicher as $x)
		{
			if($x["Reservierungsart"] == "frei")
			{
				$farbenaktuell[$x["Reservierungsart"]] = $x["FarbCode"];
			}
			
			if($x["Reservierungsart"] == "besetzt")
			{
				$farbenaktuell[$x["Reservierungsart"]] = $x["FarbCode"];
			}
			
			if($x["Reservierungsart"] == "zu")
			{
				$farbenaktuell[$x["Reservierungsart"]] = $x["FarbCode"];
			}
			
			if($x["Reservierungsart"] == "serie")
			{
				$farbenaktuell[$x["Reservierungsart"]] = $x["FarbCode"];
			}
			
			if($x["Reservierungsart"] == "turnier")
			{
				$farbenaktuell[$x["Reservierungsart"]] = $x["FarbCode"];
			}
		}
		
		
		//übergabe
		$daten["farbarray"] = $farben;
		$daten["farbenaktuell"] = $farbenaktuell;
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('farben.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>