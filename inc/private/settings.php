<?php 

	add_action('admin_menu', 'register_all_settings');

	if(!function_exists('register_all_settings')) {
		function register_all_settings() {

			//Add reservations page
			add_menu_page(
				__('ECW Reservas', ECWR_NS),
				__('ECW Reservas', ECWR_NS),
				'administrator',
				'ecwr_all_reservations',
				'ecwr_all_reservations'
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

			//Add services submenu to reservations menu
			add_submenu_page(
				'ecwr_all_reservations',
				__('Servicios', ECWR_NS),
				__('Servicios', ECWR_NS),
				'administrator',
				'ecwr_services',
				'ecwr_services'
			);

			//Add categories submenu to reservations menu
			add_submenu_page(
				'ecwr_all_reservations',
				__('Categorías', ECWR_NS),
				__('Categorías', ECWR_NS),
				'administrator',
				'ecwr_categories',
				'ecwr_categories'
			);

		}
	}

	if(!function_exists('ecwr_all_reservations')) {
		function ecwr_all_reservations() {
			require_once('views/all-reservations.php');
		}
	}

	if(!function_exists('ecwr_global_settings')) {
		function ecwr_global_settings() {
			require_once('views/global-settings.php');
		}
	}

	if(!function_exists('ecwr_services')) {
		function ecwr_services() {
			require_once('views/services.php');
		}
	}

	if(!function_exists('ecwr_categories')) {
		function ecwr_categories() {
			require_once('views/categories.php');
		}
	}

 ?>