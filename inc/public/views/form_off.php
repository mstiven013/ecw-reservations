<?php include(dirname(__FILE__, 3) . '/functions.php'); ?>

<form class="reservation" id="reservation" method="POST">
	
	<!--FIRST STEP-->
	<div <?php (esc_attr(get_option('ecwr_onestep_form'))  == "si") ? 'id="first-step"' : '' ?> >
		<div class="row">
			<div class="col-12 col-md-6 col-lg-6 form-group">
				<label for="reservation_date">
					<span class="req">*</span> <?php _e('Fecha de la reserva:', ECWR_NS); ?>
				</label>
				<input type="text" class="form-control required" autocomplete="off" id="reservation_date" name="reservation_date" placeholder="<?php _e('Seleccione la fecha...', ECWR_NS); ?>">
				<p id="reservation_date-error" class="error"></p>
			</div>

			<div class="col-12 col-md-6 col-lg-6 form-group">
				<label for="reservation_hour">
					<span class="req">*</span> <?php _e('Hora de la reserva:', ECWR_NS); ?>
				</label>
				<input type="text" class="form-control required" autocomplete="off" id="reservation_hour" name="reservation_hour" placeholder="<?php _e('Seleccione la hora...', ECWR_NS); ?>">
				<p id="reservation_hour-error" class="error"></p>
			</div>

			<div class="col-12 col-md-6 col-lg-6 form-group">

				<label for="category_id">
					<span class="req">*</span> <?php _e('Categoría:', ECWR_NS); ?>
				</label>
				<select class="single-list required" name="category_id" id="category_id">
					
					<?php if(count(all_categories()) > 0) { ?>
						<option value="0"><?php _e('Seleccionar una categoría...', ECWR_NS); ?></option>
						<?php foreach (all_categories() as $category) { ?>
							<option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
						<?php } ?>
					<?php } else { ?>
						<option value="0"><?php _e('No hay categorías disponibles...', ECWR_NS); ?></option>
					<?php } ?>

				</select>
				<p id="category_id-error" class="error"></p>

			</div>

			<div class="col-12 col-md-6 col-lg-6 form-group">

				<label for="service_id">
					<span class="req">*</span> <?php _e('Servicio:', ECWR_NS); ?>
				</label>
				<select class="single-list required" name="service_id" id="service_id">

					<?php if(count(all_services()) > 0) { ?>
						<option value="0"><?php _e('Seleccionar un servicio...', ECWR_NS); ?></option>
						<?php foreach (all_services() as $service) { ?>
							<option value="<?php echo $service->id; ?>"><?php echo $service->title; ?></option>
						<?php } ?>
					<?php } else { ?>
						<option value="0"><?php _e('No hay categorías disponibles...', ECWR_NS); ?></option>
					<?php } ?>

				</select>
				<p id="service_id-error" class="error"></p>

			</div>
		</div>

		<div class="row">
			<div class="col-12 form-group">
				
				<label for="employee_id">
					<span class="req">*</span> <?php _e('Empleado:', ECWR_NS); ?>
				</label>
				<select class="single-list required" name="employee_id" id="employee_id">

					<?php if(count(all_employees()) > 0) { ?>
						<option value="0"><?php _e('Seleccionar un empleado...', ECWR_NS); ?></option>
						<?php foreach (all_employees() as $employee) { ?>
							<option value="<?php echo $employee->id; ?>"><?php echo $employee->name . ' ' .$employee->lastname; ?></option>
						<?php } ?>
					<?php } else { ?>
						<option value="0"><?php _e('No hay empleados disponibles...', ECWR_NS); ?></option>
					<?php } ?>

				</select>
				<p id="employee_id-error" class="error"></p>

			</div>
		</div>
	</div>

	<!--SECOND STEP-->
	<div <?php (esc_attr(get_option('ecwr_onestep_form'))  == "si") ? 'id="second-step"' : '' ?> >
		<div class="row">
			<div class="col form-group">
				<h2>Detalles personales</h2>
			</div>
		</div>

		<div class="row">
	  		<div class="col-12 form-group">
		  		<label for="person_name"><span class="req">*</span> Nombre completo del usuario:</label>
		  		<input type="text" class="form-control required" id="person_name" name="person_name" placeholder="Escribe el nombre completo del usuario..." value="">
		  		<p id="person_name-error" class="error"></p>
		  	</div>

		  	<div class="col-12 col-md-6 col-lg-6 form-group">
		  		<label for="person_phone"><span class="req">*</span> Número de teléfono / celular del usuario:</label>
		  		<input type="text" class="form-control required" id="person_phone" name="person_phone" placeholder="Escribe el número celular del usuario del usuario..." value="">
		  		<p id="person_phone-error" class="error"></p>
		  	</div>

		  	<div class="col-12 col-md-6 col-lg-6 form-group">
		  		<label for="person_email"><span class="req">*</span> Correo electrónico del usuario:</label>
		  		<input type="person_email" class="form-control required" id="person_email" name="person_email" placeholder="Escribe el correo electrónico del usuario..." value="">
		  		<p id="person_email-error" class="error"></p>
		  	</div>

		  	<div class="col-12 form-group">
		  		<label for="aditional_notes">Notas adicionales:</label>
		  		<textarea class="form-control" name="aditional_notes" id="aditional_notes" placeholder="Escribe aquí las notas adicionales de la reserva en caso de que existan..."></textarea>
		  		<p id="aditional_notes-error" class="error"></p>
		  	</div>
	  	</div>
	</div>
	
	<div class="row buttons-bar">
		<div class="col text-left">
			<input type="button" id="ecw_left-btn" class="btn reset" value="Limpiar">
		</div>
		<div class="col text-right">
			<input type="hidden" id="src" name="src" value="reservations">
	  		<input type="hidden" id="action" name="action" value="create">
			<input type="button" id="ecw_right-btn" class="btn continue" value="Continuar">
		</div>
	</div>

</form>

<div class="modal-reservation">
    <div class="body">
        <img id="spinner" class="icons" src="<?php echo ECWR_DIR ?>inc/public/views/img/spinner.png">
        <img id="check" class="icons" src="<?php echo ECWR_DIR ?>inc/public/views/img/check.png">
        <p class="subtitle color-blue" id="text-modal">Espera un momento...</p>
    </div>
</div>