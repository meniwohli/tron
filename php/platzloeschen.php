<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") 
	{
		
		if ($platzrecht) {
		
			//Reservierung ID's mit POST vergleichen
			$plaetze = $sql->arrayCall("SELECT Platz_ID FROM tb_platz");
			
			$pid = true;
			
			foreach($plaetze as $p)
			{
				$id = $p["Platz_ID"];
				
				if(isset($_POST["$id"]))
				{
					$pid = $id;
				}
			}
			
			if(isset($_POST["bestaetigt"]))
				{
					$sql->change("DELETE FROM tb_reservierung WHERE fk_Platz_ID = $pid");
					$sql->change("DELETE FROM tb_platz WHERE Platz_ID = $pid");
					$daten["geloescht"] = true;
				}
			
			$daten["pid"] = $pid;
			
			
			
			
			
			//auf Template verweisen
			$template = $twig->loadTemplate('platzloeschen.twig');
			
		//sonst auf home.php
		}else{
			header('Location: home.php');
		}
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";

?>