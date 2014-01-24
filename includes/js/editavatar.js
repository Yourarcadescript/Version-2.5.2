function deleteAvatar(avatarfile) {
	$.get(siteurl + 'includes/deleteavatar.inc.php', { af: avatarfile }, function(data) {
		$('#avatarimage').attr("src", siteurl + 'avatars/' + data);
	});
	$.get(siteurl + 'templates/' + theme + '/ajax/loadavatars.inc.php', { ajax:true }, function(data) {
		$('.avatarBox').html(data);
	});
	showNotification({
		message: "Avatar successfully deleted!",
		type: "success",
		autoClose: true,
		duration: 3
	});
}
function switchAvatar(avatarFile) {
	$('#avatarimage').attr("src", siteurl + 'avatars/' + avatarFile);
	$.get(siteurl + 'includes/updateavatar.inc.php', { addavatar: avatarFile } );
	showNotification({
		message: "Avatar successfully updated!",
		type: "success",
		autoClose: true,
		duration: 3
	});
}
function loadAvatars() {
	$.get(siteurl + 'templates/' + theme + '/ajax/loadavatars.inc.php', { ajax: true }, function(data) {
		$('.avatarBox').html(data);
	});
	showNotification({message: "Avatar successfully uploaded!", type: "success", autoClose: true, duration: 3});
}
jQuery(function($){
	$('.fileUpload').fileUploader({
		autoUpload: false,
		selectFileLabel: 'Select Avatar(s)',
		limit: 102400,
		allowedExtension: 'jpg|jpeg|gif|png',
		onValidationError: function() {
			return showNotification({message: "Invalid file selected!", type: "error", autoClose: true, duration: 3});
		},
		afterUpload: function() {
			return 	loadAvatars();
		},
		afterEachUpload: function() {
			return 	loadAvatars();
		}
	});
});