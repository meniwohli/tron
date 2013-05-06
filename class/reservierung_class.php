<?php
	require_once "sql_class.php";

class Reservierung
{
	public $reservierung_ID;
	public $fk_Mitglied_ID;
	public $fk_Platz_ID;
	public $datum;
	public $reservierungVon;
	public $reservierungBis;
	public $fk_Farbe_ID;
	public $fk_S1_ID;
	public $fk_S2_ID;
	public $fk_S3_ID;
	public $fk_S4_ID;
	public $sql;
	
	/*
		Daten abfragen mit Konstruktor und zuweisen
	*/
	function __construct($id)
	{
		$this->sql= new Sql;
		
		$this->reservierung_ID = $id;
		$call = "Select * From tb_reservierung Where Reservierung_ID = '$id'";
		$call = $this->sql->call($call);
		
		$this->reservierung_ID = $call['Reservierung_ID'];
		$this->fk_Mitglied_ID = $call['fk_Mitglied_ID'];
		$this->fk_Platz_ID = $call['fk_Platz_ID'];
		$this->datum = $call['Datum'];
		$this->reservierungVon = $call['ReservierungVon'];
		$this->reservierungBis = $call['ReservierungBis'];
		$this->fk_S1_ID = $call['fk_S1_ID'];
		$this->fk_S2_ID = $call['fk_S2_ID'];
		$this->fk_S3_ID = $call['fk_S3_ID'];
		$this->fk_S4_ID = $call['fk_S4_ID'];
	}
	
	
	/*
		String für setter Methoden generieren
	*/
	public function sqlString($zeile, $daten)
	{
		$return = "UPDATE tb_reservierung SET " .$zeile . "= '" . $daten ."' WHERE Reservierung_ID = " . $this->reservierung_ID;
		return $return;
	}
	
	/*
		getter und setter Methoden für alle Variablen
	*/
	public function getFk_Mitglied_ID()
	{
		return $this->fk_Mitglied_ID;
			
	}
	
	
	
	
	
	public function getFk_Platz_ID()
	{
		return $this->fk_Platz_ID;
			
	}
	
	
	
	
	
	public function getDatum()
	{
		return $this->datum;
			
	}
	
	public function setDatum($daten)
	{
		$this->datum = $daten;
		$update = $this->sqlString("Datum", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getReservierungVon()
	{
		return $this->reservierungVon;
			
	}
	
	public function setReservierungVon($daten)
	{
		$this->reservierungVon = $daten;
		$update = $this->sqlString("ReservierungVon", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getReservierungBis()
	{
		return $this->reservierungBis;
			
	}
	
	public function setReservierungBis($daten)
	{
		$this->reservierungBis = $daten;
		$update = $this->sqlString("ReservierungBis", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	
	public function getFk_S1_ID()
	{
		return $this->fk_S1_ID;
			
	}
	
	
	
	
	
	public function getFk_S2_ID()
	{
		return $this->fk_S2_ID;
			
	}
	
	
	
	
	
	public function getFk_S3_ID()
	{
		return $this->fk_S3_ID;
			
	}
	
	
	
	
	
	public function getFk_S4_ID()
	{
		return $this->fk_S4_ID;
			
	}
}