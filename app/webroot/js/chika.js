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
	
	$('#ScheduleAddFormModal').submit(function(e) {
		var url = $(this).attr('action');
		var data = $(this).serializeArray();
		$.post(url, data, function(data) {
			if ( data.status ) {
				$('#FormScheduleId').load('/schedules/listing/html', function() {
					$('#FormScheduleId option[value=' + data.schedule_id + ']').attr('selected', 'selected');
					$('#schedule-add-form-modal').modal('hide');
					$('#ScheduleAddFormModal')[0].reset();
				});
			} else {
				alert(data.msg);
			}
		}, 'json');
		e.preventDefault();
	});
	
});