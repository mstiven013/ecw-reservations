<form class="ecwr_form_content" method="post" action="options.php"> 
	<?php settings_fields( 'ecwr-general-settings-group' ); ?>
	<?php do_settings_sections( 'ecwr-general-settings-group' ); ?>

	<h5><?php _e('Ajustes del formulario:', ECWR_NS); ?></h5>

	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Tipo de formulario:', ECWR_NS); ?></th>
			<td>
				<p>
					<input type="radio" id="ecwr_onestep_form-si" name="ecwr_onestep_form" value="si" <?php if(get_option('ecwr_onestep_form') == 'si') { echo 'checked'; } ?> />
					<label for="ecwr_onestep_form-si"><?php _e('Formulario a un (1) solo paso.', ECWR_NS); ?></label>
				</p>
				<p>
					<input type="radio" id="ecwr_onestep_form-no" name="ecwr_onestep_form" value="no" <?php if(get_option('ecwr_onestep_form') == 'no') { echo 'checked'; } ?> />
					<label for="ecwr_onestep_form-no"><?php _e('Formulario a dos (2) pasos.', ECWR_NS); ?></label>
				</p>
				<p class="description" id="tagline-description">
					<?php _e('Por defecto se mostrará el formulario a dos pasos.', ECWR_NS); ?>
				</p>
			</td>
		</tr>
	</table>
	
	<?php submit_button(); ?>

</form>