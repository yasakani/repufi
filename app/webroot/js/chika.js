$(document).ready(function() {
	
	$('#FormOwnerPhoto').change(function() {
		var placeholder = $(this).val();
		$('#upload-file').attr('placeholder', placeholder);
	});
	
	$('.upload').change(function() {
		var form = $(this).closest('form');
		var placeholder = $(this).val();
		form.children('.upload-file').attr('placeholder', placeholder);
	});
	
});