<!DOCTYPE html>
<?php
	
if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok")
{
		
	//Klassen importieren
	require_once '../class/reservierung_class.php';
	require_once '../class/mitglied_class.php';
	require_once '../class/recht_class.php';
	require_once '../class/sql_class.php';
	require_once '../class/platz_class.php';
	require_once '../class/res_verarbeitung_class.php';
	require_once "../class/exception_class.php";
	require_once "../class/file_exception_class.php";
	require_once '../class/farbzuweisung_class.php';
	
	//Klassen erzeugen
	$sql = new Sql;
	$mitglied = new Mitglied($_SESSION["email"]);
	$rechtid = $mitglied->getFk_Recht_ID();
	$recht = new Recht($rechtid);
	//neues ReservierungenVerarbeiten-Objekt
	$reservierungen = new ReservierungenVerarbeiten();
	
	
	//Mitglied und login �bergeben
	$email = $_SESSION["email"];
	$daten["email"] = $email;
	$daten["login"] = true;
	
	
	//Rechte �bergeben
	//Recht Benutzer ver�ndern
	$benutzerrecht = $recht->getBenutzerVerwalten();
	$daten["benutzerrecht"] = $benutzerrecht;
	$rechtrecht = $recht->getRechteVerteilen();
	$daten["rechtrecht"] = $rechtrecht;
	$platzrecht = $recht->getPlatzVerwalten();
	$daten["platzrecht"] = $platzrecht;
	$farbrecht = $recht->getFarbeFestlegen();
	$daten["farbrecht"] = $farbrecht;
	$allgemeinrecht = $recht->getSaisonFestlegen();
	$daten["allgemeinrecht"] = $allgemeinrecht;
	$serienrecht = $recht->getSerienReservieren();
	$daten["serienrecht"]=$serienrecht;
	
	//Tage im Voraus oder Saison-Ende dem Kallender �bergeben
	$daten["tiv"] = $recht->getTageVoraus();
	$endsai = $sql->call("SELECT SaisonBis FROM tb_zeiten");
	
	$endsait = substr($endsai["SaisonBis"], 8, 2);
	$endsaim = substr($endsai["SaisonBis"], 5, 2);
	$endsaij = substr($endsai["SaisonBis"], 0, 4);
	
	$daten["endsait"] = $endsait;
	$daten["endsaim"] = $endsaim - 1;
	$daten["endsaij"] = $endsaij;
	
}
?>