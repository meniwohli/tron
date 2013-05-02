<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		
		$speicher = $sql->arrayCall("SELECT * FROM tb_farben");
		$farben = array();
		
		foreach($speicher as $x)
		{
			$farben[$x['FarbCode']] = $x['FarbName'];
		}
		
		
		
		
		
		
		
		
		
		//übergabe
		$daten["farbarray"] = $farben;
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('farben.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>