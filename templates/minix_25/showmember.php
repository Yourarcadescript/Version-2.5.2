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
	}
	if ( $row['location'] != '') {
		$location = ''. $row['location'].'<br>';
	} else {
		$location = 'Place where you stay.<br>';
	}
	if ( $row['job'] != '') {
		$occupation = ''. $row['job'].'<br>';
	} else {
		$occupation = 'Work place.<br>';
	}
	if ( $row['useavatar'] == '1' ) {
		$avatarimage = $setting['siteurl'] . 'avatars/' . $row['avatarfile'];
	}else { 
		$avatarimage = $setting['siteurl'] . 'avatars/useruploads/noavatar.JPG';
	}
	if ($setting['seo'] == 'yes') {
	   $membersprofile = $setting['siteurl'].'profile.html';
	} else {
	   $membersprofile = $setting['siteurl'].'index.php?act=profile';
	}
	?>
	<div class="containbox2">
	<div class="profile">
	<ul>
	<li class="title">Username: <?php echo $row['username'];?></li>
	<li class="profilepic"><img src="<?php echo $avatarimage;?>" width="130" height="100">
	<br/>
	<a href="<?php echo $membersprofile;?>">Edit Profile</a>
	<hr><?php echo $website;?><hr>
	</li>
	</ul>
	<ul>
	<li class="title2">About Me</li>
	<li class="aboutme"><?php echo $row['aboutme'];?></li>
	</ul>
	</div>
	<div class="clear"></div>
	<div class="profile2">
	<ul>
	<li class="info2">Location:</li>
	<li class="info2">Joined:</li>
	<li class="info2">Plays:</li>
	<li class="info2">Points:</li>
	<li class="info2">Occupation:</li>
	</ul>
	<ul>
	<li class="info"><?php echo $location;?></li>
	<li class="info"><?php echo $joined;?></li>
	<li class="info"><?php echo $row['plays'];?></li>
	<li class="info"><?php echo $points;?></li>
	<li class="info"><?php echo $occupation;?></li>
	</ul>
	<ul>
	<li class="info2">AIM:</li>
	<li class="info2">MSN:</li>
	<li class="info2">Skype:</li>
	<li class="info2">Yahoo:</li>
	</ul>
	<ul>
	<li class="info"><?php echo $row['aim'];?></li>
	<li class="info"><?php echo $row['msn'];?></li>
	<li class="info"><?php echo $row['skype'];?></li>
	<li class="info"><?php echo $row['yahoo'];?></li>
	</ul>
	</div>
	</div>
	<div class="clear"></div>
	</div>
	<?php
}
?>