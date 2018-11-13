jQuery(function($){

	initDataTable();
	formFunctions();

});

const modal = $('.modal-services');
const modalTitle = $('#modal-title');

const successModal = $('.modal-success');
const successText = $('#success-text');
const successBtn = $('#success-btn');

const urlService = info.ecw_url + "/inc/models/class.Services.php";

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

	var table = $('#services').DataTable({
					"language": langDataTables,
					"ajax": {
						"method": "POST",
						"url": urlService,
						"data": {
							"action": "get_all",
							"src": "services"
						}
					},
					"columns": [
						{"data": "id", "className": "id"},
						{"data": "title", "className": "title"},
						{"data": "description", "className": "description"},
						{"defaultContent": "<input type='button' class='button modificar' value='Modificar'>", "className": "actions"}
					],
					"dom": "Blfrtip",
					"buttons": [
						{
							"text": 'Agregar servicio',
							"className": "button",
							"action": function ( e, dt, node, config ) {
								modalAddService();
							}
						},
						{
							"extend": 'excel',
							"text": 'Exportar a Excel',
							"className": "button",
							"filename": "Servicios - " + info.sitename,
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

	modalServiceUpdate('.datatable tbody', table);
}

const modalServiceUpdate = (tbody, table) => {

	$(tbody).on('click', 'input.modificar', function() {

		modalTitle.html('Modificar servicio:'); // Change modal title

		let data = table.row($(this).parents("tr")).data(); // Get row data

		//Change form values
		let action = $('#services-form #action').val('update');
		let id = $('#services-form #id').val(data.id);
		let title = $('#services-form #title').val(data.title);
		let description = $('#services-form #description').val(data.description);
		let button = $('#services-form #send').val('Modificar servicio');

		modal.modal('show');

	});
}

const modalAddService = () => {

	modalTitle.html('Agregar servicio:'); // Change modal title

	//Change form values
	let action = $('#services-form #action').val('create');
	let title = $('#services-form #title').val('');
	let description = $('#services-form #description').val('');
	let button = $('#services-form #send').val('Agregar servicio');

	modal.modal('show');

}

const formFunctions = () => {

	const frm = $('#services-form');
	const reqs = $('form .required');

	frm.on('submit', function(e) {
		e.preventDefault();

		let flag = true;

		reqs.each(function() {
			let v = $(this).val();

			if(v == '' || v == ' ' || v === undefined || v === null) {

				let errId = '#' + $(this).attr('id') + '-error';

				$(errId).css('display', 'block');
				$(errId).html('Este campo es obligatorio.');

				flag = false;

			}
		});

		if(flag) {

			let send = frm.serialize();

			//console.log(send);

			$.ajax({
				method: "POST",
				url: urlService,
				data: send
			}).done(function(info){
				var json_info = JSON.parse( info );

				modal.modal('hide');
				$('.datatable').DataTable().ajax.reload();
				
				getResponse(json_info);
			});

		}
	});

	reqs.on('change keyup', function() {
		let v = $(this).val();

		if(v != '' && v != ' ' && v !== undefined && v !== null) {

			let errId = '#' + $(this).attr('id') + '-error';
			$(errId).css('display', 'none');
			$(errId).html('');

		}
	});

	$('.close-modal').on('click', function() {
		$('.modal').modal('hide');
	});

}

const getResponse = (data) => {

	let word = '';

	//Get data action
	switch(data.action) {
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

	//Get data code response
	switch (data.code) {
		case 200:

			successBtn.html('Cerrar');
			successText.html(`El servicio se ha ${word} correctamente`);

			break;

		case 500:

			successBtn.html('Cerrar');
			successText.html(`Ha ocurrido un error, por favor intentarlo de nuevo.`);

			break;

		case 409:

			successBtn.html('Cerrar');
			successText.html('Ya existe un servicio con este nombre.');

			break;

		default:

			successBtn.html('Cerrar');
			successText.html(`El servicio se ha ${word} correctamente`);

			break;
	}

	successModal.modal('show');

}