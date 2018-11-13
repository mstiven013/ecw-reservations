<div class="wrap ecw_reservations">

	<h1><?php _e('Categorías', ECWR_NS); ?></h1>

	<table id="categories" class="datatable">
		<thead>
			<tr>
				<th>ID:</th>
				<th>Título:</th>
				<th>Descripción:</th>
				<th></th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th>ID:</th>
				<th>Título:</th>
				<th>Descripción:</th>
				<th></th>
			</tr>
		</tfoot>
	</table>

	<div class="modal fade modal-categories " tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="modal-title">Agregar categoría:</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

			    </div>
			    <div class="modal-body">

			    	<form id="categories-form">

					  	<div class="form-group">
					  		<label for="title"><span class="req">*</span> Nombre:</label>
					  		<input type="text" class="form-control required" id="title" name="title" placeholder="Escribe el nombre del categoría..." value="">
					  		<p id="title-error" class="error"></p>
					  	</div>

					  	<div class="form-group">
					  		<label for="description">Descripción:</label>
					  		<textarea name="description" class="form-control" id="description" placeholder="Escribe aquí una breve descripción del categoría..."></textarea>
					  	</div>

					  	<div class="form-group">
					  		<input type="hidden" id="src" name="src" value="categories">
					  		<input type="hidden" id="action" name="action" value="">
					  		<input type="hidden" id="id" name="id" value="">
					  		<input type="submit" id="send" class="send-btn" value="Agregar categoría">
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