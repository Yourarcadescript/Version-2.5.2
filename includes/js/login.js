$('document').ready(function()	{
	$('#login').ajaxForm( {
		url: siteurl + 'includes/login_check.php',
		target: '#message',
		clearForm: true,
		success: function() {
			var searchString = /Logging/;
			if (msg.search(searchString) != -1) {
				// send to url
				window.location.replace(siteurl);
			}
			else {
				var msg = $("#message").html();
			}
		}
	}
});