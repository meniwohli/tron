<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$var = 0;
	$diff = 0;
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
		
		if(isset($_POST["bearbeiten"])) {
		
			if(isset($_POST["bearbeitet"]))
			{				
				
				$rid = $_POST["rid"];
				$pid = $_POST["pid"];
				$resvon = $_POST["resvon"];
				$resbis = $_POST["resbis"];
				$date = $_POST["datum"];
				$resart = $_POST["art"];
				$comment = $_POST["kommentar"];
				$m1 = $_POST["m1"];
				$m2 = $_POST["m2"];
				$m3 = $_POST["m3"];
				$m4 = $_POST["m4"];
				
				
				if (isset($_POST["resfuer"]))
				{
					$reservierer = $_POST["resfuer"];
				} else {
					$reservierer = $mitglied->mitglied_ID;
				}
				
				
				$reserve = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$date' AND fk_Platz_ID = '$pid' AND ReservierungVon > '$resvon' ORDER BY ReservierungVon");
				
				foreach($reserve as $res) {
					
					if($resbis > $res['ReservierungVon']) {
						
						$var = 1;
						$daten["doppelt"]=true;
					}
				}
				
				$diff = $resbis - $resvon;
				
				if($diff > $recht->anzahlStunden) {
					$var = 2;
				}
				
				
				if($var == 0) {
					if($resvon < $resbis) {
						
						$sql->change("UPDATE tb_reservierung SET ReservierungVon = '$resvon', ReservierungBis = '$resbis', fk_Mitglied_ID = '$reservierer', fk_Reservierungsart_ID = '$resart', Kommentar = '$comment', S1 = '$m1', S2 = '$m2', S3 = '$m3', S4 = '$m4' WHERE Reservierung_ID ='$rid'");
						
						header('Location: meinereservierungen.php');
						
					} else {
						$daten["resfehler"]=true;
					}
				} elseif($var == 2) {
					$daten["stundenfehler"]=true;
				}
				
				
			}
			
			
			if(isset($_POST["resbearb"])) {
				$rid = $_POST["resbearb"];
			}
			
			$reservierung = $sql->call("SELECT * FROM tb_reservierung WHERE Reservierung_ID = '$rid'");
			
			$zeit = $sql->call("SELECT * FROM tb_zeiten");
				
			$mitglieder = $sql->arrayCall("SELECT * FROM tb_mitglied");
				
			$art = $sql->arrayCall("SELECT * FROM tb_reservierungsart");
			
			
			
			
			
			
			$daten["zeit"]=$zeit;
			$daten["res"]=$reservierung;
			$daten["mitglieder"]=$mitglieder;
			$daten['art']=$art;
			$daten['stunden']=$recht->anzahlStunden;
			
			
			
			
			//auf Template verweisen
			$template = $twig->loadTemplate('reservierungbearbeiten.twig');
			
		} else {
			
			header('Location: home.php');
			
		}
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>