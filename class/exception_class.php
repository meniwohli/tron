<?php



class OwnException extends Exception
{
	public function loginMessage($mysqli)
	{
		if ($mysqli->connect_error)
			{
				echo "<b>Fehler bei der Verbindung:</b> " . mysqli_connect_error();
				exit();
			}
				
			if (!$mysqli->set_charset("utf8"))
			{
				echo "Fehler beim Laden von UTF8 ". $this->mysqli->error;
			}
	}
	
	public function emptyFill ()
	{
		echo "Sie haben nicht alle benötigten Daten eingegeben!";
	}
}