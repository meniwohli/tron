<?php

	require_once "sql_class.php";

class Recht
{
	public $recht_ID;
	public $rechtName;
	public $anzahlStunden;
	public $anzahlPlaetze;
	public $anzahlReservierungen;
	public $tageVoraus;
	public $reservierungLoeschen;
	public $reservierungVerschieben;
	public $benutzerVerwalten;
	public $rechteVerteilen;
	public $platzVerwalten;
	public $saisonFestlegen;
	public $serienReservieren;
	public $farbeFestlegen;
	public $sql;
	
	/*
		Daten abfragen mit Konstruktor und zuweisen
	*/
	function __construct($id)
	{
		$this->sql= new Sql;
		
		$this->recht_ID = $id;
		$call = "Select * From tb_recht Where Recht_ID = '$id'";
		$call = $this->sql->call($call);
		
		$this->recht_ID = $call['Recht_ID'];
		$this->rechtName = $call['RechtName'];
		$this->anzahlStunden = $call['AnzahlStunden'];
		$this->anzahlPlaetze = $call['AnzahlPlaetze'];
		$this->anzahlReservierungen = $call['AnzahlReservierungen'];
		$this->tageVoraus = $call['TageVoraus'];
		$this->reservierungLoeschen = $call['ReservierungLoeschen'];
		$this->reservierungVerschieben = $call['ReservierungVerschieben'];
		$this->benutzerVerwalten = $call['BenutzerVerwalten'];
		$this->rechteVerteilen = $call['RechteVerteilen'];
		$this->platzVerwalten = $call['PlatzVerwalten'];
		$this->saisonFestlegen = $call['SaisonFestlegen'];
		$this->serienReservieren = $call['SerienReservieren'];
		$this->farbeFestlegen = $call['FarbeFestlegen'];
		
	}
	
	
	/*
		String für setter Methoden generieren
	*/
	public function sqlString($zeile, $daten)
	{
		$return = "UPDATE tb_recht SET " .$zeile . "= '" . $daten ."' WHERE Recht_ID = " . $this->recht_ID;
		return $return;
	}
	
	/*
		getter und setter Methoden für alle Variablen
	*/
	public function getRechtName()
	{
		return $this->rechtName;
			
	}
	
	public function setRechtName($daten)
	{
		$this->rechtName = $daten;
		$update = $this->sqlString("Rechtname", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getAnzahlStunden()
	{
		return $this->anzahlStunden;
			
	}
	
	public function setAnzahlStunden($daten)
	{
		$this->anzahlStunden = $daten;
		$update = $this->sqlString("AnzahlStunden", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getAnzahlPlaetze()
	{
		return $this->anzahlPlaetze;
			
	}
	
	public function setAnzahlPlaetze($daten)
	{
		$this->anzahlPlaetze = $daten;
		$update = $this->sqlString("AnzahlPlaetze", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getAnzahlReservierungen()
	{
		return $this->anzahlReservierungen;
			
	}
	
	public function setAnzahlReservierungen($daten)
	{
		$this->anzahlReservierungen = $daten;
		$update = $this->sqlString("AnzahlReservierungen", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getTageVoraus()
	{
		return $this->tageVoraus;
			
	}
	
	public function setTageVoraus($daten)
	{
		$this->tageVoraus = $daten;
		$update = $this->sqlString("TageVoraus", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getReservierungLoeschen()
	{
		return $this->reservierungLoeschen;
			
	}
	
	public function setReservierungLoeschen($daten)
	{
		$this->reservierungLoeschen = $daten;
		$update = $this->sqlString("ReservierungLoeschen", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getReservierungVerschieben()
	{
		return $this->reservierungVerschieben;
			
	}
	
	public function setReservierungVerschieben($daten)
	{
		$this->reservierungVerschieben = $daten;
		$update = $this->sqlString("ReservierungVerschieben", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getBenutzerVerwalten()
	{
		return $this->benutzerVerwalten;
			
	}
	
	public function setBenutzerVerwalten($daten)
	{
		$this->benutzerVerwalten = $daten;
		$update = $this->sqlString("BenutzerVerwalten", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getRechteVerteilen()
	{
		return $this->rechteVerteilen;
			
	}
	
	public function setRechteVerteilen($daten)
	{
		$this->rechteVerteilen = $daten;
		$update = $this->sqlString("RechteVerteilen", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getPlatzVerwalten()
	{
		return $this->platzVerwalten;
			
	}
	
	public function setPlatzVerwalten($daten)
	{
		$this->platzVerwalten = $daten;
		$update = $this->sqlString("PlatzVerwalten", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getSaisonFestlegen()
	{
		return $this->saisonFestlegen;
			
	}
	
	public function setSaisonFestlegen($daten)
	{
		$this->saisonFestlegen = $daten;
		$update = $this->sqlString("SaisonFestlegen", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getSerienReservieren()
	{
		return $this->serienReservieren;
			
	}
	
	public function setSerienReservieren($daten)
	{
		$this->serienReservieren = $daten;
		$update = $this->sqlString("SerienReservieren", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getFarbeFestlegen()
	{
		return $this->farbeFestlegen;
			
	}
	
	public function setFarbeFestlegen($daten)
	{
		$this->farbeFestlegen = $daten;
		$update = $this->sqlString("FarbeFestlegen", $daten);
		$this->sql->change($update);
	}
}