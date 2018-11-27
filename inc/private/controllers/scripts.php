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
	    	($pagenow === 'admin.php' && 'ecwr_categories' == $_GET['page']) ||
	    	($pagenow === 'admin.php' && 'ecwr_employees' == $_GET['page'])
	    ) {

	    	//jQuery
		    wp_register_script('jquery.min.js', ECWR_DIR . 'inc/libs/jquery/jquery.min.js', '', '', false);
		    wp_enqueue_script('jquery.min.js');

		    //popper scripts
		    wp_register_script('popper.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/popper.min.js', '', '', false);
		    wp_enqueue_script('popper.min.js');

		    //Bootstrap scripts
		    wp_register_script('bootstrap.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/bootstrap.min.js', '', '', false);
		    wp_enqueue_script('bootstrap.min.js');

		    //Bootstrap styles
		    wp_register_style('bootstrap.min.css', ECWR_DIR . 'inc/libs/bootstrap/css/bootstrap.min.css', array(), false, 'all');
		    wp_enqueue_style('bootstrap.min.css');

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
		    wp_register_script('bootstrap-clockpicker.min.js', ECWR_DIR . 'inc/libs/bootstrap/js/bootstrap-clockpicker.min.js', '', '', false);
		    wp_enqueue_script('bootstrap-clockpicker.min.js');

			wp_register_script('reservations.js', ECWR_DIR . 'inc/private/views/js/reservations.js', array(), false, 'all');
		    wp_enqueue_script('reservations.js');
		    wp_localize_script('reservations.js', 'info', array(
			    'ecw_url' => ECWR_DIR,
			    'sitename' => get_bloginfo('name')
			));

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
		    wp_register_style('bootstrap-clockpicker.min.css', ECWR_DIR . 'inc/libs/bootstrap/css/bootstrap-clockpicker.min.css', array(), false, 'all');
		    wp_enqueue_style('bootstrap-clockpicker.min.css');

		    //Clockpicker Bootstrap styles
		    wp_register_style('bootstrap-clockpicker.standalone.css', ECWR_DIR . 'inc/libs/bootstrap/css/bootstrap-clockpicker.standalone.css', array(), false, 'all');
		    wp_enqueue_style('bootstrap-clockpicker.standalone.css');
		    
		    //Select2 styles
		    wp_register_style('select2.min.css', ECWR_DIR . 'inc/libs/bootstrap/css/select2.min.css', array(), false, 'all');
		    wp_enqueue_style('select2.min.css');
	    }

	    if($pagenow === 'admin.php' && 'ecwr_global_settings' == $_GET['page'] && 'form' == $_GET['tab']) {

	    	wp_register_script('vue.js', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js', array(), false, 'all');
		    wp_enqueue_script('vue.js');

		    wp_register_style('all.css', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css', array(), false, 'all');
		    wp_enqueue_style('all.css');
		    
			wp_register_script('form.js', ECWR_DIR . 'inc/private/views/js/form.js', array(), false, 'all');
		    wp_enqueue_script('form.js');
		    wp_localize_script('form.js', 'info', array(
			    'ecw_url' => ECWR_DIR,
			    'sitename' => get_bloginfo('name')
			));
	    }

	    if($pagenow === 'admin.php' && 'ecwr_services' == $_GET['page']) {
			wp_register_script('services.js', ECWR_DIR . 'inc/private/views/js/services.js', array(), false, 'all');
		    wp_enqueue_script('services.js');
		    wp_localize_script('services.js', 'info', array(
			    'ecw_url' => ECWR_DIR,
			    'sitename' => get_bloginfo('name')
			));
	    }

	    if($pagenow === 'admin.php' && 'ecwr_categories' == $_GET['page']) {
			wp_register_script('categories.js', ECWR_DIR . 'inc/private/views/js/categories.js', array(), false, 'all');
		    wp_enqueue_script('categories.js');
		    wp_localize_script('categories.js', 'info', array(
			    'ecw_url' => ECWR_DIR,
			    'sitename' => get_bloginfo('name')
			));
	    }

	    if($pagenow === 'admin.php' && 'ecwr_employees' == $_GET['page']) {
			wp_register_script('employees.js', ECWR_DIR . 'inc/private/views/js/employees.js', array(), false, 'all');
		    wp_enqueue_script('employees.js');
		    wp_localize_script('employees.js', 'info', array(
			    'ecw_url' => ECWR_DIR,
			    'sitename' => get_bloginfo('name')
			));
	    }

	}

 ?>