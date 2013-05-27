<?php

include 'includeup.php';

$host = htmlspecialchars($_SERVER["HTTP_HOST"]);
$uri  = rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
$extra = "home.php";

if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok")
{
	header("Location: http://$host$uri/$extra");
	
}elseif (isset($_POST["email"]))
{
	
	require_once '../class/sql_class.php';
	require_once '../class/mitglied_class.php';
	$sql = new Sql;
	
	
	//daten übergeben
	$user = htmlspecialchars(strtolower($_POST["email"]));
	$passwd = htmlspecialchars(md5($_POST["passwort"]));
			
	$login =  $sql->logTest($user, $passwd);
	
	//Abfrage, ob Benutzer gesperrt ist
	$mitglied = new Mitglied($user);
	$mitglied = $mitglied->getGesperrt();
	
	if($mitglied == 1)
	{
		$daten["sperrfehler"] = true;
	}
	
	if(empty($_POST["email"]))
	{
		$daten["keinemail"] = true;
		
	}elseif($login == 0)
	{
		$daten["pasfalsch"] = true;
	}
	
	if($login == 1 && $mitglied != 1)
	{
		//wenn login = korrekt
		$_SESSION["email"] = $user;
		$_SESSION["login"] = "ok";
		
		include "import.php";	
		
		header("Location: http://$host$uri/$extra");
		
	}else{
		
		$template = $twig->loadTemplate('anmelde.twig');
	}
	
}else{
	
	$template = $twig->loadTemplate('anmelde.twig');
	
}
	
	
include 'includedown.php';
	
?>