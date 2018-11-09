<?php 

	if(defined('ECWR_TEMP')) {
		define('ECWR_TEMP', ECWR_DIR . 'inc/public/views');
	}

	add_action('admin_enqueue_scripts', 'ecwr_admin_scripts');
	function ecwr_admin_scripts($hook_suffix) {

		global $pagenow;

	    if( 
	    	($pagenow === 'admin.php' && 'ecwr_all_reservations' == $_GET['page']) || 
	    	($pagenow === 'admin.php' && 'ecwr_global_settings' == $_GET['page']) || 
	    	($pagenow === 'admin.php' && 'ecwr_services' == $_GET['page']) || 
	    	($pagenow === 'admin.php' && 'ecwr_categories' == $_GET['page'])
	    ) {
	    	//Add all scripts of Data tables plugin
	    	wp_register_style('datatables.min.css', ECWR_DIR . 'inc/libs/datatables/css/datatables.min.css', array(), false, 'all');
			wp_enqueue_style('datatables.min.css');
			wp_register_script( 'datatables.min.js', ECWR_DIR . 'inc/libs/datatables/js/datatables.min.js' );
			wp_enqueue_script( 'datatables.min.js' );
			wp_register_script( 'dataTables.buttons.min.js', ECWR_DIR . 'inc/libs/datatables/js/dataTables.buttons.min.js' );
			wp_enqueue_script( 'dataTables.buttons.min.js');
			wp_register_script( 'buttons.flash.min.js', ECWR_DIR . 'inc/libs/datatables/js/buttons.flash.min.js' );
			wp_enqueue_script( 'buttons.flash.min.js');
			wp_register_script( 'buttons.html5.min.js', ECWR_DIR . 'inc/libs/datatables/js/buttons.html5.min.js' );
			wp_enqueue_script( 'buttons.html5.min.js');
			wp_register_script( 'buttons.print.min.js', ECWR_DIR . 'inc/libs/datatables/js/buttons.print.min.js' );
			wp_enqueue_script( 'buttons.print.min.js');
			wp_register_script( 'jszip.min.js', ECWR_DIR . 'inc/libs/datatables/js/jszip.min.js' );
			wp_enqueue_script( 'jszip.min.js' );
			
	    	//styles
		    wp_register_style('admin.css', ECWR_DIR . 'inc/private/views/css/admin.css', array(), false, 'all');
		    wp_enqueue_style('admin.css');

		    //scripts
		    wp_register_script('admin.js', ECWR_DIR . 'inc/private/views/js/admin.js', array(), false, 'all');
		    wp_enqueue_script('admin.js');
	    }

	    if($pagenow === 'admin.php' && 'ecwr_all_reservations' == $_GET['page']) {
			wp_register_script('reservations.js', ECWR_DIR . 'inc/private/views/js/reservations.js', array(), false, 'all');
		    wp_enqueue_script('reservations.js');
		    wp_localize_script('reservations.js', 'info', array(
			    'ecw_url' => ECWR_DIR
			));
	    }

	    if($pagenow === 'admin.php' && 'ecwr_services' == $_GET['page']) {
			wp_register_script('services.js', ECWR_DIR . 'inc/private/views/js/services.js', array(), false, 'all');
		    wp_enqueue_script('services.js');
		    wp_localize_script('services.js', 'info', array(
			    'ecw_url' => ECWR_DIR
			));
	    }

	    if($pagenow === 'admin.php' && 'ecwr_categories' == $_GET['page']) {
			wp_register_script('categories.js', ECWR_DIR . 'inc/private/views/js/categories.js', array(), false, 'all');
		    wp_enqueue_script('categories.js');
		    wp_localize_script('categories.js', 'info', array(
			    'ecw_url' => ECWR_DIR
			));
	    }

	}

 ?>