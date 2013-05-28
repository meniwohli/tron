<!DOCTYPE html>
<?php
	
	/**
	 * Farbeinstellungen der Website
	 * 
	 * regelt die Farbeinstellungen der Website:
	 * Es werden verschiedene Farben für verschiedene Zustände vergeben (z.B. Platz frei, besetzt,...)
	 * 
	 * @author Michael Menhard <m.meni90@gmail.com>
	 * @version 1.0 05.05.2013
	 */

	/**
	 * includeup.php beinhaltet allgemeines über Twig etc.
	 */
	$test = null;

	include "includeup.php";
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		//Farbe einfügen
		if((isset($_POST["farbeneu"]) && $_POST["farbeneu"] != null) && (isset($_POST["farbeneuname"]) && $_POST["farbeneuname"] != null))
		{
			
			$farbeneu = $_POST["farbeneu"];
			$farbeneuname = $_POST["farbeneuname"];
			
			if(strlen($farbeneu) == 7)
			{
				
				if(preg_match("/#[A-Fa-f0-9]{6}/i",$farbeneu))
				{
					//Wenn String Farbcode ist
					$sql->change("INSERT INTO tb_farben (FarbName, FarbCode) VALUES ('$farbeneuname', '$farbeneu')");
					$daten["farbeaufgenommen"] = true;
					
				}else{
					//fehlermeldung erzeugen
					$daten["fehlercode"] = true;
				}
				
			}else{
				$daten["fehlerlaenge"] = true;
			}
		}elseif(isset($_POST["farbeneu"]) || isset($_POST["farbeneuname"])){
			$daten["fehlereingabe"] = true;
		}
		
		
		
		
		//alle Farben übergeben
		/**
		 * @var array Alle Farben aus tb_farben
		 */
		$speicher = $sql->arrayCall("SELECT * FROM tb_farben");
		$farben = array();
		
		
		
		
		foreach($speicher as $x)
		{
			//Farbe löschen
			if(isset($_POST["loeschen"]) && $_POST["loeschen"] == $x["FarbCode"])
			{
				$fc = $x['FarbCode'];
				
				//Reservierungsarten, die vorher diese Farbe hatten, andere Farbe zuweisen
				$farbchange = $sql->call("SELECT Farbe_ID FROM tb_farben WHERE Farbcode = '$fc'");
				$farbchange = $farbchange["Farbe_ID"];
				$farbzuweisungneu = $sql->call("SELECT Farbe_ID FROM tb_farben WHERE Farbcode != '$fc'");
				$farbzuweisungneu = $farbzuweisungneu["Farbe_ID"];
				$sql->change("UPDATE tb_farbzuweisung SET fk_Farbe_ID = $farbzuweisungneu WHERE fk_Farbe_ID = $farbchange");
				
				$sql->change("DELETE FROM tb_farben WHERE FarbCode = '$fc'");
				$daten["farbegeloescht"] = true;
				
			}else{
				$farben[$x['FarbCode']] = $x['FarbName'];
			}
		}
		
		
		
		
		//array durchlaufen und einzelne werte zuweisen
		$farbenaktuell = array();
		
		/**
		* function für farbe auslesen und ändern wenn nötig
		* 
		* @param string Reservierungsart
		*/
		function readwrite($resart)
		{
			global $x, $sql, $farbenaktuell;
			if($x["Reservierungsart"] == "$resart")
			{
				$farbenaktuell[$x["Reservierungsart"]] = $x["FarbCode"];
		
				//neue Farben auslesen/zuweisen - wenn anderer farbcode übergeben wird
				if(isset($_POST["$resart"]) && $_POST["$resart"] != $x["FarbCode"])
				{
						
					$farbzuweisung = new Farbzuweisung("$resart");
					$farbcodeneu = $_POST["$resart"];
					$idneu = $sql->call("SELECT Farbe_ID FROM tb_farben WHERE FarbCode = '$farbcodeneu'");
					$idneu = $idneu["Farbe_ID"];
					$farbzuweisung->setFk_Farbe_ID($idneu);
						
					$farbenaktuell[$x["Reservierungsart"]] = $farbcodeneu;
				}
			}
		}
			
		//farbzuweisung auslesen und übergeben
		$speicher = null;
		$speicher = $sql->arrayCall("SELECT f.FarbCode, f.FarbName, fz.Reservierungsart, f.Farbe_ID FROM tb_farben as f, 
									tb_farbzuweisung as fz WHERE f.Farbe_ID = fz.fk_Farbe_ID");
		$rows = $sql->rows("SELECT f.FarbCode, f.FarbName, fz.Reservierungsart, f.Farbe_ID FROM tb_farben as f, 
									tb_farbzuweisung as fz WHERE f.Farbe_ID = fz.fk_Farbe_ID");
		
		//Prüfen, ob die Abfrage ergolgreich war. Wenn nicht gibt es keine Farben mehr
		if ($rows != 0)
		{
			foreach($speicher as $x)
			{
				//oben definierte funktion readwrite
				readwrite("frei");
				readwrite("besetzt");
				readwrite("zu");
				readwrite("serie");
				readwrite("turnier");
				readwrite("meins");
			}
		}else{
			
			//Setzt eine Fehlermeldung und Initialisiert neue Farben, wenn keine Farben mehr vorhanden.
			$sqltext = "SELECT Farbe_ID, FarbCode FROM tb_farben";
			$x = $sql->call($sqltext);
			$rows = $sql->rows($sqltext);
			$y = $x["FarbCode"];
			$x = $x["Farbe_ID"];
			
			if($rows != 0)
			{
				function setcolor($resart)
				{
					global $x, $y, $sql, $test, $farbenaktuell;
					$test = $x;
					$sql->change("Update tb_farbzuweisung SET fk_Farbe_ID = $x WHERE Reservierungsart = '$resart'");
					$farbenaktuell[$resart] = $y;
					
					
				}
				
				setcolor("frei");
				setcolor("besetzt");
				setcolor("zu");
				setcolor("serie");
				setcolor("turnier");
				setcolor("meins");
				
			}else
			{
				$daten["fehlerleer"] = true;
			}
			
		}
		
		
		//übergabe
		$daten["test"] = $test;
		$daten["farbarray"] = $farben;
		$daten["farbenaktuell"] = $farbenaktuell;
		$daten["wahlfarbe"] = "hallo";
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('farben.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>