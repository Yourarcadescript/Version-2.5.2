<?php
if($setting['min-time'] > 0){
session_start();}
else{} //for Anti-Spam time plugin ?>
<div id="center">

    <div class="container_box1">

	<div id="headergames2">Register:</div> 

        <div class="containbox"><noscript>

            <?php

            if (isset($_POST['submit'])) {
        //Anti-time 1 start
        if(isset($_SESSION['start_time'])){ // if it is not set, the form was never visited/generated
          $time = time() - $_SESSION['start_time'];
        if($time < $setting['min_time']) {
          echo $setting['min_time_details'];
          echo "<br/>You took ".$time." seconds to submit the form.<br/><br/>";
        } else {
        //Anti-time 1 end to the captcha and rest            	

				if ($_POST['recaptcha'] == 'yes') {	

					include($setting['sitepath']."/includes/securimage/securimage.php");

					$img = new Securimage();

					$valid = $img->check($_POST['code']);

					if (!$valid) {

						$passed = false;

					} else {

						$passed = true;

					}

				}

				elseif ($_POST['recaptcha'] == 'no') {

					$answer = array('10', 'ten');

					if(!in_array(strtolower($_POST['security']),$answer)) {

						$passed = false;

					} else {

						$passed = true;

					}

				}

                if ($_POST['username']=='' || $_POST['password']=='' || $_POST['repeatpassword']=='') {

					?><script>alert("Sorry username or password,repeatpassword is empty!!");</script>

					<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?php echo $setting['siteurl'].'index.php?act=register';?>">

					<?php

					exit;

				}

				if ($passed) {

				    $id  = yasDB_clean($_POST["id"]);

					$username = yasDB_clean($_POST["username2"]);

					$password = md5(yasDB_clean($_POST["password"]));

					$repeatpassword = md5(yasDB_clean($_POST["repeatpassword"]));

					$name = yasDB_clean($_POST["name"]);

					$email = yasDB_clean($_POST["email"]);;

					$website = yasDB_clean($_POST["website"]);

					$date = time() + (0 * 24 * 60 * 60);  

					$plays = 0;

					$points = 0;

					$randomkey = rand(13649875,98732458);

					$headers = 'From: '.$setting['sitename'].' <'.$setting['sitename'].'>';

					$subject = 'Activate your account at '. $setting['siteurl'];					

					$body = '

					Thank you for becomming a member here at '.$setting['sitename'].'\r\n

					We hope you enjoy our site and what we have to offer.\r\n>

					To activate your account click the link below:\r\n

					'.$setting{'siteurl'}.'activated.php?id='.$id.'=code='.$randomkey.'

					\r\n

					Thanks,

					Admin:';					

					mail($email, $subject, $body, $headers);

						

					$stmt=yasDB_select("SELECT * FROM user WHERE username LIKE '$username'");

					if($stmt->num_rows == 0){

						$stmt = yasDB_insert("INSERT INTO `user` (username, password, repeatpassword, name, email, website, plays, points, date, randomkey, activated) VALUES ('$username','$password','$repeatpassword','$name','$email','$website','$plays','$points', '$date', $randomkey, '0')",false);

						if ($stmt) {

							?><script>alert("Registered: Please check email to activate your account!");</script>

							<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?php echo $setting['siteurl'];?>">

							<?php 

							exit;

						} else {

							$stmt->close();

							?><script>alert("Action Failed");</script> 

							<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?php echo $setting['siteurl'].'index.php?act=register';?>">

							<?php 

							exit;

						}

					} else {  

						$stmt->close();

						?><script>alert("Sorry username or email exists try again!!");</script>

						<META HTTP-EQUIV="Refresh" CONTENT="0; URL=<?php echo $setting['siteurl'].'index.php?act=register';?>">

					<?php }
            } else {
            echo '<span style="color:red;">The security question was answered incorrect.Please try again.</span><br/><br/>';
            }
			}
      //Anti-time 2 start
      unset($_SESSION['start_time']); //Unset the value so that someone cannot keep subbmitting data without revisting the form
            } else {
      // form data subbmitted without visting the form
      echo $setting['min_time_details'];
      echo "<br/>";
      }
}
// form code
$_SESSION['start_time'] = time();
//Anti-time 2 end
			?></noscript>

           <div id="preview"></div><div id="contactBox">
<?php
          if ($setting['regclosed'] == 'yes') {
          echo '<center>Registration is now closed.</center>';
          } else {
          ?>

		   <form name="myform" id="form" action="index.php?act=register" method="post" >

             Username: <br />

             <input class="blue" type="text" name="username2" id="username2" size="35" /><br />

             Password: <br />

             <input class="formsheader" type="password" name="password" id="password" size="35" />

             <Br />

             Repeat Password: <br />

             <input class="formsheader" type="password" name="repeatpassword" id="repeatpassword" size="35" />

             <Br />			 

             Name: <br />

             <input  type="text" name="name" size="35" />

             <br />

             Email: <br />

             <input  type="text" name="email" id="email" size="35" />

             <br />

             Website :<br />

             <input  type="text" name="website" size="35" />

             <br /><br />

              <?php

             if ($setting['userecaptcha'] == "yes") {

				@session_start();

				// securimage captcha

				?>

				<div style="width: 700px; float:left;height: 90px">

				<img id="siimage" align="center" style="padding-right: 5px; border: 0" src="<?php echo $setting['siteurl']; ?>includes/securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" />

				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">

					<param name="allowScriptAccess" value="sameDomain" />

					<param name="allowFullScreen" value="false" />

					<param name="movie" value="<?php echo $setting['siteurl']; ?>includes/securimage/securimage_play.swf?audio=securimage_play.php&bgColor1=#fff&bgColor2=#284062&iconColor=#000&roundedCorner=5" />

					<param name="quality" value="high" />			

					<param name="bgcolor" value="#284062" />

					<embed src="<?php echo $setting['siteurl']; ?>includes/securimage/securimage_play.swf?audio=securimage_play.php&bgColor1=#fff&bgColor2=#284062&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#284062" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />

				 </object>

							

				<!-- pass a session id to the query string of the script to prevent ie caching -->			

				<a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '<?php echo $setting['siteurl']; ?>includes/securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="<?php echo $setting['siteurl']; ?>includes/securimage/images/refresh.gif" alt="Reload Image" border="0" onclick="this.blur()" align="middle" /></a>

				<div style="clear: both"></div>

				</div>			

				Security Code:<br />

				<input type="text" name="code" id="code" size="12" /><br /><br />

				<input name="recaptcha" type="hidden" value="yes" /><?php

				// end securimage captcha

		}

		else {

				?>Security Question: five + five = <br />

				<input name="security" id="security" type="text" style="border: 1px solid #000;" /><br/>

				<input name="recaptcha" type="hidden" value="no" /><?php

		}?>

             <br/>   

             <input type="submit" name="submit" value="Sign Up" />

          </form>

          <br/>*Email is used to reset a forgotten password only.

       

    </div></div>

    <div class="clear"></div>

    </div>
