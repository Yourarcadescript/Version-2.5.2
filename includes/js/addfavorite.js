function addFavorite(title,gameid) {
	$.get(siteurl + 'includes/addfavorite.inc.php', { gid: gameid } );
	showNotification({
		message: title + " successfully added to your favorites!",
		type: "success",
		autoClose: true,
		duration: 3
	});
}