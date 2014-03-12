<?php
session_start();
include ("db_functions.inc.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$userid = $_SESSION['userid'];
	$website = yasDB_clean($_POST['website']);
	$name = yasDB_clean($_POST['name']);
	$email = yasDB_clean($_POST['email']);
	$location = yasDB_clean($_POST['location']);
	$job = yasDB_clean($_POST['job']);
	$aboutme = yasDB_clean($_POST['aboutme']);
	$aim = yasDB_clean($_POST['aim']);
	$msn = yasDB_clean($_POST['msn']);
	$skype = yasDB_clean($_POST['skype']);
	$yahoo = yasDB_clean($_POST['yahoo']);
	$cmtsdisabled = yasDB_clean($_POST['cmtsdisabled']);
	if (isset($_SESSION['userid'])) {
		yasDB_update("UPDATE `user` SET website = '$website', name = '$name', email = '$email', location='$location', job='$job', aboutme='$aboutme', aim='$aim', msn='$msn', skype='$skype', yahoo='$yahoo', cmtsdisabled='$cmtsdisabled' WHERE id = '$userid'");
		echo '<h2>Your profile has been updated.</h2>';
	}
	else {
		echo '<h2>Invalid user detected.</h2>';
	}
}
?>
