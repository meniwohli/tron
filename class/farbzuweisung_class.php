<?php

	require_once "sql_class.php";
	require_once "farben_class.php";

class Farbzuweisung
{
	public $reservierungsart;
	public $fk_Farbe_ID;
	public $sql;
	public $farbe;
	
	/*
		Daten abfragen mit Konstruktor und zuweisen
	*/
	function __construct($reservierungsart)
	{
		$this->sql= new Sql;
		
		$this->reservierungsart = $reservierungsart;
		$call = "Select * From tb_farbzuweisung WHERE Reservierungsart = '$reservierungsart'";
		$ergebnis = $this->sql->call($call);
		
		$this->fk_Farbe_ID = $ergebnis['fk_Farbe_ID'];
		
		$this->farbe = new Farben($this->fk_Farbe_ID);
	}
	
	
	/*
		String für setter Methoden generieren
	*/
	public function sqlString($zeile, $daten)
	{
		$return = "UPDATE tb_farbzuweisung SET " .$zeile . "= '" . $daten ."' WHERE Reservierungsart = " . $this->reservierungsart;
		return $return;
	}
	
	/*
		getter und setter Methoden für alle Variablen
	*/
	public function getReservierungsart()
	{
		return $this->reservierungsart;
			
	}
	
	
	
	public function setFk_Farbe_ID($daten)
	{
		$this->fk_Farbe_ID = $daten;
		$update = $this->sqlString("fk_Farbe_ID", $daten);
		$this->sql->change($update);
	}
	
	
	public function getFk_Farbe_ID()
	{
		return $this->fk_Farbe_ID;
			
	}
}