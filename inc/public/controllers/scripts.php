<?php 

	//Register JS scripts
	add_action('wp_enqueue_scripts','ecwr_register_scripts');
	if(!function_exists('ecwr_register_scripts')) {
		function ecwr_register_scripts() {

			global $post;

			if(has_shortcode($post->post_content, 'reservation_form')) {
				//jQuery
			    wp_register_script('jquery.min.js', ECWR_DIR . 'inc/libs/jquery/jquery.min.js', '', '', false);
			    wp_enqueue_script('jquery.min.js');

			    //popper scripts
			    wp_register_script('popper.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/popper.min.js', '', '', false);
			    wp_enqueue_script('popper.min.js');

			    //Bootstrap scripts
			    wp_register_script('bootstrap.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/bootstrap.min.js', '', '', false);
			    wp_enqueue_script('bootstrap.min.js');
			    
			    //Select2 scripts
			    wp_register_script('select2.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/select2.min.js', '', '', false);
			    wp_enqueue_script('select2.min.js');

			    //Datepicker Bootstrap scripts
			    wp_register_script('bootstrap-datepicker.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/bootstrap-datepicker.min.js', '', '', false);
			    wp_enqueue_script('bootstrap-datepicker.min.js');

			    //Datepicker Language Bootstrap scripts
			    wp_register_script('bootstrap-datepicker.es.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/bootstrap-datepicker.es.min.js', '', '', false);
			    wp_enqueue_script('bootstrap-datepicker.es.min.js');

			    //Clockpicker Bootstrap scripts
			    wp_register_script('bootstrap-timepicker.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/bootstrap-timepicker.min.js', '', '', false);
			    wp_enqueue_script('bootstrap-timepicker.min.js');

			    //Custom scripts
			    wp_register_script('reservations.js', ECWR_DIR . 'inc/public/views/js/reservations.js',  '', '', false);
			    wp_enqueue_script('reservations.js');
			    wp_localize_script('reservations.js', 'info', array(
			    	'ecw_url' => ECWR_DIR,
			    	'disabled_days' => get_option('ecwr_disabled_days'),
			    	'disabled_dates' => get_option('ecwr_disabled_dates'),
			    	'min_date' => get_option('ecwr_min_datepicker'),
			    	'max_date' => get_option('ecwr_max_datepicker'),
			    	'min_time' => get_option('ecwr_min_timepicker'),
					'max_time' => get_option('ecwr_max_timepicker'),
					'range_time' => get_option('ecwr_range_timepicker')
				));
			}
		}
	}

	//Register CSS styles
	add_action('wp_enqueue_scripts','ecwr_register_styles');
	if(!function_exists('ecwr_register_styles')) {
		function ecwr_register_styles() {

			global $post;

	 		if(has_shortcode($post->post_content, 'reservation_form')) {

	 			//Custom styles
			    wp_register_style('style.css', ECWR_DIR . 'inc/public/views/css/style.css', array(), false, 'all');
			    wp_enqueue_style('style.css');

				//Bootstrap styles
			    wp_register_style('bootstrap.min.css', ECWR_DIR . 'inc/libs/bootstrap/css/bootstrap.min.css', array(), false, 'all');
			    wp_enqueue_style('bootstrap.min.css');

			    //Bootstrap styles
			    wp_register_style('bootstrap-datepicker.min.css', ECWR_DIR . 'inc/libs/bootstrap/css/bootstrap-datepicker.min.css', array(), false, 'all');
			    wp_enqueue_style('bootstrap-datepicker.min.css');

			    //Datepicker Bootstrap styles
			    wp_register_style('bootstrap-datepicker.standalone.min.css', ECWR_DIR . 'inc/libs/bootstrap/css/bootstrap-datepicker.standalone.min.css', array(), false, 'all');
			    wp_enqueue_style('bootstrap-datepicker.standalone.min.css');

			    //Clockpicker Bootstrap styles
			    wp_register_style('bootstrap-timepicker.min.css', ECWR_DIR . 'inc/libs/bootstrap/css/bootstrap-timepicker.min.css', array(), false, 'all');
			    wp_enqueue_style('bootstrap-timepicker.min.css');
			    
			    //Select2 styles
			    wp_register_style('select2.min.css', ECWR_DIR . 'inc/libs/bootstrap/css/select2.min.css', array(), false, 'all');
			    wp_enqueue_style('select2.min.css');
			}
		    
		}
	}
	
 ?>