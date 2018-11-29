$(document).ready(function() {
	$('.single-list, .select2-list').select2();
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

	console.log(info);

	const dp = $('.date-select');

	//Define min date
	let minDate = new Date();
	if(info.min_date != '1') {
		minDate = info.min_date;
	}

	//Define max date
	let maxDate = '2050-12-31';
	if(info.max_date != '1') {
		maxDate = info.max_date;
	}

	//Disabled days
	let disabledDays = [];
	if(info.disabled_days !== '') {
		disabledDays = info.disabled_days;
	}

	//Disabled dates
	let disabledDates = [];
	if(info.disabled_dates !== '') {
		disabledDates = info.disabled_dates.split(",");
	}

	dp.datepicker({
		language: "es",
		clearBtn: true,
		autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
        changeYear: true,
        startDate: minDate,
        endDate: maxDate,
        daysOfWeekDisabled: disabledDays,
        datesDisabled: disabledDates
	});

}

//Timpicker init function
const Timepicker = () => {

	//Defining timepicker selector var
	const cp = $('.hour-select');

	//Defining minutes range step
	let minutes_step = 30;
	if(info.range_time !== '') {
		minutes_step = parseInt(info.range_time);
	}

	//Defining min hour for select
	let min_hour = info.min_time.split(':')[0];
	let min_minute = info.min_time.split(':')[1].split('-')[0];
	let min_mer = info.min_time.split(':')[1].split('-')[1];

	let minimum = parseInt(min_minute) + parseInt(min_hour) * 60; //Summary for all minimum time

	//Defining max hour for select
	let max_hour = info.max_time.split(':')[0];
	let max_minute = info.max_time.split(':')[1].split('-')[0];
	let max_mer = info.max_time.split(':')[1].split('-')[1];

	let maximum = parseInt(max_minute) + parseInt(max_hour) * 60; //Summary for all maximum time

	cp.timepicker({
		showMeridian: true,
		defaultTime: 'current',
		minuteStep: minutes_step,
		maxHours: 24
	}).on('changeTime.timepicker', function(e) {
	    var h = e.time.hours;
	    var m = e.time.minutes;
	    var mer = e.time.meridian;

	    //convert hours into minutes
	    m += h * 60;

	    //Min time
	    if((mer == min_mer && mer != max_mer) && (m < minimum && m !== 720)) {
	        cp.timepicker('setTime', info.min_time);
	    } else if((mer != min_mer && mer == max_mer) && (m > maximum && m !== 720)) {
	        cp.timepicker('setTime', info.max_time);
	    }
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
	$('input.hour-select, input.date-select').keypress(function(){
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

	const successModal = $('.modal-success');
	const successText = $('#success-text');
	const successBtn = $('#success-btn');

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

			//Add checked info to modal
            $('.modal-reservation #check').addClass('checked');
            $('.modal-reservation #text-modal').fadeOut();
            $('.modal-reservation #text-modal').html('Ha ocurrido un error, intentalo de nuevo');
            $('.modal-reservation #text-modal').fadeIn();

			break;

		default:

			successBtn.html('Cerrar');
			successText.html(`Ha ocurrido un error, por favor intentarlo de nuevo.`);

			break;
	}

}