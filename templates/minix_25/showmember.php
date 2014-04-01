<div id="center">
<div class="container_box1">
<div id="headergames2">Profile</div>
<?php
if(!isset($_SESSION["user"])) {
echo '<center><span style="font-size:150%;text-align:center;">You must Register or log in to view member profiles.</span></center></div>';
} else {
if(isset($_POST['addcomment'])) {
if(empty($_POST['userid'])) {
echo 'Sorry, the member you were commenting seems to be invalid.';
} elseif (
empty($_POST['comment']) || empty($_POST['name'])) {
echo 'Please go back and try again, it seems the comment or name was left empty.';
} else {
$userid = yasDB_clean($_POST['userid']);
$comment = yasDB_clean($_POST['comment'],true);
$name = yasDB_clean($_POST['name']);
$ipaddress = $_SERVER['REMOTE_ADDR'];
yasDB_insert("INSERT INTO `memberscomments` (id,userid, comment, ipaddress, name) values ('', '{$userid}', '{$comment}', '{$ipaddress}', '{$name}')",false);
echo '<span style="color:red;">Comment added!</span>';
}
}
$id = yasDB_clean($_GET['id']);
$query = yasDB_select("SELECT * FROM `user` WHERE id = '$id'");
$row = $query->fetch_array(MYSQLI_ASSOC);
$query->close();
$joined = date('m/d/y',$row['date']);
$points = $row['plays']*50;
if ( $row['website'] != '') {
$website = '<a href="'.$row['website'].'" target="_blank">Website</a><br>';
} else {
$website = 'No Website';
}
if ( $row['useavatar'] == '1' ) {
$avatarimage = $setting['siteurl'] . 'avatars/' . $row['avatarfile'];
}else {
$avatarimage = $setting['siteurl'] . 'avatars/useruploads/noavatar.JPG';
}
if ($row['deact'] == 'deactivate') {
if ($setting['seo']=='yes') {
$profile = $setting['siteurl'].'profile.html';
} else {
$profile = $setting['siteurl'].'index.php?act=profile';
}
echo '
<div class="containbox2">
<table class="tg" width="720px">
  <tr>
    <th class="tg-s6z2" colspan="4">Activate Account</th>
  </tr>
  <tr>
    <td class="tg-vn4c">
    <center>
    This account is deactivated.<br />
    Please click on link to activate your account.<br />
    <a href="'.$profile.'">Edit Profile</a></center><br /></td>
  </tr> 
  </table>
<div class="clear"></div>
</div>
<div class="clear"></div>
';
} else {
?>
<div class="containbox2">
<table class="tg" width="720px">
  <tr>
    <th class="tg-s6z2" colspan="4">Username : <?php echo $row['username'];?></th>
  </tr>
  <tr>
    <td class="tg-vn4c" width="140px"><img src="<?php echo $avatarimage;?>" width="130" height="100">
    <br/><?php if ($row['shname'] == 'hidden') { echo 'Username:<hr>'.$row['username'].'<hr>'; } else { echo 'Real Name:<hr>'.$row['name'].'<hr>'; } ?>
    <?php echo $website;?><hr></td>
  </tr>
  <tr>
    <th class="tg-s6z2" colspan="4">About Me:</th>
  </tr>
  <tr>
    <td class="tg-Oord" colspan="1">Location:</td>
    <td class="tg-Oord" colspan="1"><?php if ($row['shloc'] == 'hidden') { echo ''; } else { echo ''.$row['location'].''; } ?></td>
    <td class="tg-Oord" colspan="1">Joined:</td>
    <td class="tg-Oord" colspan="1"><?php echo $joined;?></td>
  </tr>
  <tr>
    <td class="tg-vn4c" colspan="1">Game Plays:</td>
    <td class="tg-vn4c" colspan="1"><?php echo $row['plays'];?></td>
    <td class="tg-vn4c" colspan="1">Points:</td>
    <td class="tg-vn4c" colspan="1"><?php echo $points;?></td>
  </tr>
  <tr>
    <td class="tg-Oord" colspan="1">Email:</td>
    <td class="tg-Oord" colspan="3"><?php if ($row['sheml'] == 'hidden') { echo ''; } else { echo ''.$row['email'].''; }?></td>
  </tr>
  <tr>
    <td class="tg-vn4c" width="80px">Interests:</td>
    <td class="tg-vn4c" colspan="3"><?php if ($row['shabout'] == 'hidden') { echo ''; } else { echo ''.$row['aboutme'].''; } ?></td>
  </tr>
  <tr>
    <td class="tg-Oord" width="80px">Hobbies:</td>
    <td class="tg-Oord" colspan="3"><?php if ($row['shhobs'] == 'hidden') { echo ''; } else { echo ''.$row['hobbies'].''; } ?></td>
  </tr>
</table>
</div>
<div class="clear"></div>
</div>
<?php
if ($row['cmtsdisabled'] == 'hidden') {
echo '';
} else {
?>
<div class="container_box1">
<div id="headergames2">Member's Comments:</div>
<div class="container_box3">
<div id="messages">
<?php
$query = yasDB_select("SELECT count(id) AS count FROM memberscomments WHERE userid = $id");
$result = $query->fetch_array(MYSQLI_ASSOC);
$total = $result['count'];
$prefix = $setting['siteurl'] . 'templates/' . $setting['theme'] . '/skins/' . $setting['skin'] . '/images/smileys/';
if($query->num_rows == 0) {
echo '<div class="container_box3">This member has no comments, be the first to add one!</div>';
} else {
$query = yasDB_select("SELECT memberscomments.name,memberscomments.comment,memberscomments.userid,user.id,user.username,user.avatarfile,user.useavatar FROM memberscomments LEFT JOIN user ON memberscomments.name = user.username WHERE userid = $id ORDER BY 'memberscomments.id' ASC LIMIT 5");
$i = 0;
while($row = $query->fetch_array(MYSQLI_ASSOC)) {
$text = $row['comment'];
$username = $row['name'];
$text = str_replace(':D','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/biggrin.gif" title="biggrin" alt="biggrin" />',$text);
$text = str_replace(':?','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/confused.gif" title="confused" alt="confused" />',$text);
$text = str_replace('8)','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/cool.gif" title="cool" alt="cool" />',$text);
$text = str_replace(':cry:','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/cry.gif" title="cry" alt="cry" />',$text);
$text = str_replace(':shock:','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/eek.gif" title="eek" alt="eek" />',$text);
$text = str_replace(':evil:','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/evil.gif" title="evil" alt="evil" />',$text);
$text = str_replace(':lol:','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/lol.gif" title="lol" alt="lol" />',$text);
$text = str_replace(':x','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/mad.gif" title="mad" alt="mad" />',$text);
$text = str_replace(':P','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/razz.gif" title="razz" alt="razz" />',$text);
$text = str_replace(':oops:','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/redface.gif" title="redface" alt="redface" />',$text);
$text = str_replace(':roll:','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/rolleyes.gif" title="rolleyes" alt="rolleyes" />',$text);
$text = str_replace(':(','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/sad.gif" title="sad" alt="sad" />',$text);					
$text = str_replace(':)','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/smile.gif" title="smile" alt="smile" />',$text);
$text = str_replace(':o','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/surprised.gif" title="surprised" alt="surprised" />',$text);
$text = str_replace(':twisted:','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/twisted.gif" title="twisted" alt="twisted" />',$text);
$text = str_replace(':wink:','<img src="' . $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/wink.gif" title="wink" alt="wink" />',$text);
if ( $row['useavatar'] == '1' ) {
$avatarimage = $setting['siteurl'] . 'avatars/' . $row['avatarfile'];
} else {
$avatarimage = $setting['siteurl'] . 'avatars/useruploads/noavatar.JPG';
}
if ($setting['seo'] == 'yes') {
$memberlink = $setting['siteurl'].'showmember/'.$row['id'].'.html';
} else {
$memberlink = $setting['siteurl'] . 'index.php?act=showmember&id='.$row['id'] ;
} 
if($i % 2 == 0)	{
echo '<div class="cm-box"><a href="'.$memberlink.'"><img src="'.$avatarimage.'" align="center" class="avatar-img" title="'.$username.'"></a><div class="cmmnts"><p class="usr-cmnt">' . $text . '</p></div></div><div class="clear"></div>';
} else {
echo '<div class="cm-box"><div class="scnd-cmnt"><p class="usr-cmnt-2">'.$text.'</p></div><a href="'.$memberlink.'"><img src="'.$avatarimage.'" align="center" class="avatar-img" title="'.$username.'"></a></div><div class="clear"></div>';
}
$i++;
    }
}
$query->close();
?>
</div></div>
<div class="clear"></div>
</div>
<div class="container_box1">
<div id="headergames2">Leave a comment:</div>
<div class="container_box3">
<center><div id="preview"></div></center>
<div id="commentBox">
<center>
<form name="addcomment" id="addcomment" method="post" action=""><strong>Message:</strong><br />
<textarea name="comment" rows="4" cols="62" id="comment_message" style="color:#999;" onkeyup="noBad(this);" onblur="this.value = this.value || this.defaultValue; this.style.color = '#999';" onfocus="this.value=''; this.style.color = '#000';" value="Type comment here"></textarea>
<br />
<input type="hidden" name="timestamp" id="timestamp" value="<?php echo time(); ?>" /><br/>
</center>
<div id="smiles"><center>
<a href="javascript:addsmilie(' :D ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/biggrin.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :? ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/confused.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' 8) ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/cool.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :cry: ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/cry.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :shock: ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/eek.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :evil: ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/evil.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :lol: ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/lol.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :x ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/mad.gif';?>" border="0"  /></a><br />
<a href="javascript:addsmilie(' :P ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/razz.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :oops: ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/redface.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :roll: ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/rolleyes.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :( ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/sad.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :) ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/smile.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :o ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/surprised.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :twisted: ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/twisted.gif';?>" border="0"  /></a>
<a href="javascript:addsmilie(' :wink: ')"><img src="<?php echo $setting['siteurl'].'templates/'.$setting['theme'].'/skins/'.$setting['skin'].'/images/smileys/wink.gif';?>" border="0"  /></a>
</center></div>
<div class="clear"></div>
<center>
<input name="name" type="hidden" value="<?php echo $_SESSION['user'];?>" /><br />
<input type="hidden" name="recaptcha" id="recaptcha" value="no">
<input type="hidden" name="security" id="security" value="10">
<input type="hidden" name="member" value="yes">
<input type="hidden" name="userid" id="userid" value="<?php echo $id; ?>">
<input name="addcomment" type="submit" value="Add Comment" style="border: 1px solid #000; margin-top: 2px;" /><br/><br/>
</form></center></div></div>
<div class="clear"></div>
<?php }
  }
}
?>
</div>
