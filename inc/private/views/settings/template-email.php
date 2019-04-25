<?php

	if(phpversion() >= 7) {
		include(dirname(__FILE__, 4) . '/functions.php');
	} else {
		include(realpath(__DIR__ . '/../../..') . '/functions.php');
	}
	
	$fields = all_fields();

?>

<form class="ecwr_form_content email-settings" method="post" action="options.php">
	<?php settings_fields( 'ecwr-mail-template-group' ); ?>
	<?php do_settings_sections( 'ecwr-mail-template-group' ); ?>

	<table class="form-table">

		<h5><?php _e('Plantilla del correo electrónico enviado:', ECWR_NS); ?></h5>
		<p><?php _e('Todas las variables que se pueden usar para configurar el envío de correos electrónicos de notificación tanto para usuario como para administrador son las siguientes:', ECWR_NS); ?></p>
		<p>
			<?php foreach ($fields as $field) { ?>
				<code>[<?php echo $field->field_name; ?>]</code>
			<?php } ?>
		</p>

		<tr>
			<th scope="row"><?php _e('Etiqueta que contiene el correo electrónico:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_mail_to" value="<?php echo esc_attr( get_option('ecwr_mail_to') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('En este campo debes poner la etiqueda que contiene el correo electrónico<br/> del usuario que hizo su reservación. Ejemplo: <b>[email]</b>.', ECWR_NS); ?>
				</p>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Etiqueta que contiene la fecha:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_reservation_date" value="<?php echo esc_attr( get_option('ecwr_reservation_date') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('En este campo debes poner la etiqueda que contiene la fecha<br/> de la reservación. Ejemplo: <b>[date]</b>.', ECWR_NS); ?>
				</p>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Etiqueta que contiene la hora:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_reservation_hour" value="<?php echo esc_attr( get_option('ecwr_reservation_hour') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('En este campo debes poner la etiqueda que contiene la hora<br/> de la reservación. Ejemplo: <b>[hour]</b>.', ECWR_NS); ?>
				</p>
			</td>
		</tr>

		<tr>
			<th scope="row"><?php _e('Plantilla del correo:', ECWR_NS); ?></th>
			<td>
				<?php wp_editor( get_option('ecwr_mail_template'), 'ecwr_mail_template', array() ); ?>
			</td>
		</tr>
	</table>

	<?php submit_button(); ?>

</form>
