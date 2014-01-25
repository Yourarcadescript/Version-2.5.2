<div id="center">
<div class="container_box1">
<div class="header">Edit Profile</div>
<?php
if(isset($_SESSION["user"])) {
	$user=$_SESSION["user"];
} else {
	echo "Not logged in!";
exit;
}
if(isset($_POST['settings'])) {
	$website = yasDB_clean($_POST['website']);
	$name = yasDB_clean($_POST['name']);
	$email = yasDB_clean($_POST['email'])
	;$location = yasDB_clean($_POST['location']);
	$job = yasDB_clean($_POST['job']);
	$aboutme = yasDB_clean($_POST['aboutme']);
	$aim = yasDB_clean($_POST['aim']);
	$msn = yasDB_clean($_POST['msn']);
	$skype = yasDB_clean($_POST['skype']);
	$yahoo = yasDB_clean($_POST['yahoo']);
	yasDB_update("UPDATE user SET website = '$website', name = '$name', email = '$email', location='$location', job='$job', aboutme='$aboutme', aim='$aim', msn='$msn', skype='$skype', yahoo='$yahoo' WHERE username = '$user'");
	if(!empty($_POST['password'])) {
	$password = md5(yasDB_clean($_POST['password']));
	yasDB_update("UPDATE user SET password = '$password' WHERE username = '$user'");
	}
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php?act=profile">';
} else {
	$query = yasDB_select("SELECT * FROM `user` WHERE username = '$user'");
	$row = $query->fetch_array(MYSQLI_ASSOC);
	echo ' <div class="container_box2"><div id="preview"></div><div id="profileBox">'.$user.'s Profile:
	<form name="usersettings" id="profile" method="post" action="index.php?act=profile">
	Name:<br /><input type="text" name="name" value="' . $row['name'] . '" size="50" /><p>
	Email:<br /><input type="text" name="email" value="' . $row['email'] . '" size="50" /><p>
	Website:(Remember the http://)<br /><input type="text" name="website" value="' . $row['website'] . '" size="50" /><p>
	Location:<br /><input type="text" name="location" value="' . $row['location'] . '" size="50" /><p>
	Occupation:<br /><input type="text" name="job" value="' . $row['job'] . '" size="50" /><p>
	About Me:<br /><textarea name="aboutme" rows="5" cols="38">'. $row['aboutme'] . '</textarea><p>
	AIM:<br /><input type="text" name="aim" value="' . $row['aim'] . '" size="50" /><p>
	MSN:<br /><input type="text" name="msn" value="' . $row['msn'] . '" size="50" /><p>
	Skype:<br /><input type="text" name="skype" value="' . $row['skype'] . '" size="50" /><p>
	Yahoo:<br /><input type="text" name="yahoo" value="' . $row['yahoo'] . '" size="50" /><p>';
	if ($row['oauth_provider'] == "" || empty($row['oauth_provider'])) {
		echo 'Password:(leave blank if no change)<br />
		<input type="text" name="password" /><p>';
	}
	echo'<input type="submit" name="settings" value="Update" />
	</form>
	</div></div>';
	$query->close();
}
?>
<div class="clear"></div>
</div>