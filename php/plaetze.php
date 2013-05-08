<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$ergebnis = array();
	$sql = new Sql;
	$platz;
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	

		
		$call = "Select * From tb_platz";
		$ergebnis = $sql->arrayCall($call);
		
		foreach($ergebnis as $id)
		{
			$platz = new Platz($id['Platz_ID']);
			$plaetze[] = $platz;
		}
		
		
		$daten["plaetze"]=$plaetze;
		
		
		
		
		
		
		
		
		
		
		//auf Template verweisen
		$template = $twig->loadTemplate('plaetze.twig');
		
	//sonst auf anmeldeseite
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
	
	
	include "includedown.php";
?>