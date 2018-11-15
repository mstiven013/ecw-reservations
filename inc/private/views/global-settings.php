<div class="wrap ecw_reservations">

	<h1><?php _e('Ajustes generales', ECWR_NS); ?></h1>

	<form method="post" action="options.php"> 
		<?php settings_fields( 'ecwr-settings-group' ); ?>
    	<?php do_settings_sections( 'ecwr-settings-group' ); ?>

		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#emails">
					<?php _e('Correo electrónico', ECWR_NS); ?>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#generales">
					<?php _e('Generales', ECWR_NS); ?>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#help">
					<?php _e('Ayuda', ECWR_NS); ?>
				</a>
			</li>
		</ul>

		<div class="tab-content">

			<div id="emails" class="tab-pane active">
				<?php include('settings/email.php'); ?>
			</div>

			<div id="generales" class="tab-pane">
				<?php include('settings/general.php'); ?>
			</div>

			<div id="help" class="tab-pane">
				<?php include('settings/help.php'); ?>
			</div>

		</div>

		<?php submit_button(); ?>
	</form>
</div>