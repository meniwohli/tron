<?php
	require_once "sql_class.php";

class Reservierung
{
	public $reservierung_ID;

	public $fk_Platz_ID;
	public $datum;
	public $reservierungVon;
	public $reservierungBis;
	public $fk_Reservierungsart_ID;
	public $fk_Farbe_ID;
	public $s1;
	public $s2;
	public $s3;
	public $s4;
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
		$this->fk_Platz_ID = $call['fk_Platz_ID'];
		$this->datum = $call['Datum'];
		$this->reservierungVon = $call['ReservierungVon'];
		$this->reservierungBis = $call['ReservierungBis'];
		$this->fk_Reservierungsart_ID = $call['fk_Reservierungsart_ID'];
		$this->s1 = $call['S1'];
		$this->s2 = $call['S2'];
		$this->s3 = $call['S3'];
		$this->s4 = $call['S4'];
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
	
	
	
	public function getFk_Reservierungsart_ID()
	{
		return $this->fk_Reservierungsart_ID;
			
	}
	
	public function setFk_Reservierungsart_ID($daten)
	{
		$this->fk_Reservierungsart_ID = $daten;
		$update = $this->sqlString("fk_Reservierungsart_ID", $daten);
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
	
	
	
	
	
	
	public function getS1()
	{
		return $this->s1;
			
	}
	
	
	
	
	
	public function getS2()
	{
		return $this->s2;
			
	}
	
	
	
	
	
	public function getS3()
	{
		return $this->s3;
			
	}
	
	
	
	
	
	public function getS4()
	{
		return $this->s4;
			
	}
}