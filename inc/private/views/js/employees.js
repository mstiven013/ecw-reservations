jQuery(function($){

	initDataTable();
	formFunctions();

});

//Form modal
const modal = $('.modal-employees');
const modalTitle = $('#modal-title');

//Success modal
const successModal = $('.modal-success');
const successText = $('#success-text');
const successBtn = $('#success-btn');

var urlEmployees = info.ecw_url + "/inc/models/class.Employees.php";

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

	var table = $('#employees').DataTable({
		"language": langDataTables,
		"ajax": {
			"method": "POST",
			"url": urlEmployees,
			"data": {
				"action": "get_all",
				"src": "employees"
			}
		},
		"columns": [
			{"data": "id"},
			{"data": "name"},
			{"data": "lastname"},
			{"data": "email"},
			{"data": "mobile"},
			{"defaultContent": "<input type='button' class='button modificar' value='Modificar'>", "className": "actions"}
		],
		"dom": "Blfrtip",
		"buttons": [
			{
				"text": 'Agregar empleado',
				"className": "button",
				"action": function ( e, dt, node, config ) {
					modalAddEmployee();
				}
			},
			{
				"extend": 'excel',
				"text": 'Exportar a Excel',
				"className": "button",
				"filename": "Empleados - " + info.sitename,
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

		modalTitle.html('Modificar empleado:'); // Change modal title

		let data = table.row($(this).parents("tr")).data(); // Get row data
		console.log(data)

		//Change form values
		let action = $('#employees-form #action').val('update');
		let id = $('#employees-form #id').val(data.id);
		let name = $('#employees-form #name').val(data.name);
		let lastname = $('#employees-form #lastname').val(data.lastname);
		let phone = $('#employees-form #phone').val(data.phone);
		let mobile = $('#employees-form #mobile').val(data.mobile);
		let email = $('#employees-form #email').val(data.email);
		let address = $('#employees-form #address').val(data.address);
		let office = $('#employees-form #office').val(data.office);

		let button = $('#employees-form #send').val('Modificar empleado');

		modal.modal('show');

	});
}

const modalAddEmployee = () => {

	modalTitle.html('Agregar empleado:'); // Change modal title

	//Change form values
	let action = $('#employees-form #action').val('create');
	let id = $('#employees-form #id').val('');
	let name = $('#employees-form #name').val('');
	let lastname = $('#employees-form #lastname').val('');
	let phone = $('#employees-form #phone').val('');
	let mobile = $('#employees-form #mobile').val('');
	let email = $('#employees-form #email').val('');
	let address = $('#employees-form #address').val('');
	let office = $('#employees-form #office').val('');

	let button = $('#employees-form #send').val('Agregar empleado');

	modal.modal('show');

}

const formFunctions = () => {

	const frm = $('#employees-form');
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

			console.log(send);

			$.ajax({
				method: "POST",
				url: urlEmployees,
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

	console.log(data)

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
			successText.html(`El empleado se ha ${word} correctamente`);

			break;

		case 500:

			successBtn.html('Cerrar');
			successText.html(`Ha ocurrido un error, por favor intentarlo de nuevo.`);

			break;

		case 409:

			successBtn.html('Cerrar');
			successText.html('Ya existe un empleado con estos datos.');

			break;

		default:

			successBtn.html('Cerrar');
			successText.html(`El empleado se ha ${word} correctamente`);

			break;
	}

	successModal.modal('show');

}