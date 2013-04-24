<?php
	require_once "sql_class.php";

class Spieler
{
	public $spieler_ID;
	public $fk_Mitglied_ID;
	public $vorname;
	public $nachname;
	public $sql;
	
	/*
		Daten abfragen mit Konstruktor und zuweisen
	*/
	function __construct($id)
	{
		$this->sql= new Sql;
		
		$this->fk_Mitglied_ID = $id;
		$call = "Select * From tb_spieler Where fk_Mitglied_ID = '$id'";
		$ergebnis = $this->sql->call($call);
		
		$this->spieler_ID = $call['spieler_ID'];
		$this->vorname = $call['vorname'];
		$this->nachname = $call['nachname'];
	}
	
	
	/*
		String für setter Methoden generieren
	*/
	public function sqlString($zeile, $daten)
	{
		$return = "UPDATE tb_spieler SET " .$zeile . "= '" . $daten ."' WHERE Spieler_ID = " . $this->Spieler_ID;
		return $return;
	}
	
	/*
		getter und setter Methoden für alle Variablen
	*/
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
}