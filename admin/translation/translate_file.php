<?php
// Microsoft Translator PHP API
header('Content-Type: text/html; charset=utf-8');
include ("translation.class.php");
if (!defined('ACCOUNT_KEY')) {
	define('ACCOUNT_KEY', 'khLnJ5yILVicrO/YgMU7bgKBNbMb/2WowRnJ0yKgzEQ');
}
$translateThis = new TranslateMe(ACCOUNT_KEY);

echo $data['d']['results'][0]['Text'];
$fIn = fopen('../languages/default_new.txt', 'r');
$fOut = fopen('../languages/es.txt', 'w');
while ($line = fgets($fIn)) {
	$line = trim($line, " \t\n\r\0\x0B");
	if (substr($line, 0, 2) === '//') {
		$text = $line. "\n";
	} else {  
	   $text =  $line . '==' . $translateThis->translate($line, "es", "en") . "\n";
	}
   fwrite($fOut, $text);
}
fclose($fIn);
fclose($fOut);
echo "<br>Done.";
?>