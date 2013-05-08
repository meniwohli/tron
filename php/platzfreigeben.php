<!DOCTYPE html>
<?php

	include "includeup.php";
	
	
	//Wenn eingeloggt und Benutzerrecht weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") 
	{
		
		
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
				$sql->change("UPDATE tb_platz SET Gesperrt = '0' WHERE Platz_ID = '$pid'");
				$sql->change("UPDATE tb_platz SET Kommentar = 'NULL' WHERE Platz_ID = '$pid'");

		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('plaetze.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";

?>