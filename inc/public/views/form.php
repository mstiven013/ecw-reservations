<form>

	<div class="row">
		<div class="col form-group">
			<h2>Detalles del servicio</h2>
		</div>
	</div>

	<div class="row">
		<div class="col form-group">
			<input type="text" id="date" name="date" placeholder="Seleccione la fecha...">
		</div>
	</div>

	<div class="row">
		<div class="col form-group">
			<input type="text" id="hour" name="hour" placeholder="Seleccione la hora...">
		</div>
	</div>
	
	<div class="row">
		<div class="col form-group">
			<select class="single-list" name="category" id="category">
				<option value="0">Seleccionar una categoría...</option>
				<option value="1">Prueba 1</option>
				<option value="2">Test</option>
			</select>
		</div>

		<div class="col form-group">
			<select class="single-list" name="service" id="service">
				<option value="0">Seleccionar un servicio...</option>
				<option value="1">Prueba 1</option>
				<option value="2">Test</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col form-group">
			<select class="single-list" name="employee" id="employee">
				<option value="0">Seleccionar un empleado...</option>
				<option value="1">Prueba 1</option>
				<option value="2">Test</option>
			</select>
		</div>
	</div>

	<div class="row">
		<div class="col form-group">
			<h2>Detalles personales</h2>
		</div>
	</div>

	<div class="row">
		<div class="col form-group">
			<input type="text" id="name" name="name" placeholder="Escribe tu nombre completo...">
		</div>
	</div>
	
	<div class="row">
		<div class="col form-group">
			<input type="text" id="phone" name="phone" placeholder="Número de teléfono / Celular...">
		</div>

		<div class="col form-group">
			<input type="email" id="email" name="email" placeholder="Correo electrónico...">
		</div>
	</div>

	<div class="row">
		<div class="col form-group">
			<textarea id="aditional-notes" name="aditional-notes" placeholder="Notas adicionales..."></textarea>
		</div>
	</div>

	<div class="row">
		<div class="col form-group">
			<input type="submit" class="button primary" value="Reservar ahora">
		</div>
	</div>

</form>