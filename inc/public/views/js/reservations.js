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

//Datepicker init function
const Datepicker = () => {

	const dp = $('#reservation_date');
	
	dp.datepicker({
		language: "es",
		todayBtn: "enabled",
		clearBtn: true,
		autoclose: true,
		format: 'MM dd, yyyy',
		changeMonth: true,
        changeYear: true
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
	});
}

//Form Functions
const formFunction = () => {

	//Prevent writte on date & hour inputs
	$('input#reservation_date, input#reservation_hour').keypress(function(){
		return false;
	});

	//Onsubmit form function
	$('form#reservation').on('submit', function(e) {
		e.preventDefault();
	});

}