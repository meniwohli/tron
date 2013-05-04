<?php



class FileException extends Exception{
	public $filename;
	
	function __construct($filename)
	{
		$this->filename = $filename;
	}
	
	function toString()
	{
		echo $this->filename . " wurde nicht gefunden!";
	}
}