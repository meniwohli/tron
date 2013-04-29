<?php



class loginException extends Exception
{
	public function errorMessage()
	{
		//Nachricht auswerfen
		$errorMsg = 'Test-Nachricht';
		return $errorMsg;
	}
}