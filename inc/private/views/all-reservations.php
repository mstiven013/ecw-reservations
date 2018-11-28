<?php include(dirname(__FILE__, 3) . '/functions.php'); ?>

<div class="wrap ecw_reservations">

	<h1><?php _e('Reservas', ECWR_NS); ?></h1>

	<table id="reservations" class="datatable">
		<thead>
			<tr>
				<th>ID:</th>
				<th>Correo electrónico:</th>
				<th>Fecha:</th>
				<th>Hora:</th>
				<th></th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th>ID:</th>
				<th>Correo electrónico:</th>
				<th>Fecha:</th>
				<th>Hora:</th>
				<th></th>
			</tr>
		</tfoot>
	</table>

	<div class="modal fade modal-reservations " tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="modal-title">Crear reserva:</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

			    </div>
			    <div class="modal-body">

			    	<form id="reservations-form">

			    		<div class="row">
							<div class="col-12 col-md-6 col-lg-6 form-group">
								<label for="reservation_date"><span class="req">*</span> Fecha de la reserva:</label>
								<input type="text" class="form-control required" autocomplete="off" id="reservation_date" name="reservation_date" placeholder="Seleccione la fecha...">
								<p id="reservation_date-error" class="error"></p>
							</div>

							<div class="col-12 col-md-6 col-lg-6 form-group">
								<label for="reservation_hour"><span class="req">*</span> Hora de la reserva:</label>
								<input type="text" class="form-control required" autocomplete="off" id="reservation_hour" name="reservation_hour" placeholder="Seleccione la hora...">
								<p id="reservation_hour-error" class="error"></p>
							</div>

							<div class="col-12 col-md-6 col-lg-6 form-group">

								<label for="category_id"><span class="req">*</span> Categoría:</label>
								<select class="single-list required" name="category_id" id="category_id">
									
									<?php if(count(all_categories()) > 0) { ?>
										<option value="0">Seleccionar una categoría...</option>
										<?php foreach (all_categories() as $category) { ?>
											<option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
										<?php } ?>
									<?php } else { ?>
										<option value="0">No hay categorías disponibles...</option>
									<?php } ?>

								</select>
								<p id="category_id-error" class="error"></p>

							</div>

							<div class="col-12 col-md-6 col-lg-6 form-group">

								<label for="service_id"><span class="req">*</span> Servicio:</label>
								<select class="single-list required" name="service_id" id="service_id">

									<?php if(count(all_services()) > 0) { ?>
										<option value="0">Seleccionar un servicio...</option>
										<?php foreach (all_services() as $service) { ?>
											<option value="<?php echo $service->id; ?>"><?php echo $service->title; ?></option>
										<?php } ?>
									<?php } else { ?>
										<option value="0">No hay categorías disponibles...</option>
									<?php } ?>

								</select>
								<p id="service_id-error" class="error"></p>

							</div>
						</div>

						<div class="row">
							<div class="col-12 form-group">
								
								<label for="employee_id"><span class="req">*</span> Empleado:</label>
								<select class="single-list required" name="employee_id" id="employee_id">

									<?php if(count(all_employees()) > 0) { ?>
										<option value="0">Seleccionar un empleado...</option>
										<?php foreach (all_employees() as $employee) { ?>
											<option value="<?php echo $employee->id; ?>"><?php echo $employee->name . ' ' .$employee->lastname; ?></option>
										<?php } ?>
									<?php } else { ?>
										<option value="0">No hay empleados disponibles...</option>
									<?php } ?>

								</select>
								<p id="employee_id-error" class="error"></p>

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
						  		<textarea name="aditional_notes" id="aditional_notes" placeholder="Escribe aquí las notas adicionales de la reserva en caso de que existan..."></textarea>
						  		<p id="aditional_notes-error" class="error"></p>
						  	</div>
					  	</div>

					  	<div class="form-group">
					  		<input type="hidden" id="src" name="src" value="reservations">
					  		<input type="hidden" id="action" name="action" value="">
					  		<input type="hidden" id="id" name="id" value="">
					  		<input type="submit" id="send" class="send-btn" value="Crear reserva">
					  	</div>

					</form>

			    </div>
			</div>
		</div>
	</div>

	<div class="modal fade modal-success" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
			    <div class="modal-body">
			    	<p id="success-text"></p>
			    	<button id="success-btn" class="send-btn close-modal"></button>
			    </div>
			</div>
		</div>
	</div>

</div>