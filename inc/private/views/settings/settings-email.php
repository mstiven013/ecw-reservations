<?php

	if(isset($_POST['action']) && isset($_POST['src'])) {
		include(dirname(__FILE__, 4) . '/functions.php');
	} else {
		include(realpath(__DIR__, '/../../..') . '/functions.php');
	}

?>

<form class="ecwr_form_content email-settings" method="post" action="options.php">
	<?php settings_fields( 'ecwr-mail-settings-group' ); ?>
	<?php do_settings_sections( 'ecwr-mail-settings-group' ); ?>

	<table class="form-table">

		<h5><?php _e('Configuración del correo electrónico:', ECWR_NS); ?></h5>

		<tr>
			<th scope="row"><?php _e('Correo del remitente:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_mail_email" value="<?php echo esc_attr( get_option('ecwr_mail_email') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('Este correo se usará en el campo "De" del correo.', ECWR_NS); ?><br/>
					<?php _e('Por defecto se tomará el email de instalación de wordpress:', ECWR_NS); ?> <b><?php echo esc_attr( get_option('admin_email') ); ?></b>.
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Nombre del remitente:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_mail_name" value="<?php echo esc_attr( get_option('ecwr_mail_name') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('Este correo se usará en el campo "De" del correo.', ECWR_NS); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Servidor SMTP:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_smtp_host" value="<?php echo esc_attr( get_option('ecwr_smtp_host') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('Tu servidor de correos.', ECWR_NS); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Nombre de usuario SMTP:', ECWR_NS); ?></th>
			<td>
				<input type="text" name="ecwr_smtp_user" value="<?php echo esc_attr( get_option('ecwr_smtp_user') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('Tu servidor de correos.', ECWR_NS); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Contraseña SMTP:', ECWR_NS); ?></th>
			<td>
				<input type="password" name="ecwr_smtp_password" value="<?php echo esc_attr( get_option('ecwr_smtp_password') ); ?>" />
				<p class="description" id="tagline-description">
					<?php _e('La contraseña para iniciar sesión en tu servidor de correo.', ECWR_NS); ?>
				</p>
			</td>
		</tr>
	</table>

	<?php submit_button(); ?>

</form>
