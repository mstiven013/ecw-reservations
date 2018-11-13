jQuery(function($){

	initDataTable();
	formFunctions();

});

const modal = $('.modal-categories');
const modalTitle = $('#modal-title');

const successModal = $('.modal-success');
const successText = $('#success-text');
const successBtn = $('#success-btn');

var urlEmployees = info.ecw_url + "/inc/models/class.Categories.php";

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

	var table = $('#categories').DataTable({
		"language": langDataTables,
		"ajax": {
			"method": "POST",
			"url": urlEmployees,
			"data": {
				"action": "get_all",
				"src": "categories"
			}
		},
		"columns": [
			{"data": "id"},
			{"data": "title"},
			{"data": "description"},
			{"defaultContent": "<input type='button' class='button modificar' value='Modificar'>", "className": "actions"}
		],
		"dom": "Blfrtip",
		"buttons": [
			{
				"text": 'Agregar categoría',
				"className": "button",
				"action": function ( e, dt, node, config ) {
					modalAddCategory();
				}
			},
			{
				"extend": 'excel',
				"text": 'Exportar a Excel',
				"className": "button",
				"filename": "Categorias - " + info.sitename,
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

	modalCategoryUpdate('.datatable tbody', table);
}

const modalCategoryUpdate = (tbody, table) => {

	$(tbody).on('click', 'input.modificar', function() {

		modalTitle.html('Modificar categoría:'); // Change modal title

		let data = table.row($(this).parents("tr")).data(); // Get row data

		//Change form values
		let action = $('#categories-form #action').val('update');
		let id = $('#categories-form #id').val(data.id);
		let title = $('#categories-form #title').val(data.title);
		let description = $('#categories-form #description').val(data.description);
		let button = $('#categories-form #send').val('Modificar categoría');

		modal.modal('show');

	});
}

const modalAddCategory = () => {

	modalTitle.html('Agregar categoría:'); // Change modal title

	//Change form values
	let action = $('#categories-form #action').val('create');
	let title = $('#categories-form #title').val('');
	let description = $('#categories-form #description').val('');
	let button = $('#categories-form #send').val('Agregar categoría');

	modal.modal('show');

}

const formFunctions = () => {

	const frm = $('#categories-form');
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
			successText.html(`La categoría se ha ${word} correctamente`);

			break;

		case 500:

			successBtn.html('Cerrar');
			successText.html(`Ha ocurrido un error, por favor intentarlo de nuevo.`);

			break;

		case 409:

			successBtn.html('Cerrar');
			successText.html('Ya existe un categoría con este nombre.');

			break;

		default:

			successBtn.html('Cerrar');
			successText.html(`La categoría se ha ${word} correctamente`);

			break;
	}

	successModal.modal('show');

}