<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") 
	{
		if ($platzrecht) {
		
			//Reservierung ID's mit POST vergleichen
			$plaetze = $sql->arrayCall("SELECT * FROM tb_platz");
			
			$pid = true;
			
			foreach($plaetze as $p)
			{
				$id = $p["Platz_ID"];
				
				if(isset($_POST["$id"]))
				{
					$pid = $id;
				}
			}
			
			if(isset($_POST["allesfreigeben"]))
			{
				foreach($plaetze as $id)
				{
					$pid = $id['Platz_ID'];
					$sql->change("UPDATE tb_platz SET Gesperrt = '0' WHERE Platz_ID = '$pid'");
					$sql->change("UPDATE tb_platz SET Kommentar = 'NULL' WHERE Platz_ID = '$pid'");
				}
			}
			else {
				$sql->change("UPDATE tb_platz SET Gesperrt = '0' WHERE Platz_ID = '$pid'");
				$sql->change("UPDATE tb_platz SET Kommentar = 'NULL' WHERE Platz_ID = '$pid'");
			}
			
			
			
			
			//Aufrufen der plaetze.php
			header('Location: plaetze.php');
			
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