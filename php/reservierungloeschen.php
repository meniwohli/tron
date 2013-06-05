<!DOCTYPE html>
<?php

	include "includeup.php";
	
	$reservierung = Array();
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") 
	{
		
		if(isset($_POST["geklickt"])) {
			
			if(isset($_POST["resdelete"])) {
				
				$rid = $_POST["resdelete"];
			
			
				$reservierung = $sql->call("SELECT * FROM tb_reservierung WHERE Reservierung_ID = '$rid'");
			
			}
		
			//Reservierung ID's mit POST vergleichen
			/*$reservierungen = $sql->arrayCall("SELECT Reservierung_ID FROM tb_reservierung");
			
			$rid = true;
			
			foreach($reservierungen as $r)
			{
				$id = $r["Reservierung_ID"];
				
				if(isset($_POST["$id"]))
				{
					$rid = $id;
				}
			}*/
			
			if(isset($_POST["bestaetigt"]))
				{
					$rid = $_POST["res"];
					$sql->change("DELETE FROM tb_reservierung WHERE Reservierung_ID = $rid");
					$daten["geloescht"] = true;
				}
			
			//$daten["rid"] = $rid;
			
			$daten["reservierung"]=$reservierung;
			
		}else{
			header('Location: home.php');
		}	
						
			//auf Template verweisen
			$template = $twig->loadTemplate('reservierungloeschen.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";

?>