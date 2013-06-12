<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {

		
		
			$date = $_SESSION["datum"];
			$formatdate = $_SESSION["formatdate"];
			
			if($serienrecht){
			
				$art = $sql->arrayCall("SELECT * FROM tb_reservierungsart");
				
			} else {
				
				$art = $sql->arrayCall("SELECT * FROM tb_reservierungsart WHERE Reservierungsart != 'Serie'");
				
			}
				
			if (isset($_POST["reserviert"])) {
				
				
				$bis = $_POST["resbis"];
				$von = $_POST["zeit"];
				$pid = $_POST["pid"];
				$resart = $_POST["art"];
				
				if (isset($_POST["kommentar"])) {
					$comment = $_POST["kommentar"];
				} else {
					$comment = '';
				}
				if (isset($_POST["m1"])) {
					$m1 = $_POST["m1"];
				} else {
					$m1 = '';
				}
				if (isset($_POST["m2"])) {
					$m2 = $_POST["m2"];
				} else {
					$m2 = '';
				}
				if (isset($_POST["m3"])) {
					$m3 = $_POST["m3"];
				} else {
					$m2 = '';
				}
				if (isset($_POST["m4"])) {
					$m4 = $_POST["m4"];
				} else {
					$m2 = '';
				}
					
				
				if (isset($_POST["resfuer"]))
				{
					$fuer = $_POST["resfuer"];
				} else {
					$fuer = $mitglied->mitglied_ID;
				}
							
				
				foreach($art as $a) {	
					if($a["Reservierungsart_ID"] == $resart) {
						$reserveArt = $a["Reservierungsart"];
					}		
				}
				
				$nextWeek =7 * 24 * 60 * 60;
				
				if(isset($_POST["datumSerie"]) && $reserveArt == "Serie"){
					$datumSerie = $_POST["datumSerie"];
					$d = $date;
					
					while($d <= $datumSerie){
						
						$sql->change("INSERT INTO tb_reservierung (fk_Mitglied_ID, fk_Platz_ID, Datum, ReservierungVon, ReservierungBis, fk_Reservierungsart_ID, Kommentar, S1, S2, S3, S4) VALUES ('$fuer', '$pid', '$d', '$von', '$bis', '$resart', '$comment', '$m1', '$m2', '$m3', '$m4')");
						$d = date("Y-m-d", strtotime($d)+$nextWeek);
					}
					
					/*for($d = $date; $d <= $datumSerie; date("Y-m-d", strtotime("Y-m-d", $d)+$nextWeek)) {
						$sql->change("INSERT INTO tb_reservierung (fk_Mitglied_ID, fk_Platz_ID, Datum, ReservierungVon, ReservierungBis, fk_Reservierungsart_ID, Kommentar, S1, S2, S3, S4) VALUES ('$fuer', '$pid', '$d', '$von', '$bis', '$resart', '$comment', '$m1', '$m2', '$m3', '$m4')");
					}*/
				} else {
				
					$sql->change("INSERT INTO tb_reservierung (fk_Mitglied_ID, fk_Platz_ID, Datum, ReservierungVon, ReservierungBis, fk_Reservierungsart_ID, Kommentar, S1, S2, S3, S4) VALUES ('$fuer', '$pid', '$date', '$von', '$bis', '$resart', '$comment', '$m1', '$m2', '$m3', '$m4')");
					
				}
				
				$_SESSION["reserviert"]=true;
				
				
				
				
			}
			
			
			if(isset($_POST["geklickt"])) {
				
				if(isset($_POST["zeit"])){
					$time = $_POST["zeit"];
				}
					
				if(isset($_POST["pid"])) {
					$pid = $_POST["pid"];
				}
			
			
				$rechtID = $mitglied->fk_Recht_ID;
			
				$mitglieder = $sql->arrayCall("SELECT * FROM tb_mitglied");
				
				$platz = $sql->call("SELECT * FROM tb_platz WHERE Platz_ID = '$pid'");
			
				$reservierung = $sql->arrayCall("SELECT * FROM tb_reservierung WHERE Datum = '$date' AND fk_Platz_ID = '$pid' AND ReservierungVon > '$time' ORDER BY ReservierungVon");
				
				$zeit = $sql->call("SELECT * FROM tb_zeiten");
								
				
				$daten["zeit"]=$zeit;
				$daten["time"]=$time;
				$daten["datum"]=$date;
				$daten["formatdate"]=$formatdate;
				$daten["reservierungen"]=$reservierung;
				$daten["mitglieder"]=$mitglieder;
				$daten["platz"]=$platz;
				$daten["art"]=$art;
				$daten["online"]=$mitglied;
				$daten["recht"]=$recht;
			
			
			
		
		
		
		
		
		
		
		
		
		
		
		
		
			//auf Template verweisen
			$template = $twig->loadTemplate('resformular.twig');
			
		} else {
			header('Location: home.php');
		}
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>
