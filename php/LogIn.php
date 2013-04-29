<?php
//Session starten
session_start();

//Ordnername generieren..
$host = htmlspecialchars($_SERVER["HTTP_HOST"]);
$uri  = "/tron";


//wenn name übergeben wurde
if (isset($_POST["email"]))
{
	//daten übergeben
	$user = htmlspecialchars(strtolower($_POST["email"]));
	$passwd = htmlspecialchars(md5($_POST["passwort"]));
	
	//Klasse aufrufen, passwort testen
	require_once "../class/sql_class.php";
	require_once "../class/mitglied_class.php";
	require_once "../class/exception_class.php";
	
	$log = new Sql;
	$login =  $log->logTest($user, $passwd);
	
	//Abfrage, ob Benutzer gesperrt ist
	$mitglied = new Mitglied($user);
	$mitglied = $mitglied->getGesperrt();
	
	
}
	
if($login == 1 && $mitglied != 1)
{
		//wenn login = korrekt
	$_SESSION["email"] = $user;
	$_SESSION["login"] = "ok";	
}

if($mitglied == 1)
{
	$_SESSION["gesperrt"] = true;
}

if($login == 0)
{
	$_SESSION["pasfalsch"] = true;
}
	
	
	//auf startseite verweisen..
	header("Location: http://$host$uri");
	
?>
