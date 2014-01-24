<?php
include("db_functions.inc.php");
$userid = yasDB_clean($_GET['uid']);
$query = yasDB_select("SELECT * FROM `user` WHERE `id` = '$userid'");
$userdata = $query->fetch_array(MYSQLI_ASSOC);
?>
<br/><br/>
<form id="profile" name="profile" method="post" action="index.php?act=profile">
<?php if (!$userdata['oauth_provider']) { ?>
Name:<br />
<input type="text" name="name" value="<?php echo $userdata['name'];?>" size="50" /><p>
<?php } ?>
<?php if ($userdata['oauth_provider'] != "facebook") { ?>
Email:<br />
<input type="email" name="email" value="<?php echo $userdata['email'];?>" size="50" /><p>
<?php } ?>
Website:(Remember the http://)<br />
<input type="text" name="website" value="<?php echo $userdata['website'];?>" size="50" /><p>
Location:<br />
<input type="text" name="location" value="<?php echo $userdata['location'];?>" size="50" /><p>
Occupation:<br />
<input type="text" name="job" value="<?php echo $userdata['job'];?>" size="50" /><p>
About Me:<br />
<textarea name="aboutme" rows="5" cols="38"><?php echo $userdata['aboutme'];?></textarea><p>
AIM:<br />
<input type="text" name="aim" value="<?php echo $userdata['aim'];?>" size="50" /><p>
MSN:<br />
<input type="text" name="msn" value="<?php echo $userdata['msn'];?>" size="50" /><p>
Skype:<br />
<input type="text" name="skype" value="<?php echo $userdata['skype'];?>" size="50" /><p>
Yahoo:<br />
<input type="text" name="yahoo" value="<?php echo $userdata['yahoo'];?>" size="50" /><p>
<?php if (!$userdata['oauth_provider']) { ?>
Password:(leave blank if no change)<br />
<input type="password" name="password" /><p>
<?php } ?>
<input type="hidden" name="uid" value="<?php echo $_SESSION['userid'];?>">
<input type="image" class="submit_button" border="0" src="<?php echo $setting['siteurl'] . 'templates/'.$setting['theme'].'/images/submit.png';?>" name="settings" value="Update" />
</form>