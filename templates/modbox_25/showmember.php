<div id="center">
<div class="container_box1">
<div class="header">Profile</div>
<?php
if(!isset($_SESSION["user"])) {
echo '<span style="font-size:150%;text-align:center;">You must Register or log in to view member profiles.</span>';
} else {
if(isset($_POST['addcomment'])) {
if(empty($_POST['userid'])) {
echo 'Sorry, the member you were commenting seems to be invalid.';
} elseif (empty($_POST['comment']) || empty($_POST['name'])) {
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
$row = $query->fetch_array(MYSQLI_ASSOC);$query->close();
$joined = date('m/d/y',$row['date']);
$points = $row['plays']*50;
if ( $row['website'] != '') {
$website = '<a href="'.$row['website'].'" target="_blank">Website</a><br>';
} else {
$website = 'No Website';
};
if ( $row['location'] != '') {
$location = ''. $row['location'].'<br>';
} else {
$location = 'Place where you stay.<br>';
};
if ( $row['job'] != '') {
$occupation = ''. $row['job'].'<br>';
} else {
$occupation = 'Work place.<br>';
};
if ( $row['useavatar'] == '1' ) {
$avatarimage = $setting['siteurl'] . 'avatars/' . $row['avatarfile'];
}else { 
$avatarimage = $setting['siteurl'] . 'avatars/useruploads/noavatar.JPG';
}
echo '
<div class="container_box3">
<div class="header2">About Me</div>
<div class="box1">Username: '.$row['username'].'<br>
<img src="'.$avatarimage.'" height="100" width="130">
<br/>';
if ($setting['seo'] == 'yes') {
	echo '<a href="'.$setting['siteurl'].'/profile.html"><span style="color:#3399FF;">Edit Profile</span></a>';
} else {
	echo '<a href="'.$setting['siteurl'].'/index.php?act=profile">Edit Profile</a>';
}
echo '<hr>'.$website.'<hr> 
Age: ' . $row['age'] . '</div>
<div class="box2" style="height:166px;">' . $row['aboutme'] . '</div>
</div>

<div class="container_box3">
<div class="header2">My Info:</div>
<div class="box1">
<div class="box3">Location:</div>
<div class="box3">Joined:</div>
<div class="box3">Plays:</div>
<div class="box3">Points:</div>
<div class="box3">Occupation:</div>
</div><div class="box2">
<div class="box4">'.$location.'</div>
<div class="box4">' . $joined . '</div>
<div class="box4">'.$row['plays'].'</div>
<div class="box4">'. $points .'</div>
<div class="box4">'.$occupation.'</div>
</div></div>

<div class="container_box3">
<div class="header2">Contact Info:</div>
<div class="box1">
<div class="box3">AIM:</div>
<div class="box3">MSN:</div>
<div class="box3">Skype:</div>
<div class="box3">Yahoo:</div>
</div><div class="box2">
<div class="box4"> '.$row['aim'].'</div>
<div class="box4">'.$row['msn'].'</div>
<div class="box4">'.$row['skype'].'</div>
<div class="box4">'.$row['yahoo'].'</div>
</div></div><div class="clear"></div>';
?>
</div>
<?php
if ($row['cmtsdisabled'] == 'yes') {
?>
<div class="container_box1">
<div class="header">Comments Disabled:</div>
<div class="container_box3">You can not post a comment</div>
<div class="clear"></div>
</div>
<?php } ?>
<div class="container_box1">
<div class="header">Member's Comments:</div>
<div class="container_box3">
<div id="messages">
<?php
$query = yasDB_select("SELECT * FROM memberscomments");
$prefix = $setting['siteurl'] . 'templates/' . $setting['theme'] . '/skins/' . $setting['skin'] . '/images/smileys/';
if($query->num_rows == 0) {
echo '<div class="container_box5">This member has no comments, be the first to add one!</div>';
} else {
$query = yasDB_select("SELECT * FROM memberscomments WHERE userid = '$id'");
while($row = $query->fetch_array(MYSQLI_ASSOC)) {
$text = $row['comment'];
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
echo '<div class="container_box5"><div class="comment_box1">Post by - ' . $row['name'] . '</div><div class="comment_box2">' . $text . '</div></div>';
}
}
?>
</div></div>
<div class="clear">
</div>
</div>
<div class="container_box1">
<div class="header">Leave a comment:</div>
<div class="container_box3">
<center><div id="preview"></div></center>
<div id="commentBox">
<div class="container_box4">
<center>
<form name="addcomment" id="addcomment" method="post" action=""><strong>Message:</strong><br />
<textarea name="comment" rows="3" cols="40" id="comment_message"></textarea>
<br />
<input type="hidden" name="timestamp" id="timestamp" value="<?php echo time(); ?>" /><br/>
</center></div>
<div class="container_box4">
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
</center></div></div>
<div class="container_box4">
<center>
<input name="name" type="hidden" value="<?php echo $_SESSION['user'];?>" /><br />
<input type="hidden" name="recaptcha" id="recaptcha" value="no">
<input type="hidden" name="security" id="security" value="10">
<input type="hidden" name="member" value="yes">
<input type="hidden" name="userid" id="userid" value="<?php echo $id; ?>">
<input name="addcomment" type="submit" value="Add Comment" style="border: 1px solid #000; margin-top: 2px;" /><br/><br/>
</form></center></div></div></div>
<div class="clear"></div>
<?php
} 
?>
</div>
