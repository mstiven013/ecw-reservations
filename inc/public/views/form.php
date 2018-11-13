<?php require_once '../../functions.php'; ?>

<form class="reservation" id="reservation" method="POST">
	
	<!--FIRST STEP-->
	<div id="first-step">
		<div class="row">
			<div class="col form-group">
				<h2>Detalles del servicio</h2>
			</div>
		</div>

		<div class="row">
			<div class="col form-group">
				<label for="reservation_date">Fecha:</label>
				<input type="text" class="form-control" id="reservation_date" name="reservation_date" placeholder="Seleccione la fecha...">
			</div>

			<div class="col form-group">
				<label for="reservation_hour">Hora:</label>
				<input type="text" class="form-control" id="reservation_hour" name="reservation_hour" placeholder="Seleccione la hora...">
			</div>
		</div>
		
		<div class="row">
			<div class="col form-group">

				<label for="category_id">Categoría:</label>
				<select class="single-list" name="category_id" id="category_id">
					
					<?php if(count($all_categories) > 0) { ?>
						<option value="0">Seleccionar una categoría...</option>
						<?php foreach ($all_categories as $category) { ?>
							<option value="<?php echo $category->id; ?>"><?php echo $category->title; ?></option>
						<?php } ?>
					<?php } else { ?>
						<option value="0">No hay categorías disponibles...</option>
					<?php } ?>

				</select>

			</div>

			<div class="col form-group">

				<label for="service_id">Servicio:</label>
				<select class="single-list" name="service_id" id="service_id">

					<?php if(count($all_services) > 0) { ?>
						<option value="0">Seleccionar un servicio...</option>
						<?php foreach ($all_services as $service) { ?>
							<option value="<?php echo $service->id; ?>"><?php echo $service->title; ?></option>
						<?php } ?>
					<?php } else { ?>
						<option value="0">No hay categorías disponibles...</option>
					<?php } ?>

				</select>

			</div>
		</div>

		<div class="row">
			<div class="col form-group">
				
				<label for="employee_id">Empleado:</label>
				<select class="single-list" name="employee_id" id="employee_id">

					<?php if(count($all_employees) > 0) { ?>
						<option value="0">Seleccionar un empleado...</option>
						<?php foreach ($all_employees as $employee) { ?>
							<option value="<?php echo $employee->id; ?>"><?php echo $employee->name; ?></option>
						<?php } ?>
					<?php } else { ?>
						<option value="0">No hay empleados disponibles...</option>
					<?php } ?>

				</select>

			</div>
		</div>
	</div>

	<!--SECOND STEP-->
	<div id="second-step">
		<div class="row">
			<div class="col form-group">
				<h2>Detalles personales</h2>
			</div>
		</div>

		<div class="row">
			<div class="col form-group">
				<input type="text" class="form-control" id="person_name" name="person_name" placeholder="Escribe tu nombre completo...">
			</div>
		</div>
		
		<div class="row">
			<div class="col form-group">
				<input type="text" class="form-control" id="person_phone" name="person_phone" placeholder="Número de teléfono / Celular...">
			</div>

			<div class="col form-group">
				<input type="email" id="person_email" name="person_email" placeholder="Correo electrónico...">
			</div>
		</div>

		<div class="row">
			<div class="col form-group">
				<textarea id="aditional_notes" name="aditional_notes" placeholder="Notas adicionales..."></textarea>
			</div>
		</div>
	</div>
	
	<div class="row buttons-bar">
		<div class="col text-left">
			<input type="button" id="ecw_left-btn" class="btn reset" value="Limpiar">
		</div>
		<div class="col text-right">
			<input type="button" id="ecw_right-btn" class="btn continue" value="Continuar">
		</div>
	</div>

</form>