<?php
	require_once "sql_class.php";

class Reservierung
{
	public $reservierungsart_ID;

	public $reservierungsart;
	
	
	/*
		Daten abfragen mit Konstruktor und zuweisen
	*/
	function __construct($id)
	{
		$this->sql= new Sql;
		
		$this->reservierungsart_ID = $id;
		$call = "Select * From tb_reservierung Where Reservierungsart_ID = '$id'";
		$call = $this->sql->call($call);
		
		$this->reservierungsart_ID = $call['Reservierungart_ID'];
	}
	
	
	/*
		String für setter Methoden generieren
	*/
	public function sqlString($zeile, $daten)
	{
		$return = "UPDATE tb_reservierungsart SET " .$zeile . "= '" . $daten ."' WHERE Reservierungsart_ID = " . $this->reservierungsart_ID;
		return $return;
	}
	
	/*
		getter und setter Methoden für alle Variablen
	*/	
	
	
	public function getReservierungsart()
	{
		return $this->reservierungsart;
			
	}
	
	public function setreservierungsart($daten)
	{
		$this->reservierungsart = $daten;
		$update = $this->sqlString("Reservierungsart", $daten);
		$this->sql->change($update);
	}
	
	
	
}