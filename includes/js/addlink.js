$('document').ready(function() {
	$('#addlink').ajaxForm( {
		url: siteurl + 'templates/' + theme + '/ajax/process_linkrequest.php',
		type: 'post',
		target: '#preview',
		clearForm: false, 
		success: function() {
			var msg = $("#preview").html();
			var searchString = /approve/;
			if (msg.search(searchString) != -1) {
				$('#contactBox').slideUp('slow');
			}
			else {
				document.getElementById('security').value = '';
			}
		}
	});
});