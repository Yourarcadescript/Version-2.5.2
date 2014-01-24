$('document').ready(function()
{
	function validate() { 
		var email = $("#email").val();
		var name = $("#name").val();
		var	message = $("#message").val();			
		var code = $("#code").val();	
		var emailFormat = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
		if (!name || !email || !message || !code) { 
			$("#preview").slideDown('slow').html("<h3>All fields are required!<h3>"); 
			return false; 
		}
		else if (email.search(emailFormat) == -1) {
			$("#preview").fadeIn(200).html("<h3>Invalid Email Address!<h3>");
				return false
		}
				return true;
	}
	$('#form').ajaxForm( {
	url: siteurl + 'includes/submit.php',
	type: 'post',
	beforeSubmit: function() {
		return validate();
	},
	target: '#preview',
	success: function() {
		var msg = $("#preview").html();
		var searchString = /Thank You/;
		if (msg.search(searchString) != -1) {
			$('#contactslide').slideUp('slow');
		}
		else {
			document.getElementById('code').value = '';
		}
	}
	});
});