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
	
	$('#searchfield').typeahead({
		items: 15,
		minLength: 2,
		source: function (query, process) {
	        return $.getJSON('/registros/buscar.json', { q: query }, function (response) {
				var data = [];
                for (var i in response) {
					data.push(response[i].id + ':' + response[i].folio + ':' + response[i].name);
                }
				return process(data);
	        });
	    },
	    highlighter: function (item) {
			var parts = item.split(':');
			var html = parts[2] + ' (Folio: ' + parts[1] + ')';
			return html;
        },
	    updater: function(item) {
	    	var parts = item.split(':');
	    	var actionUrl = '/registros/ver/' + parts[0];
	    	window.location = actionUrl;
	    	return parts[2];
	    }
	});
	
	$('#FormCommerceOrder').typeahead({
		items: 5,
		minLength: 3,
		source: function (query, process) {
			return $.getJSON('/files/commerce_orders.json', { query: query }, function (data) {
				return process(data);
			});
		}
	});
	
});