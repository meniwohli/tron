<!DOCTYPE html>
<?php
	
if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok")
{
		
	//Klassen importieren
	require_once '../class/mitglied_class.php';
	require_once '../class/recht_class.php';
	require_once '../class/sql_class.php';
	require_once '../class/platz_class.php';
	require_once '../class/res_verarbeitung_class.php';
	require_once "../class/exception_class.php";
	
	//Klassen erzeugen
	$sql = new Sql;
	$mitglied = new Mitglied($_SESSION["email"]);
	$rechtid = $mitglied->getFk_Recht_ID();
	$recht = new Recht($rechtid);
	//neues ReservierungenVerarbeiten-Objekt
	$reservierungen = new ReservierungenVerarbeiten();
	
	
	//Mitglied und login übergeben
	$email = $_SESSION["email"];
	$daten["email"] = $email;
	$daten["login"] = true;
	
	
	//Rechte übergeben
	//Recht Benutzer verändern
	$benutzerrecht = $recht->getBenutzerVerwalten();
	$daten["benutzerrecht"] = $benutzerrecht;
	$rechtrecht = $recht->getRechteVerteilen();
	$daten["rechtrecht"] = $rechtrecht;
}
?>