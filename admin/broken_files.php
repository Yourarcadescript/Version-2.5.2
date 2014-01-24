<script>
function confirmDelete(delUrl) {
	if (confirm("Are you sure you want to delete this game?")) {
	document.location = delUrl;
	}
}
</script>
<div id="center-column">
<div class="top-bar">
<h1><?php $translate->__('Cpanel - Broken Files');?></h1>
<div class="breadcrumbs"><a href="index.php?act=addmedia" title="<?php $translate->__('Add Media');?>"><?php $translate->__('Add Media');?></a> / <a href="index.php?act=addcode" title="<?php $translate->__('Add Code');?>"><?php $translate->__('Add Code');?></a> / <a href="index.php?act=managegames" title="<?php $translate->__('Manage Games');?>"><?php $translate->__('Manage Games');?></a> / <a href="index.php?act=uploadgames" title="<?php $translate->__('Upload Games');?>"><?php $translate->__('Upload Games');?></a></div>
</div><br />
<div class="select-bar">
<label>
<h3><?php $translate->__('Check Broken Files');?></h3>
</label>
</div>
<center><h3><?php $translate->__('The IDs below have broken thumbnails.');?></h3></center><br/>
<p align="center">
<?php
$query = yasDB_select("SELECT id, title, thumbnail FROM games");
while($row = $query->fetch_array(MYSQLI_ASSOC)) {
	if (!file_exists('../' . $row['thumbnail'])) {
	    echo $row['id'] . ' '. $row['title'].'<br/>';
		echo '<a href="index.php?act=managegames&edit=' . $row['id'] . '" class= "broken" >Edit</a>&nbsp;<a href="index.php?act=managegames&delete=' . $row['id'] . '" class="broken" onclick="return confirm(\'Are you sure you want to delete this game?\')">Delete</a><br/><br/>';
	}
}
$query->close();

?>
</p>
<center><h3><?php $translate->__('The IDs below have broken games.');?></h3></center><br/>
<p align="center">
<?php
$query = yasDB_select("SELECT id, title, file FROM games");
while($row = $query->fetch_array(MYSQL_ASSOC)) {
	if (!file_exists('../' . $row['file'])) {
	    echo $row['id'] . ' '. $row['title'].'<br/>';
		echo '<a href="index.php?act=managegames&edit=' . $row['id'] . '" class="broken">Edit</a>&nbsp;<a href="index.php?act=managegames&delete=' . $row['id'] . '" class="broken" onclick="return confirm(\'Are you sure you want to delete this game?\')">Delete</a><br/><br/>';
	}
}
$query->close();

?>
</p>
</div>