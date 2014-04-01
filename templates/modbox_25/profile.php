<div id="center">
<div class="container_box1">
<div class="header">Edit Profile</div>
<?php
if(isset($_SESSION["user"])) {
	$user=$_SESSION["user"];
} else {
  echo '<div class="containbox2">';
  echo '<center>Not logged in!</center>';
  echo '</div><div class="clear"></div></div></dov>';
  include ("footer.php");
  exit;
}
if (isset($_POST['settings'])){
	$website = yasDB_clean($_POST['website']);
	$name = yasDB_clean($_POST['name']);
	$email = yasDB_clean($_POST['email']);
	$location = yasDB_clean($_POST['location']);
	$job = yasDB_clean($_POST['job']);
	$aboutme = yasDB_clean($_POST['aboutme']);
	$hobbies = yasDB_clean($_POST['hobbies']);
	$shhobs = yasDB_clean($_POST['shhobs']);
	$shloc = yasDB_clean($_POST['shloc']);
	$sheml = yasDB_clean($_POST['sheml']);
	$shname = yasDB_clean($_POST['shname']);
	$deact = yasDB_clean($_POST['deact']);
	$cmtsdisabled = yasDB_clean($_POST['cmtsdisabled']);
	yasDB_update("UPDATE user SET website = '$website', name = '$name', email = '$email', location='$location', job='$job', aboutme='$aboutme', hobbies='$hobbies', shhobs='$shhobs', cmtsdisabled='$cmtsdisabled', shloc='$shloc', sheml='$sheml', shname='$shname', deact='$deact' WHERE username = '$user'");
	if(!empty($_POST['password'])) {
	$password = md5(yasDB_clean($_POST['password']));
	yasDB_update("UPDATE user SET password = '$password' WHERE username = '$user'");
	}
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.php?act=profile">';
} else {
	$query = yasDB_select("SELECT * FROM `user` WHERE username = '$user'");
	$row = $query->fetch_array(MYSQLI_ASSOC);
	echo ' <div class="container_box2"><div id="preview"></div><div id="profileBox">
	<form name="usersettings" id="profile" method="post" action="index.php?act=profile">
<table class="tg">
  <tr>
    <th class="tg-s6z2" colspan="4">'.$user.'s Profile:</th>
  </tr>
  <tr>
    <td class="tg-vn4c">Name:</td>
    <td class="tg-vn4c"><input type="text" name="name" value="' . $row['name'] . '" size="30" /></td>
    <td class="tg-vn4c">Email:</td>
    <td class="tg-vn4c"><input type="text" name="email" value="' . $row['email'] . '" size="30" /></td>
  </tr>
  <tr>
    <td class="tg-0ord">Website:(Remember the http://)</td>
    <td class="tg-0ord"><input type="text" name="website" value="' . $row['website'] . '" size="30" /></td>
    <td class="tg-Oord">Location:</td>
    <td class="td-Oord"><input type="text" name="location" value="' . $row['location'] . '" size="30" /></td>
  </tr>
  <tr>
    <th class="tg-s6z2" colspan="4">About Me:</th>
  </tr>
  <tr>
    <td class="tg-vn4c" colspan="1">Interests:</td>
    <td class="tg-vn4c" colspan="3"><textarea name="aboutme" rows="8" cols="50">'. $row['aboutme'] . '</textarea></td>
  </tr>
  <tr>
    <td class="tg-Oord" colspan="1">Hobbies:</td>
    <td class="tg-Oord" colspan="3"><textarea name="hobbies" rows="8" cols="50">'. $row['hobbies'] . '</textarea></td>
  </tr>  
  <tr>
    <th class="tg-s6z2" colspan="4">Settings:</th>
  </tr>
  <tr>
    <td class="tg-vn4c">Profile Comments:</td>
    <td class="tg-vn4c">
    <select name="cmtsdisabled">
    <option value="'.$row['cmtsdisabled'].'"/>'.$row['cmtsdisabled'].'</option>
    <option value="hidden">Hidden</option>
    <option value="show">Show</option>
    </select>    
    </td>
    <td class="tg-vn4c">Location:</td>
    <td class="tg-vn4c">
    <select name="shloc">
    <option value="'.$row['shloc'].'"/>'.$row['shloc'].'</option>
    <option value="hidden">Hidden</option>
    <option value="show">Show</option>
    </select>    
    </td>
  </tr>
  <tr>
  <td class="tg-Oord">Email:</td>
  <td class="tg-Oord">
  <select name="sheml">
  <option value="'.$row['sheml'].'"/>'.$row['sheml'].'</option>
  <option value="hidden">Hidden</option>
  <option value="show">Show</option>
  </select>
  </td>
  <td class="tg-Oord">Name:</td>
  <td class="tg-Oord">
  <select name="shname">
  <option value="'.$row['shname'].'"/>'.$row['shname'].'</option>
  <option value="hidden">Hidden</option>
  <option value="show">Show</option>
  </select>
  </td>
  </tr>
  <tr>
  <td class="tg-vn4c">Hobbies:</td>
  <td class="tg-vn4c">
  <select name="shhobs">
  <option value="'.$row['shhobs'].'"/>'.$row['shhobs'].'</option>
  <option value="hidden">Hidden</option>
  <option value="show">Show</option>
  </select>
  </td>
  <td class="tg-vn4c">About Me:</td>
  <td class="tg-vn4c">
  <select name="shabout">
  <option value="'.$row['shabout'].'"/>'.$row['shabout'].'</option>
  <option value="hidden">Hidden</option>
  <option value="show">Show</option>
  </select>
  </td>
  <tr>';
	if ($row['oauth_provider'] == "" || empty($row['oauth_provider'])) {
		echo '
		<td class="tg-Oord">Password:(leave blank if no change)</td>
    <td class="tg-Oord"><input type="text" name="password" /></td>
    <td class="tg-Oord"></td>
    <td class="tg-Oord"></td>';
	}
  echo '
  </tr>
  <tr>
    <th class="tg-s6z2" colspan="4">Deactivate Account:</th>
  </tr>
  <tr>
    <td class="tg-vn4c" colspan="2">Click on link if you wish to deactivate your account.</td>
    <td class="tg-vn4c" colspan="2">
    <select name="deact">
    <option value="'.$row['deact'].'"/>'.$row['deact'].'</option>
    <option value="deactivate">Deactivate</option>
    <option value="activate">Activate</option>
    </select>    
  </tr>
  <tr>
    <th class="tg-s6z2" colspan="4">Update Account:</th>
  </tr>
  <tr>
    <td class="tg-vn4c" colspan="2">Update:</td>
    <td class="tg-vn4c" colspan="2"><input type="submit" name="settings" value="Update" /></td>
  </tr>        
  </table>
  </form> 
  </div></div>';
	$query->close();
}
?>
<div class="clear"></div>
</div>
