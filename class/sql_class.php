<?php

/**
 * Sql regelt den gesamten Zugriff auf die Datenbank
 * 
 * @author Michael Menhard <m.meni90@gmail.com
 * @version 1.0 01.02.2013
 */

require_once "exception_class.php";

class Sql
{
	
	public $mysqli;
	
	/*
	 * login in db
	 */
	public function logIn()
	{
		
		try
		{
			$this->mysqli = @new mysqli("localhost", "root", "", "tennisdb");
			
			
		
			if ($this->mysqli->connect_error != null || !$this->mysqli->set_charset("utf8"))
			{
				throw new OwnException();
			}
		
			
		}
		catch(OwnException $e)
		{
			$e->loginMessage($this->mysqli);
		}
	}
	
	
	/*
	 * Überprüft, ob User mit Passwort überein stimmt
	*/
	public function logTest($user, $passwort)
	{
		//mysql login
		$this->logIn();
		
		//passwort abfragen
		$ergebnis = $this->mysqli->query("SELECT Passwort FROM tb_mitglied WHERE EMail ='$user'");
		$ergebnis = $ergebnis->fetch_array();
		$ergebnis = $ergebnis['Passwort'];
		
		//passwort vergleichen
		if ($ergebnis == $passwort) 
		{
			$return = 1;
		
		} else{
			$return = 0;
		}	
		
		$this->logOut();
		return $return;
	}
	
	/*
		Überprüft, ob eine E-Mail Adresse bereits im System vorhanden ist
	*/
	public function checkEmail($email)
	{
		$this->logIn();
		$ergebnis = $this->mysqli->query("SELECT EMail FROM tb_mitglied WHERE EMail ='$email'");
		$ergebnis = $ergebnis->fetch_array();
		$ergebnis2 = $ergebnis['EMail'];
		
		//passwort vergleichen
		if ($ergebnis2 == $email) 
		{
			$return = 1;
		
		} else{
			$return = 0;
		}	
		
		$this->logOut();
		return $return;
	}
		
	//Macht änderungen in der Datenbank
	public function change($change)
	{
		$this->logIn();
		$this->mysqli->query($change);
		$this->logOut();
	}
	
	//Gibt ein Array mit allen Ergebnissen zurück
	public function arrayCall($call)
	{
		$this->logIn();
		$ergebnis = $this->mysqli->query($call);
		$ergebnis2 = array();
		
		while($erg = $ergebnis->fetch_array())
		{
			$ergebnis2[] = $erg;
		}
		
		return $ergebnis2;
		$this->logOut();
	}
	
	//Gibt eine Reihe aus der Datenbank zurück
	public function call($call)
	{
		$this->logIn();
		$ergebnis = $this->mysqli->query($call);
		$ergebnis2 = $ergebnis->fetch_array();
		return $ergebnis2;
		$this->logOut();
	}
	
	//Gibt die Anzahl der Abgerufenen Reihen zurück
	public function rows($call)
	{
		$this->logIn();
		$ergebnis = $this->mysqli->query($call);
		$ergebnis = mysqli_num_rows($ergebnis);
		return $ergebnis;
		$this->logOut();
	}
	
	//Logt sich aus
	public function logOut()
	{
		$this->mysqli->close();
	}
}