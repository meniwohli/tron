<?php

require_once "sql_class.php";

class Farben
{
	public $farbe_ID;
	public $farbName;
	public $farbCode;
	public $sql;
	
	/*
		Daten abfragen mit Konstruktor und zuweisen
	*/
	function __construct($id)
	{
		$this->sql= new Sql;
		
		$this->farbe_ID = $id;
		$call = "Select * From tb_farben Where Farbe_ID = '$id'";
		$ergebnis = $this->sql->call($call);
		
		$this->farbName = $ergebnis['FarbName'];
		$this->farbCode = $ergebnis['FarbCode'];
	}
	
	
	/*
		String für setter Methoden generieren
	*/
	public function sqlString($zeile, $daten)
	{
		$return = "UPDATE tb_farben SET " .$zeile . "= '" . 
		$daten ."' WHERE Farbe_ID = " . $this->farbe_ID;
		return $return;
	}
	
	/*
		getter und setter Methoden für alle Variablen
	*/
	public function getFarbName()
	{
		return $this->farbName;
			
	}
	
	public function setFarbName($daten)
	{
		$this->farbName = $daten;
		$update = $this->sqlString("FarbName", $daten);
		$this->sql->change($update);
	}
	
	
	
	
	
	public function getFarbCode()
	{
		return $this->farbCode;
			
	}
	
	public function setFarbCode($daten)
	{
		$this->farbCode = $daten;
		$update = $this->sqlString("FarbCode", $daten);
		$this->sql->change($update);
	}
}