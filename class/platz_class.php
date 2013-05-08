<?php
	require_once "sql_class.php";

class Platz
{
	public $platz_ID;
	public $platzNr;
	public $gesperrt;
	public $kommentar;
	public $sql;
	
	/*
		Daten abfragen mit Konstruktor und zuweisen
	*/
	function __construct($id)
	{
		$this->sql= new Sql;
		
		$this->platz_ID = $id;
		$call = "Select * From tb_platz Where Platz_ID = '$id'";
		$call = $this->sql->call($call);
		
		$this->platzNr = $call['PlatzNr'];
		$this->gesperrt = $call['Gesperrt'];
		$this->kommentar = $call['Kommentar'];
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
	public function getPlatzNr()
	{
		return $this->platzNr;
			
	}
	
	public function setPlatzNr($daten)
	{
		$this->platzNr = $daten;
		$update = $this->sqlString("PlatzNr", $daten);
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
	
	
	
	
	
	public function getKommentar()
	{
		return $this->kommentar;
			
	}
	
	public function setKommentar($daten)
	{
		$this->kommentar = $daten;
		$update = $this->sqlString("Kommentar", $daten);
		$this->sql->change($update);
	}
}