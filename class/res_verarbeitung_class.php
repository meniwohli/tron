<?php
	require_once "sql_class.php";
	require_once 'reservierung_class.php';

class ReservierungenVerarbeiten
{
	public $sql;
	public $reservierung;
	public $mitglied;
	public $members = array();
	public $reservierungen = array();
	public $ergebnis = array();
	
	/*
	 * Gibt alle Reservierungen von bestimmtem Datum zurück 
	 */
	
	public function getResDatum($datum)
	{
		$this->sql= new Sql;
		
		$call = "Select * From tb_reservierung Where Datum = '$datum' ORDER BY Datum, ReservierungVon";
		$this->ergebnis = $this->sql->arrayCall($call);
		
		foreach($this->ergebnis as $id)
		{	
			$get = $this->reservierung = new Reservierung($id);	
			$this->reservierungen[] = $get;
		}
		
		return $this->reservierungen;
	}
	
	
	/*
	 * Gibt alle Reservierungen mit bestimmter Benutzer ID zurück
	 */
	public function getResID($benID)
	{
		$this->sql= new Sql;
		
		$call = "Select * From tb_reservierung where fk_Mitglied_ID = '$benID' ORDER BY Datum, ReservierungVon";
		$this->ergebnis = $this->sql->arrayCall($call);
		
		foreach($this->ergebnis as $id)
		{
			$get = $this->reservierung = new Reservierung($id['Reservierung_ID']);	
			$this->reservierungen[] = $get;
		}
		
		return $this->reservierungen;
	}
	
	/*
	 * Gibt alles Reservierungen zurück
	 */
	public function getAllRes()
	{
		$this->sql= new Sql;
		
		$call = "Select * from tb_reservierung ORDER BY Datum, ReservierungVon";
		$this->ergebnis = $this->sql->arrayCall($call);
		
		foreach($this->ergebnis as $id)
		{
			$get = $this->reservierung = new Reservierung($id['Reservierung_ID']);
			$this->reservierungen[] = $get;
		}
		
		return $this->reservierungen;
	}
	
	
	/*
	 * Gibt alle Mitglieder aus
	 */
	public function getMitgliedMail()
	{
		$this->sql= new Sql;
	
		$call = "Select * from tb_mitglied";
		$this->ergebnis = $this->sql->arrayCall($call);
	
		foreach($this->ergebnis as $id)
		{
			$get = $this->mitglied = new Mitglied($id['EMail']);
			$this->members[] = $get;
		}
	
		return $this->members;
	}
}