<!DOCTYPE html>
<?php
	
//Session starten
session_start();

		
//Twig autoloader starten und registrieren
require_once '../vendor/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
	
//Twig Loader
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader); /* , array(
		'cache' => '../views/compilation_cache',
));*/


//Daten array initialisieren
$daten = array();

include "allgemein.php";

?>