<?php

	require_once "sql_class.php";

class Mitglied
{
	public $mitglied_ID;
	public $geschlecht;
	public $titel;
	public $vorname;
	public $nachname;
	public $strasse;
	public $hNr;
	public $plz;
	public $ort;
	public $geburtsdatum;
	public $eMail;
	public $telefon;
	public $passwort;
	public $gesperrt;
	public $fk_Recht_ID;
	public $sql;
	
	/*
		Daten abfragen mit Konstruktor und zuweisen
	*/
	function __construct($user)
	{
		$this->sql= new Sql;
		
		$this->eMail = $user;
		$call = "Select * From tb_mitglied Where EMail = '$user'";
		$call = $this->sql->call($call);
		
		$this->mitglied_ID = $call['Mitglied_ID'];
		$this->geschlecht = $call['Geschlecht'];
		$this->titel = $call['Titel'];
		$this->vorname = $call['Vorname'];
		$this->nachname = $call['Nachname'];
		$this->strasse = $call['Strasse'];
		$this->hNr = $call['HNr'];
		$this->plz = $call['PLZ'];
		$this->ort = $call['Ort'];
		$this->geburtsdatum = $call['Geburtsdatum'];
		$this->eMail = $call['EMail'];
		$this->telefon = $call['Telefon'];
		$this->passwort = $call['Passwort'];
		$this->gesperrt = $call['Gesperrt'];
		$this->fk_Recht_ID = $call['fk_Recht_ID'];
	}
	
	
	/*
		String für setter Methoden generieren
	*/
	public function sqlString($zeile, $daten)
	{
		$return = "UPDATE tb_mitglied SET " .$zeile . "= '" . $daten ."' WHERE Mitglied_ID = " . $this->mitglied_ID;
		return $return;
	}
	
	/*
		getter und setter Methoden für alle Variablen
	*/
	
	public function getID()
	{
		return$this->mitglied_ID;
	}
	
	
	
	
	
	public function getGeschlecht()
	{
		return $this->geschlecht;
			
	}
	
	public function setGeschlecht($daten)
	{
		$this->geschlecht = $daten;
		$update = $this->sqlString("Geschlecht", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getTitel()
	{
		return $this->titel;
			
	}
	
	public function setTitel($daten)
	{
		$this->titel = $daten;
		$update = $this->sqlString("Titel", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getVorname()
	{
		return $this->vorname;
			
	}
	
	public function setVorname($daten)
	{
		$this->vorname = $daten;
		$update = $this->sqlString("Vorname", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getNachname()
	{
		return $this->nachname;
			
	}
	
	public function setNachname($daten)
	{
		$this->nachname = $daten;
		$update = $this->sqlString("Nachname", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getStrasse()
	{
		
		return $this->strasse;
			
	}
	
	public function setStrasse($daten)
	{
		$this->strasse = $daten;
		$update = $this->sqlString("Strasse", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getHNr()
	{
		return $this->hNr;
			
	}
	
	public function setHNr($daten)
	{
		$this->hNr = $daten;
		$update = $this->sqlString("HNr", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getPLZ()
	{
		return $this->plz;
			
	}
	
	public function setPLZ($daten)
	{
		$this->plz = $daten;
		$update = $this->sqlString("PLZ", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getOrt()
	{
		return $this->ort;
			
	}
	
	public function setOrt($daten)
	{
		$this->ort = $daten;
		$update = $this->sqlString("Ort", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getGeburtsdatum()
	{
		return $this->geburtsdatum;
			
	}
	
	public function setGeburtsdatum($daten)
	{
		$this->geburtsdatum = $daten;
		$update = $this->sqlString("Geburtsdatum", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getEMail()
	{
		return $this->eMail;
			
	}
	
	public function setEMail($daten)
	{
		$this->eMail = $daten;
		$update = $this->sqlString("EMail", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getTelefon()
	{
		return $this->telefon;
			
	}
	
	public function setTelefon($daten)
	{
		$this->telefon = $daten;
		$update = $this->sqlString("Telefon", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getPasswort()
	{
		return $this->passwort;
			
	}
	
	public function setPasswort($daten)
	{
		$this->passwort = $daten;
		$update = $this->sqlString("Passwort", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getGesperrt()
	{
		return $this->gesperrt;
			
	}
	
	public function setGesperrt($daten)
	{
		$this->gesperrt = $daten;
		$update = $this->sqlString("Gesperrt", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getFk_Recht_ID()
	{
		return $this->fk_Recht_ID;
			
	}
	
	public function setFk_Recht_ID($daten)
	{
		$this->fk_Recht_ID = $daten;
		$update = $this->sqlString("fk_Recht_ID", $daten);
		$this->sql->change($update);
	}
}