$(document).ready(function () {

	//$('#profileForm').hide();
	//$('#mesagesList').hide();


	$('#datosPersonales').click(function() {
		$('#profileForm').toggle(500);
	});
	
	$('#profileMessages').click(function() {
		$('#mesagesList').toggle(500);
	});
});