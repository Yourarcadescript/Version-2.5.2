function download_link(link_id) {
    var iframe;
	iframe = document.getElementById("hiddenDownloader");
	if (iframe === null) {
		iframe = document.createElement('iframe');  
		iframe.id = "hiddenDownloader";
		iframe.style.visibility = 'hidden';
		iframe.style.display = 'none';
		document.body.appendChild(iframe);
	}
	iframe.src = siteurl + 'includes/link_download.php?id=' + link_id;
	return false;
}

function download_link_mochi(link_id) {
    var iframe;
	iframe = document.getElementById("hiddenDownloader");
	if (iframe === null) {
		iframe = document.createElement('iframe');  
		iframe.id = "hiddenDownloader";
		iframe.style.visibility = 'hidden';
		iframe.style.display = 'none';
		document.body.appendChild(iframe);
	}
	iframe.src = siteurl + 'includes/link_download_mochi.php?id=' + link_id;
	return false;
}