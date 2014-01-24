$('document').ready(function() {
	$('#profile').ajaxForm( {
		url: siteurl + 'includes/profile_update.php',
		type: 'post',
		target: '#preview',
		clearForm: false, 
		success: function() {
			var msg = $("#preview").html();
			var searchString = /updated/;
			if (msg.search(searchString) != -1) {
				$('#profileBox').slideUp('slow');
			}
		}		
	});
});