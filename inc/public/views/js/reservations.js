$(document).ready(function() {
	$('.single-list').select2();
	$('.multiple-list').select2({
		placeholder: 'Elija al menos un servicio'
	});
});