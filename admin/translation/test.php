<?php
	header('Content-Type: text/html; charset=utf-8');
	include ("translation.class.php");
	if (!defined('ACCOUNT_KEY')) {
		define('ACCOUNT_KEY', 'JOPXF5j+QZtsjgNI94hrLQfkjHXX4diA2T0jSwEiiIE');
	}
	$translateThis = new TranslateMe(ACCOUNT_KEY);
	$text = $translateThis->translate("one day kitty fell in a pool so she decided to kill a turkey with a hersheys kiss.", "es", "en");
	echo $translateThis->oldText . "<br>";
	echo $text;	
?>