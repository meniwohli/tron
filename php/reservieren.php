<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$date = $_SESSION["datum"];
	$formatdate = $_SESSION["formatdate"];
	$colours = Array();
	
	
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
		
		if(isset($_POST["geklickt"])) {
			
			$pid = $_POST["pid"];
		
			$zeit = $sql->call("SELECT * FROM tb_zeiten");
					
			$platz = $sql->arrayCall("SELECT * FROM tb_platz WHERE Platz_ID = '$pid'");
			
			$reservierung = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$date'");
			
			$mitglied = $sql->arrayCall("SELECT * FROM tb_mitglied");
			
			$farbzuweisung = $sql->arrayCall("SELECT * FROM tb_farbzuweisung");
			
			$farben = $sql->arrayCall("SELECT * FROM tb_farben");
			
			
			foreach($farbzuweisung as $f)
			{
				$abc = $f['fk_Farbe_ID'];
				$resart = $f['Reservierungsart'];
				$code = $sql->call("SELECT FarbCode FROM tb_farben WHERE Farbe_ID = $abc");
				$code = $code['FarbCode'];
				$colours[$resart] = $code;
			}
			
			
			
			
			
			
			
			$daten["zeit"]=$zeit;
			$daten["platz"]=$platz;
			$daten["reservierungen"]=$reservierung;
			$daten["mitglieder"]=$mitglied;
			$daten["farben"]= $colours;
			$daten["datum"]=$date;
			$daten["formatdate"]=$formatdate;
			
			//auf Template verweisen
			$template = $twig->loadTemplate('reservieren.twig');
		
		}else{
			header('Location: home.php');
		}
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>