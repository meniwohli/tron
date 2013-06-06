<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
		
		
		if(isset($_POST["bearbeitet"]))
		{
			
			$rid = $_POST["rid"];
			$resvon = $_POST["resvon"];
			$resbis = $_POST["resbis"];
			$reservierer = $_POST["resfuer"];
			$resart = $_POST["art"];
			$comment = $_POST["kommentar"];
			$m1 = $_POST["m1"];
			$m2 = $_POST["m2"];
			$m3 = $_POST["m3"];
			$m4 = $_POST["m4"];
			
			
			$sql->change("UPDATE tb_reservierung SET ReservierungVon = '$resvon', ReservierungBis = '$resbis', fk_Mitglied_ID = '$reservierer', fk_Reservierungsart_ID = '$resart', Kommentar = '$comment', S1 = '$m1', S2 = '$m2', S3 = '$m3', S4 = '$m4' WHERE Reservierung_ID ='$rid'");
			
			header('Location: meinereservierungen.php');
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
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('reservierungbearbeiten.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>