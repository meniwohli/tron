<?php



class OwnException extends Exception
{
	public function errorMessage()
	{
		//Nachricht auswerfen
		$errorMsg = 'Test-Nachricht';
		return $errorMsg;
	}
}