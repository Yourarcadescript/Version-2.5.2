$('document').ready(function()
{
	function validate() { 
		var email = $("#email").val();
		var name = $("#name").val();
		var recipientname = $("#recipientfname").val();
		var recipientemail = $("#recipientemail").val();		
		var code = $("#code").val();
		var emailFormat = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		var recipientemailFormat = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		if (!name || !email|| !recipientname || !recipientemail || !code ) { 
			$("#preview").slideDown('slow').html("<h3>All fields are required!<h3>"); 
			return false; 
		}
		else if (email.length > 40 || email.length < 1 ) {
		$("#preview").html("<br/><h3>Email must be less than 40 characters!<h3>");
		return false;
		}
		else if (name.length > 26 || name.length < 3 ) {
		$("#preview").html("<br/><h3>Username must be between 3 and 26 characters!<h3>");
		return false;
		}		
		else if (recipientemail.length > 40 || recipientemail.length < 1 ) {
		$("#preview").html("<br/><h3>Email must be less than 40 characters!<h3>");
		return false;
		}
		else if (recipientname.length > 26 || recipientname.length < 3 ) {
		$("#preview").html("<br/><h3>Username must be between 3 and 26 characters!<h3>");
		return false;
		}		
		else if (email.search(emailFormat) == -1) {
			$("#preview").fadeIn(200).html("<h3>Invalid Email Address!<h3>");
				return false
		}
		else if (recipientemail.search(recipientemail) == -1) {
			$("#preview").fadeIn(200).html("<h3>Invalid Email Address!<h3>");
				return false
		}
				return true;
	}
	$('#form').ajaxForm( {
	url: siteurl + 'includes/submitafriend.php',
	type: 'post',
	beforeSubmit: function() {
		return validate();
	},
	target: '#preview',
	success: function() {
		var msg = $("#preview").html();
		var searchString = /Message sent/;
		if (msg.search(searchString) != -1) {
			$('#contactBox').slideUp('slow');
		}
		else {
			document.getElementById('code').value = '';
		}
	}
	});
});