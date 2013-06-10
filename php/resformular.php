<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$date = $_SESSION["datum"];
	$formatdate = $_SESSION["formatdate"];
	$time = $_POST["zeit"];
	$pid = $_POST["pid"];
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {

		
		
		if (isset($_POST["reserviert"])) {
			
			$bis = $_POST["resbis"];
			$von = $_POST["resvon"];
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
			
			$sql->change("INSERT INTO tb_reservierung (fk_Mitglied_ID, fk_Platz_ID, Datum, ReservierungVon, ReservierungBis, fk_Reservierungsart_ID, Kommentar, S1, S2, S3, S4) VALUES ('$fuer', '$pid', '$date', '$von', '$bis', '$resart', '$comment', '$m1', '$m2', '$m3', '$m4')");
				

			
			
			
			
		}
		
			$mitglieder = $sql->arrayCall("SELECT * FROM tb_mitglied");
				
			$art = $sql->arrayCall("SELECT * FROM tb_reservierungsart");
			
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
			
			
			
		
		
		
		
		
		
		
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('resformular.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>
