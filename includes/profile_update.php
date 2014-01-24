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
	$hobbies = yasDB_clean($_POST['hobbies']);
	$gender_radio = yasDB_clean($_POST['radio']);
	$month = yasDB_clean($_POST['DateOfBirth_Month']);
	$day = yasDB_clean($_POST['DateOfBirth_Day']);
	$year = yasDB_clean($_POST['DateOfBirth_Year']);
	if ($month == "-Month-" || $day == "-Day-" || $year == "-Year-") {
		$birthday = 0;
	} else {
		$birthday = strtotime($day." ".$month." ".$year);
	}
	if ($gender_radio == 'female') {
		$gender = 'female';
	}
	elseif ($gender_radio == 'male') {
		$gender = 'male';
	}
	else {
		$gender = '';
	}
	if (isset($_SESSION['userid'])) {
		yasDB_update("UPDATE `user` SET website = '$website', name = '$name', email = '$email', location='$location', job='$job', aboutme='$aboutme', hobbies='$hobbies', birthday='$birthday', gender='$gender'  WHERE id = '$userid'");
		echo '<h2>Your profile has been updated.</h2>';
	}
	else {
		echo '<h2>Invalid user detected.</h2>';
	}
}
?>