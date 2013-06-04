<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
		
		if($rechtrecht) {
		
			//Recht ID's mit POST vergleichen
			$rechte = $sql->arrayCall("SELECT Recht_ID, RechtName FROM tb_recht");
			
			$rechtname = "";
			$rid = true;
			
			foreach($rechte as $x)
			{
				$id = $x["Recht_ID"];
				
				if(isset($_POST["$id"]))
				{
					$rid = $id;
					$rechtname = $x["RechtName"];
				}
			}
			
			if(isset($_POST["bestaetigt"]))
				{
					$sql->change("DELETE FROM tb_Recht WHERE Recht_ID = $rid");
					$daten["geloescht"] = true;
				}
			
			$daten["rechtname"] = $rechtname;
			$daten["rid"] = $rid;
			
			
			
			
			
			
			//auf Template verweisen
			$template = $twig->loadTemplate('rechtloeschen.twig');
			
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