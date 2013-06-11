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
			$von = $_POST["datumVon"];
			$bis = $_POST["datumBis"];
			
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
					$grund = 'NULL';
					if (isset($_POST['grund']))
					{
						$grund = $_POST['grund'];
					}
					
					if($grund != NULL)
					{
						if(isset($_POST["allessperren"]))
						{
													
							foreach($plaetze as $id)
							{
								$pid = $id['Platz_ID'];
								$sql->change("UPDATE tb_platz SET Gesperrt = '1' WHERE Platz_ID = '$pid'");
								$sql->change("UPDATE tb_platz SET Kommentar = '$grund' WHERE Platz_ID = '$pid'");
							}
						}
						else {
						
							$sql->change("UPDATE tb_platz SET Gesperrt = '1' WHERE Platz_ID = '$pid'");
							$sql->change("UPDATE tb_platz SET Kommentar = '$grund' WHERE Platz_ID = '$pid'");
							
						}
						$daten["gesperrt"] = true;
						
						//Aufrufen der plaetze.php
						header('Location: plaetze.php');
					}
					
					
				}
			
			$daten["pid"] = $pid;
			
			if(isset($_POST["allessperren"]))
			{
				$template = $twig->loadTemplate('allessperren.twig');
			}
			else {
				//auf Template verweisen
				$template = $twig->loadTemplate('platzsperren.twig');
			}
		
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