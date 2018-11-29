<?php 

	add_action('admin_menu', 'register_all_settings');

	if(!function_exists('register_all_settings')) {
		function register_all_settings() {

			//Add reservations page
			add_menu_page(
				__('Reservas', ECWR_NS),
				__('Reservas', ECWR_NS),
				'administrator',
				'ecwr_all_reservations',
				'ecwr_all_reservations',
				ECWR_DIR . 'inc/private/views/img/menu_icon.png'
			);

			//Add global settings submenu to reservations menu
			add_submenu_page(
				'ecwr_all_reservations',
				__('Ajustes', ECWR_NS),
				__('Ajustes', ECWR_NS),
				'administrator',
				'ecwr_global_settings',
				'ecwr_global_settings'
			);

			add_action( 'admin_init', 'register_ecwr_global_settings' );

		}
	}

	if(!function_exists('ecwr_all_reservations')) {
		function ecwr_all_reservations() {
			include('views/all-reservations.php');
		}
	}

	if(!function_exists('ecwr_global_settings')) {
		function ecwr_global_settings() {
			require_once('views/global-settings.php');
		}
	}

	if(!function_exists('register_ecwr_global_settings')) {
		function register_ecwr_global_settings() {

			//Register email options
			register_setting( 'ecwr-mail-settings-group', 'ecwr_mail_email' );
			register_setting( 'ecwr-mail-settings-group', 'ecwr_mail_name' );
			register_setting( 'ecwr-mail-settings-group', 'ecwr_smtp_host' );
			register_setting( 'ecwr-mail-settings-group', 'ecwr_smtp_user' );
			register_setting( 'ecwr-mail-settings-group', 'ecwr_smtp_password' );

			//Register email template options
			register_setting( 'ecwr-mail-template-group', 'ecwr_mail_to' );
			register_setting( 'ecwr-mail-template-group', 'ecwr_reservation_date' );
			register_setting( 'ecwr-mail-template-group', 'ecwr_reservation_hour' );
			register_setting( 'ecwr-mail-template-group', 'ecwr_mail_template' );

			//Register general options
			register_setting( 'ecwr-general-settings-group', 'ecwr_onestep_form' );

			//Calendar
			register_setting( 'ecwr-calendar-settings-group', 'ecwr_min_datepicker' );
			register_setting( 'ecwr-calendar-settings-group', 'ecwr_max_datepicker' );
			register_setting( 'ecwr-calendar-settings-group', 'ecwr_disabled_days' );
			register_setting( 'ecwr-calendar-settings-group', 'ecwr_disabled_dates' );

			//Time
			register_setting( 'ecwr-timepicker-settings-group', 'ecwr_min_timepicker' );
			register_setting( 'ecwr-timepicker-settings-group', 'ecwr_max_timepicker' );
			register_setting( 'ecwr-timepicker-settings-group', 'ecwr_range_timepicker' );

		}
	}

 ?>