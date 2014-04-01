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
Hobbies:<br />
<textarea name="hobbies" rows="8" cols="50"><?php echo $userdata['hobbies'];?></textarea><p>
AIM:<br />
<input type="text" name="aim" value="<?php echo $userdata['aim'];?>" size="50" /><p>
MSN:<br />
<input type="text" name="msn" value="<?php echo $userdata['msn'];?>" size="50" /><p>
Skype:<br />
<input type="text" name="skype" value="<?php echo $userdata['skype'];?>" size="50" /><p>
Yahoo:<br />
<input type="text" name="yahoo" value="<?php echo $userdata['yahoo'];?>" size="50" /><p>
Disable Profile Comments:<br />
<select name="cmtsdisabled">
<option value="<?php echo $userdata['cmtsdisabled'];?>"/><?php echo $userdata['cmtsdisabled'];?></option>
<option value="hidden">Hidden</option>
<option value="show">Show</option>
</select><p>
    <select name="shloc">
    <option value="<?php echo $userdata['shloc'];?>"/><?php echo $userdata['shloc'];?></option>
    <option value="hidden">Hidden</option>
    <option value="show">Show</option>
    </select>
  <select name="sheml">
  <option value="<?php echo $userdata['sheml'];?>"/><?php echo $userdata['sheml'];?></option>
  <option value="hidden">Hidden</option>
  <option value="show">Show</option>
  </select>
  <select name="shname">
  <option value="<?php echo $userdata['shname'];?>"/><?php echo $userdata['shname'];?></option>
  <option value="hidden">Hidden</option>
  <option value="show">Show</option>
  </select>
  <select name="shhobs">
  <option value="<?php echo $userdata['shhobs'];?>"/><?php echo $userdata['shhobs'];?></option>
  <option value="hidden">Hidden</option>
  <option value="show">Show</option>
  </select
  <select name="shabout">
  <option value="<?php echo $userdata$row['shabout'];?>"/><?php echo $userdata$row['shabout'];?></option>
  <option value="hidden">Hidden</option>
  <option value="show">Show</option>
  </select>
  <select name="deact">
  <option value="<?php echo $userdata$row['deact'];?>"/><?php echo $userdata$row['deact'];?></option>
  <option value="deactivate">Deactivate</option>
  <option value="activate">Activate</option>
  </select>
<?php if (!$userdata['oauth_provider']) { ?>
Password:(leave blank if no change)<br />
<input type="password" name="password" /><p>
<?php } ?>
<input type="hidden" name="uid" value="<?php echo $_SESSION['userid'];?>">
<input type="image" class="submit_button" border="0" src="<?php echo $setting['siteurl'] . 'templates/'.$setting['theme'].'/images/submit.png';?>" name="settings" value="Update" />
</form>
