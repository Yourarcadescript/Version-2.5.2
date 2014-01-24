function deleteFavorite(gameid,title,pageno) {
	$.get(siteurl + 'includes/deletefavorite.inc.php', { gid: gameid } );
	$.get(siteurl + 'templates/' + theme + '/ajax/loadfavorites.inc.php', { page: pageno }, function(data) {
		$('.cat').html(data);
	});
	showNotification({
		message: title + " successfully deleted from your favorites!",
		type: "success",
		autoClose: true,
		duration: 3
	});
}