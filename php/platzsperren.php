<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") 
	{
		
		
		//Reservierung ID's mit POST vergleichen
		$reservierungen = $sql->arrayCall("SELECT Reservierung_ID FROM tb_reservierung");
		
		$rid = true;
		
		foreach($reservierungen as $r)
		{
			$id = $r["Reservierung_ID"];
			
			if(isset($_POST["$id"]))
			{
				$rid = $id;
			}
		}
		
		if(isset($_POST["bestaetigt"]))
			{
				$sql->change("DELETE FROM tb_reservierung WHERE Reservierung_ID = $rid");
				$daten["geloescht"] = true;
			}
		
		$daten["rid"] = $rid;
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('reservierungloeschen.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";

?>