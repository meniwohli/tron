<?php

include 'includeup.php';

if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok")
{
	$template = $twig->loadTemplate('home.twig');
	
}elseif (isset($_POST["email"]))
{
	
	require_once '../class/sql_class.php';
	require_once '../class/mitglied_class.php';
	$sql = new Sql;
	
	
	
	$daten["lala"] = "lala";
	try
	{
		if(!isset($_POST["passwort"]))
		{
			throw new OwnException();
		}
	}
	catch(OwnException $e)
	{
		$e->emptyFill();
		
	}
	
	//daten übergeben
	$user = htmlspecialchars(strtolower($_POST["email"]));
	$passwd = htmlspecialchars(md5($_POST["passwort"]));
			
	$login =  $sql->logTest($user, $passwd);
	
	//Abfrage, ob Benutzer gesperrt ist
	$mitglied = new Mitglied($user);
	$mitglied = $mitglied->getGesperrt();
	
	if($mitglied == 1)
	{
		$_SESSION["gesperrt"] = true;
	}
	
	if($login == 0)
	{
		$_SESSION["pasfalsch"] = true;
	}
	
	if($login == 1 && $mitglied != 1)
	{
		//wenn login = korrekt
		$_SESSION["email"] = $user;
		$_SESSION["login"] = "ok";
		$daten["login"] = 1;	
		
		$template = $twig->loadTemplate('home.twig');
		
	}else{
		
		$template = $twig->loadTemplate('anmelde.twig');
	}
	
}elseif(isset($_SESSION["gesperrt"]) && $_SESSION["gesperrt"] == true)
{
	$daten["sperrfehler"] = 1;
	$template = $twig->loadTemplate('anmelde.twig');
	
	
}else{
	
	$template = $twig->loadTemplate('anmelde.twig');
	
}
	
	
include 'includedown.php';
	
?>