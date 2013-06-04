<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
		
		if ($platzrecht) {
		
		
			//User ID's mit POST vergleichen
			$mitglieder = $sql->arrayCall("SELECT Vorname, Nachname, Mitglied_ID FROM tb_mitglied");
			
			$name = "";
			$uid = true;
			
			foreach($mitglieder as $x)
			{
				$id = $x["Mitglied_ID"];
				
				if(isset($_POST["$id"]))
				{
					$uid = $id;
					$name = $x["Nachname"] . " " . $x["Vorname"];
				}
			}
			
			if(isset($_POST["bestaetigt"]))
				{
					$sql->change("DELETE FROM tb_reservierung WHERE fk_Mitglied_ID = $uid");
					$sql->change("DELETE FROM tb_mitglied WHERE Mitglied_ID = $uid");
					$daten["geloescht"] = true;
				}
			
			$daten["name"] = $name;
			$daten["uid"] = $uid;
			
			
			
			
			
			//auf Template verweisen
			$template = $twig->loadTemplate('benutzerloeschen.twig');
			
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