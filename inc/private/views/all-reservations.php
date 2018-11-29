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

	<div class="modal fade modal-reservations" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="modal-title">
						<?php _e('Reserva #', ECWR_NS); ?> <span id="id"></span>
					</h5>

					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>

			    </div>
			    <div class="modal-body">

			    	<div class="section">
			    		<p>
			    			<strong><?php _e('Fecha:', ECWR_NS); ?></strong> <span id="reservation-date"></span>
			    		</p>
			    	</div>

			    	<div class="section">
			    		<p>
			    			<strong><?php _e('Hora:', ECWR_NS); ?></strong> <span id="reservation-hour"></span>
			    		</p>
			    	</div>

			    	<div class="section">
			    		<p>
			    			<strong>
			    				<?php _e('Mensaje completo:', ECWR_NS); ?>
			    			</strong>
			    		</p>
			    		<div id="reservation-message"></div>
			    	</div>

			    </div>
			</div>
		</div>
	</div>

</div>