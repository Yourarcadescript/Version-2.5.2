function changeur1() {
	location.href =  siteurl + 'search/'+ $("#q").val() + '/page1/';
	return false;
};
$('document').ready(function()	{		
	$('#searchForm').ajaxForm( {		
		type: 'post',
		beforeSubmit: function() {
			return changeur1();
		}
	});
});