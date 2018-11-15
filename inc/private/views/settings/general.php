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