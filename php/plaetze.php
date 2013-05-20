<!DOCTYPE html>
<?php
	
	include "includeup.php";
	
	$ergebnis = array();
	$sql = new Sql;
	$platz;
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
	
		
		if(isset($_POST["neubestaetigt"]))
		{
			$platznr = 'NULL';
			if (isset($_POST['platznr']))
			{
				$platznr = $_POST['platznr'];
			}
			if($platznr >= 1 && $platznr <= 99 && is_int($platznr))
			{
				$sql->change("INSERT INTO `tb_platz` (`PlatzNr`, `Gesperrt`, `Kommentar`) VALUES ('$platznr', '0', 'Null')");
			}
		}
		
		
		$call = "Select * From tb_platz ORDER BY PlatzNr";
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