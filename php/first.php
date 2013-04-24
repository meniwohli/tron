<!DOCTYPE html>
<?php
	
include 'includeup.php';
	
	//Wenn eingeloggt, weiter..
	if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") { 
		
		
		//Mitglied und Recht abfragen
		$mitglied = new Mitglied($_SESSION["email"]);
		$rechtid = $mitglied->getFk_Recht_ID();
		$recht = new Recht($rechtid);
		
		//rechtname abfragen
		$rechtname = $recht->getRechtName();
		$benutzerrecht = $recht->getBenutzerVerwalten();
		
		//array und session mit rechten füllen
		/*$daten["recht"] = $rechtname;
		$_SESSION["recht"] = $rechtname;*/
		$_SESSION["benutzerrecht"] = $benutzerrecht;
		$daten["email"] = $_SESSION["email"];
		
		$template = $twig->loadTemplate('home.twig');
		
		
	//sonst auf anmeldeseite
	}elseif(isset($_SESSION["gesperrt"]) && $_SESSION["gesperrt"] == true)
	{
		$daten["sperrfehler"] = 1;
		$template = $twig->loadTemplate('anmelde.twig');
		
		
	}else{

		$template = $twig->loadTemplate('anmelde.twig');
		
	}
		
	
include 'includedown.php';

?>