<form class="ecwr_form_content" method="post" action="options.php"> 
	<?php settings_fields( 'ecwr-timepicker-settings-group' ); ?>
	<?php do_settings_sections( 'ecwr-timepicker-settings-group' ); ?>

	<h5><?php _e('Ajustes del reloj:', ECWR_NS); ?></h5>

	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Hora minima:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_min_timepicker" value="<?php echo esc_attr( get_option('ecwr_min_timepicker') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('<b>hh:mm-AM</b>: escribir la hora en formato 10:15-AM', ECWR_NS); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Hora máxima:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_max_timepicker" value="<?php echo esc_attr( get_option('ecwr_max_timepicker') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('<b>hh:mm-AM</b>: escribir la hora en formato 11:00-PM', ECWR_NS); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Rango de minutos:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_range_timepicker" value="<?php echo esc_attr( get_option('ecwr_range_timepicker') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('Rango de minutos. Ejemplo <b>30</b>', ECWR_NS); ?><br/>
				</p>
			</td>
		</tr>
	</table>

	<?php submit_button(); ?>

</form>