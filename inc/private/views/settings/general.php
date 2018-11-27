<form class="ecwr_form_content" method="post" action="options.php"> 
	<?php settings_fields( 'ecwr-settings-group' ); ?>
	<?php do_settings_sections( 'ecwr-settings-group' ); ?>

	<h5><?php _e('Ajustes del formulario:', ECWR_NS); ?></h5>

	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Tipo de formulario:', ECWR_NS); ?></th>
			<td>
				<p>
					<input type="radio" name="ecwr_onestep_form" value="si" <?php if(get_option('ecwr_onestep_form') == 'si') { echo 'checked'; } ?> /> <?php _e('Formulario a un (1) solo paso.', ECWR_NS); ?>
				</p>
				<p>
					<input type="radio" name="ecwr_onestep_form" value="no" <?php if(get_option('ecwr_onestep_form') == 'no') { echo 'checked'; } ?> /> <?php _e('Formulario a dos (2) pasos.', ECWR_NS); ?>
				</p>
				<p class="description" id="tagline-description">
					<?php _e('Por defecto se mostrará el formulario a dos pasos.', ECWR_NS); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Fecha máxima:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_max_datepicker" value="<?php echo esc_attr( get_option('ecwr_max_datepicker') ); ?>" />
			</td>
		</tr>
	</table>

	<h5><?php _e('Ajustes del calendario:', ECWR_NS); ?></h5>

	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Fecha minima:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_min_datepicker" value="<?php echo esc_attr( get_option('ecwr_min_datepicker') ); ?>" />
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Fecha máxima:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_max_datepicker" value="<?php echo esc_attr( get_option('ecwr_max_datepicker') ); ?>" />
			</td>
		</tr>
	</table>

	<?php submit_button(); ?>

</form>