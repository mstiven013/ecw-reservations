jQuery(function($){

	$('.single-list').select2();
	$('.multiple-list').select2({
		placeholder: 'Elija al menos servicio'
	});

	//Run functions
	Datepicker();
	Timepicker();
	initDataTable();
	formFunctions();

});

const modal = $('.modal-reservations');
const modalTitle = $('#modal-title');

const successModal = $('.modal-success');
const successText = $('#success-text');
const successBtn = $('#success-btn');

var urlReservations = info.ecw_url + "/inc/models/class.Reservations.php";

const initDataTable = () => {
	//Data table of users
	var langDataTables = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		};

	var table = $('#reservations').DataTable({
		"language": langDataTables,
		"ajax": {
			"method": "POST",
			"url": urlReservations,
			"data": {
				"action": "get_all",
				"src": "reservations"
			}
		},
		"columns": [
			{"data": "id"},
			{"data": "person_name"},
			{"data": "person_email"},
			{"data": "reservation_date"},
			{"data": "reservation_hour"},
			{"data": "category_title"},
			{"data": "service_title"},
			{"defaultContent": "<input type='button' class='button modificar' value='Modificar'> <input type='button' class='button delete' value='Borrar'>", "className": "actions"}
		],
		"dom": "Blfrtip",
		"buttons": [
			{
				"text": 'Crear una reserva',
				"className": "button",
				"action": function ( e, dt, node, config ) {
					modalAddReservation();
				}
			},
			{
				"extend": 'excel',
				"text": 'Exportar a Excel',
				"className": "button",
				"filename": "Reservas - " + info.sitename,
				"exportOptions": {
					"modifier": {
						"order":  'current',
						"page":   'all',
						"search": 'none',
					}
				}
			}
		]

	});

	modalReservationUpdate('.datatable tbody', table);
	deleteReservation('.datatable tbody', table);
}

//Datepicker init function
const Datepicker = () => {

	const dp = $('#reservation_date');
	
	dp.datepicker({
		language: "es",
		clearBtn: true,
		autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
        changeYear: true,
        startDate: new Date()
	});

}

//Timpicker init function
const Timepicker = () => {

	const cp = $('#reservation_hour');

	cp.clockpicker({
	    default: 'now',
		align: 'left',
		donetext: 'Seleccionar',
		twelvehour: true
	});

}

const modalReservationUpdate = (tbody, table) => {

	$(tbody).on('click', 'input.modificar', function() {

		modalTitle.html('Modificar reserva:'); // Change modal title

		let data = table.row($(this).parents("tr")).data(); // Get row data

		//Change form values
		let id = $('#reservations-form #id').val(data.id);
		let action = $('#reservations-form #action').val('update');
		let reservation_date = $('#reservations-form #reservation_date').val(data.reservation_date);
		let reservation_hour = $('#reservations-form #reservation_hour').val(data.reservation_hour);
		let category_id = $('#reservations-form #category_id').val(data.category_id).trigger('change');
		let service_id = $('#reservations-form #service_id').val(data.service_id).trigger('change');
		let employee_id = $('#reservations-form #employee_id').val(data.employee_id).trigger('change');
		let person_name = $('#reservations-form #person_name').val(data.person_name);
		let person_phone = $('#reservations-form #person_phone').val(data.person_phone);
		let person_email = $('#reservations-form #person_email').val(data.person_email);
		let aditional_notes = $('#reservations-form #aditional_notes').val(data.aditional_notes);

		let button = $('#reservations-form #send').val('Modificar reserva').removeAttr('disabled');

		modal.modal('show');

	});
}

const modalAddReservation = () => {

	modalTitle.html('Crear reserva:'); // Change modal title

	//Change form values
	let action = $('#reservations-form #action').val('create');
	let reservation_date = $('#reservations-form #reservation_date').val('');
	let reservation_hour = $('#reservations-form #reservation_hour').val('');
	let category_id = $('#reservations-form #category_id').val(0).trigger('change');
	let service_id = $('#reservations-form #service_id').val(0).trigger('change');
	let employee_id = $('#reservations-form #employee_id').val(0).trigger('change');
	let person_name = $('#reservations-form #person_name').val('');
	let person_phone = $('#reservations-form #person_phone').val('');
	let person_email = $('#reservations-form #person_email').val('');
	let aditional_notes = $('#reservations-form #aditional_notes').val('');
	let button = $('#reservations-form #send').val('Crear reserva').removeAttr('disabled');

	modal.modal('show');

}

const deleteReservation = (tbody, table) => {

	$(tbody).on('click', 'input.delete', function() {
		let data = table.row($(this).parents("tr")).data(); // Get row data

		$.ajax({
			method: "POST",
			url: urlReservations,
			data: {
				"src": "reservations",
				"action": "delete",
				"id": data.id
			},
		}).done(function(deleted){
			let json_info = JSON.parse( deleted );
			$('.datatable').DataTable().ajax.reload();
		});
	});

}

const formFunctions = () => {
	//Prevent writte on date & hour inputs
	$('input#reservation_date, input#reservation_hour').keypress(function(){
		return false;
	});

	const frm = $('#reservations-form');
	const reqs = $('form .required');

	frm.on('submit', function(e) {
		e.preventDefault();

		let flag = true;

		reqs.each(function() {
			let v = $(this).val();

			if(v === '' || v == ' ' || v === undefined || v === null || v == '0') {

				let errId = '#' + $(this).attr('id') + '-error';

				$(errId).css('display', 'block');
				$(errId).html('Este campo es obligatorio.');

				flag = false;

			}
		});

		if(flag) {

			let data_send = frm.serialize();
			$('#reservations-form #send').val('Creando...').attr('disabled', 'disabled');
			console.log(data_send)

			$.ajax({
				method: "POST",
				url: urlReservations,
				data: data_send
			}).done(function(resp){
			    console.log(resp);
			    console.log(typeof resp);
				resp = JSON.parse( resp );
				console.log(typeof resp);
				modal.modal('hide');
				$('.datatable').DataTable().ajax.reload();
				
				getResponse(resp);
			});

		}
	});

	reqs.on('change keyup', function() {
		let v = $(this).val();

		if(v !== '' && v !== ' ' && v !== undefined && v !== null && v != '0') {
			let errId = '#' + $(this).attr('id') + '-error';
			$(errId).css('display', 'none');
			$(errId).html('');
		}
	});

	$('.close-modal').on('click', function() {
		$('.modal').modal('hide');
	});
}

const getResponse = (resp) => {

	let word = '';
	console.log(resp)

	//Get resp action
	switch(resp.action) {
		case 'create':
			word = 'creado';
			break;

		case 'update':
			word = 'actualizado';
			break;

		default:
			word = 'creado';
			break;
	}

	//Get resp code response
	switch (resp.code) {
		case 200:

			successBtn.html('Cerrar');
			successText.html(`La reserva se ha ${word} correctamente`);

			break;

		case 500:

			successBtn.html('Cerrar');
			successText.html(`Ha ocurrido un error, por favor intentarlo de nuevo.`);

			break;

		case 409:

			successBtn.html('Cerrar');
			successText.html('Ya existe un reserva con este nombre.');

			break;

		default:

			successBtn.html('Cerrar');
			successText.html(`Ha ocurrido un error, por favor intentarlo de nuevo.`);

			break;
	}

	successModal.modal('show');

}