$('document').ready(function() {
	$('#addcomment').ajaxForm( {
		url: siteurl + 'includes/add_comment.php',
		type: 'post',
		target: '#preview',
		clearForm: false, 
		success: function() {
			var gameid = $("#gameid").val();
			var userid = $("#userid").val();
			var newsid = $("#newsid").val();
			if (userid) {
				$.get(siteurl + 'templates/' + theme + '/ajax/comment_messages.php', {userid: userid}, function(data) {
					$('#messages').html(data);
				});
			}
			else if (newsid) {
				$.get(siteurl + 'templates/' + theme + '/ajax/comment_messages.php', {newsid: newsid}, function(data) {
					$('#messages').html(data);
				});
			}
			else {
				$.get(siteurl + 'templates/' + theme + '/ajax/comment_messages.php', {gameid: gameid}, function(data) {
					$('#messages').html(data);
				});
			}
			var msg = $("#preview").html();
			var searchString = /added/;
			if (msg.search(searchString) != -1) {
				$('#commentBox').slideUp('slow');
			};			
		}		
	});
});