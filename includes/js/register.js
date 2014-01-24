function validate() { 
	var email = $("#email").val();
	//var name = $("#username2").val();
	if ($("#username2").val()) {
		var	name = $("#username2").val();
	}
	else if ($("#username").val()) {
		var	name = $("#username").val();
	}
	var	password = $("#password").val();
	var code = $("#security").val();	
	var codeAlt = $("#code").val();
	var emailFormat = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if (!name || !email || !password) { 
		$("#preview").slideDown('slow').html("<br/><h3>Username, email and password are required!<h3>"); 
		return false; 
	}
	else if (password.length > 26 || password.length < 4) {
	$("#preview").html("<br/><h3>Password must be between 4 and 26 characters!<h3>");
	return false;
	}
	else if (email.search(emailFormat) == -1) {
		$("#preview").html("<br/><h3>Invalid Email Address!<h3>");
		return false
	}
	if (!code) { 
		if (codeAlt) return true;
		$("#preview").html("<br/><h3>Missing Security code!<h3>"); 
		return false; 
	}
	else if (!codeAlt) {
		if (code) return true;
		$("#preview").html("<br/><h3>Missing Security code!<h3>"); 
		return false; 
	}
	return true;
}
$('document').ready(function()	{
	$('#form').ajaxForm( {
		url: siteurl + 'includes/register_check.php',
		beforeSubmit: function() {
			return validate();
		},
		target: '#preview',
		clearForm: false,
		success: function() {
			var msg = $("#preview").html();
			var searchString = /Registered/;
			if (msg.search(searchString) != -1) {
				$('#contactBox').slideUp('slow');
			}
			else {
				if (document.getElementById('security')) {
					document.getElementById('security').value = '';
				}
				else if (document.getElementById('code')) {
					document.getElementById('code').value = '';
				}
			}
		}
	});
});