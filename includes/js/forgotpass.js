$('document').ready(function()
{
	function validate() { 
		var email = $("#useremail").val();
		var name = $("#username").val();
		var emailFormat = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		if (!name || !email) { 
			$("#preview").slideDown('slow').html("<br/><h3>All fields are required!<h3>"); 
			return false; 
		}
		else if (email.search(emailFormat) == -1) {
			$("#preview").fadeIn(200).html("<br/><h3>Invalid Email Address!<h3>");
			return false
		}
		return true;
	}
	$('#formForgot').ajaxForm( {
		url: siteurl + 'includes/forgotpass.inc.php',
		type: 'post',
		beforeSubmit: function() {
			return validate();
		},
		target: '#preview',
		success: function() {
			var msg = $("#preview").html();
			var searchString = /sent/;
			if (msg.search(searchString) != -1) {
				$('#contactBox').slideUp('fast');
			}
		}
	});
});