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
		$speicher = $sql->arrayCall("SELECT f.FarbCode, f.FarbName, fz.Reservierungsart, f.Farbe_ID FROM tb_farben as f, 
									tb_farbzuweisung as fz WHERE f.Farbe_ID = fz.fk_Farbe_ID");
		//array durchlaufen und einzelne werte zuweisen
		$farbenaktuell;
		$test = false;
		foreach($speicher as $x)
		{
			if($x["Reservierungsart"] == "frei")
			{
				$farbenaktuell[$x["Reservierungsart"]] = $x["FarbCode"];
				
				//neue Farben auslesen/zuweisen
				if(isset($_POST["frei"]) && $_POST["frei"] != $x["FarbCode"])
				{
					$farbzuweisung = new Farbzuweisung("frei");
					
					$farbcodeneu = $_POST["frei"];
					$test = $farbzuweisung;
					//$idneu = $sql->call("SELECT Farbe_ID FROM tb_farben WHERE FarbCode = $farbcodeneu");
					
					//$farbzuweisung->setFk_Farbe_ID(7);
					
				}
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
		$daten["test"] = $test;
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('farben.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>