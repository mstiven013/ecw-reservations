$(document).ready(function() {
	$('.single-list').select2();
	$('.multiple-list').select2({
		placeholder: 'Elija al menos un servicio'
	});

	//Run functions
	formFunction();
	Datepicker();
	Timepicker();
	formStepperFunction();
});

//Create vars
const urlReservations = info.ecw_url + "/inc/models/class.Reservations.php";

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
		align: 'left',
		default: 'now',
		donetext: 'Seleccionar',
		twelvehour: true
	});

}

//Form stepper global function
const formStepperFunction = () => {

	const leftBtn = $('#ecw_left-btn');
	const rightBtn = $('#ecw_right-btn');

	//LEFT BUTTON FUNCTION
	leftBtn.on('click', function() {
		if(!$(this).hasClass('reset')) {
			$('#second-step').fadeOut('slow');

			setTimeout(function() {

				//Change attributes of left btn
				leftBtn.val('Limpiar');
				leftBtn.removeClass('goback').addClass('reset');

				//Change attributes of right btn
				rightBtn.val('Continuar');
				rightBtn.attr('type', 'button');

				//Show first step
				$('#first-step').fadeIn('slow');

			}, 500);
		}
	});

	//RIGHT BUTTON FUNCTION
	rightBtn.on('click', function() {

		if($(this).hasClass('continue')) {
			if(requiredFieldsFirstStep()) {

				$('#first-step').fadeOut('slow');
				setTimeout(function() {

					//Change attributes of left btn
					leftBtn.val('Regresar');
					leftBtn.removeClass('reset').addClass('goback');

					//Change attributes of right btn
					rightBtn.val('Agendar');
					rightBtn.attr('type', 'submit');

					//Show second step
					$('#second-step').fadeIn('slow');

				}, 500);

			}
		}

	});
}

//Form Functions
const formFunction = () => {

	//Prevent writte on date & hour inputs
	$('input#reservation_date, input#reservation_hour').keypress(function(){
		return false;
	});

	let frm = $('#reservation');
	const reqs = $('.required');
	const mRes = $('.modal-reservation');

	frm.on('submit', function(e) {
		e.preventDefault();

		if(requiredFieldsSecondStep()) {

			mRes.fadeIn();

			let data_send = frm.serialize();
			console.log(data_send)

			$.ajax({
				method: "POST",
				url: urlReservations,
				data: data_send
			}).done(function(resp){
			    console.log(resp);
				resp = JSON.parse( resp );				
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

}

const requiredFieldsFirstStep = () => {

	const reqs = $('#first-step .required');
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

	return flag;
}

const requiredFieldsSecondStep = () => {

	const reqs = $('#second-step .required');
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

	return flag;
}

const getResponse = (resp) => {

	let word = '';
	let frm = $('#reservation');

	//Get resp action
	switch(resp.action) {
		case 'create':
			word = 'creado';
			break;
	}

	//Get resp code response
	switch (resp.code) {
		case 200:

			//Change image modal
			$('.modal-reservation #spinner').css('display', 'none');
            $('.modal-reservation #check').css('display', 'inline-block');

            //Change step form
            $('#second-step').fadeOut('slow');
            $('#first-step').fadeIn('slow');

            //Show checked
            setTimeout(function() {
            	//Reset form
            	frm[0].reset();
            	$('#reservation #category_id').val(0).trigger('change');
				$('#reservation #service_id').val(0).trigger('change');
				$('#reservation #employee_id').val(0).trigger('change');

				//Add checked info to modal
                $('.modal-reservation #check').addClass('checked');
                $('.modal-reservation #text-modal').fadeOut();
                $('.modal-reservation #text-modal').html('¡Tu reserva se creó exitosamente!');
                $('.modal-reservation #text-modal').fadeIn();
            }, 200);
            
            //Hide modal
            setTimeout(function(){
                $('.modal-reservation').fadeOut();
            }, 3000);

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

}