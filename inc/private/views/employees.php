<div class="wrap ecw_reservations">

	<h1><?php _e('Empleados', ECWR_NS); ?></h1>

	<table id="employees" class="datatable">
		<thead>
			<tr>
				<th>ID:</th>
				<th>Nombre:</th>
				<th>Apellidos:</th>
				<th>Correo electrónico:</th>
				<th>Celular:</th>
				<th></th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th>ID:</th>
				<th>Nombre:</th>
				<th>Apellidos:</th>
				<th>Correo electrónico:</th>
				<th>Celular:</th>
				<th></th>
			</tr>
		</tfoot>
	</table>

	<div class="modal fade modal-employees " tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="modal-title">Agregar servicio:</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

			    </div>
			    <div class="modal-body">

			    	<form id="employees-form">

					  	<div class="row">
					  		<div class="col-12 col-md-6 col-lg-6 form-group">
						  		<label for="name"><span class="req">*</span> Nombre:</label>
						  		<input type="text" class="form-control required" id="name" name="name" placeholder="Escribe el nombre del empleado..." value="">
						  		<p id="name-error" class="error"></p>
						  	</div>

						  	<div class="col-12 col-md-6 col-lg-6 form-group">
						  		<label for="lastname"><span class="req">*</span> Apellidos:</label>
						  		<input type="text" class="form-control required" id="lastname" name="lastname" placeholder="Escribe los apellidos del empleado..." value="">
						  		<p id="lastname-error" class="error"></p>
						  	</div>

						  	<div class="col-12 form-group">
						  		<label for="email"><span class="req">*</span> Correo electrónico:</label>
						  		<input type="email" class="form-control required" id="email" name="email" placeholder="Escribe el correo electrónico del empleado..." value="">
						  		<p id="email-error" class="error"></p>
						  	</div>

						  	<div class="col-12 col-md-6 col-lg-6 form-group">
						  		<label for="mobile"><span class="req">*</span> Celular:</label>
						  		<input type="text" class="form-control required" id="mobile" name="mobile" placeholder="Escribe el número celular del empleado..." value="">
						  		<p id="mobile-error" class="error"></p>
						  	</div>

						  	<div class="col-12 col-md-6 col-lg-6 form-group">
						  		<label for="phone">Teléfono fijo:</label>
						  		<input type="text" class="form-control" id="phone" name="phone" placeholder="Escribe el teléfono fijo del empleado..." value="">
						  		<p id="phone-error" class="error"></p>
						  	</div>

						  	<div class="col-12 col-md-6 col-lg-6 form-group">
						  		<label for="address">Dirección:</label>
						  		<input type="text" class="form-control" id="address" name="address" placeholder="Escribe el teléfono fijo del empleado..." value="">
						  		<p id="address-error" class="error"></p>
						  	</div>

						  	<div class="col-12 col-md-6 col-lg-6 form-group">
						  		<label for="office">Oficina:</label>
						  		<input type="text" class="form-control" id="office" name="office" placeholder="Escribe el número celular del empleado..." value="">
						  		<p id="office-error" class="error"></p>
						  	</div>
					  	</div>

					  	<div class="form-group">
					  		<input type="hidden" id="src" name="src" value="employees">
					  		<input type="hidden" id="action" name="action" value="">
					  		<input type="hidden" id="id" name="id" value="">
					  		<input type="submit" id="send" class="send-btn" value="Agregar servicio">
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