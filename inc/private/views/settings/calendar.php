<form class="ecwr_form_content" method="post" action="options.php"> 
	<?php settings_fields( 'ecwr-calendar-settings-group' ); ?>
	<?php do_settings_sections( 'ecwr-calendar-settings-group' ); ?>

	<h5><?php _e('Ajustes del calendario:', ECWR_NS); ?></h5>

	<table class="form-table">
		<tr>
			<th scope="row"><?php _e('Fecha minima:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_min_datepicker" value="<?php echo esc_attr( get_option('ecwr_min_datepicker') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('<b>1</b>: Fecha actual.', ECWR_NS); ?><br/>
					<?php _e('<b>aaaa-mm-dd</b>: escribir fecha en formato 2018-12-24', ECWR_NS); ?><br/>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Fecha máxima:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_max_datepicker" value="<?php echo esc_attr( get_option('ecwr_max_datepicker') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('<b>1</b>: infinito.', ECWR_NS); ?><br/>
					<?php _e('<b>aaaa-mm-dd</b>: escribir fecha en formato 2050-12-31', ECWR_NS); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Deshabilitar días de la semana:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_disabled_days" value="<?php echo esc_attr( get_option('ecwr_disabled_days') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('Días de la semana:', ECWR_NS); ?><br/>
					<?php _e('<b>0</b>: Domingo. <b>1</b>: Lunes. <b>2</b>: Martes. <b>3</b>: Miércoles. <b>4</b>: Jueves. <b>5</b>: Viernes. <b>6</b>: Sabado.', ECWR_NS); ?><br/>
					<?php _e('Para deshabilitar varios días, separarlos por medio de commas.', ECWR_NS); ?><br/>
					<?php _e('Ejemplo: <b>0, 1, 2</b>...', ECWR_NS) ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Deshabilitar fechas:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_disabled_dates" value="<?php echo esc_attr( get_option('ecwr_disabled_dates') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('Escribir fecha en formato <b>aaaa-mm-dd</b>.', ECWR_NS); ?><br/>
					<?php _e('Para deshabilitar varios días, separarlos por medio de commas.', ECWR_NS); ?><br/>
					<?php _e('Ejemplo: <b>2019-01-01, 2019-07-23, 2020-11-12</b>...', ECWR_NS) ?>
				</p>
			</td>
		</tr>
	</table>

	<?php submit_button(); ?>

</form>