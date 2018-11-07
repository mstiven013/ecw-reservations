<?php 

	if(defined('ECWR_TEMP')) {
		define('ECWR_TEMP', ECWR_DIR . 'inc/public/views');
	}

	add_action('admin_enqueue_scripts', 'ecwr_admin_scripts');
	function ecwr_admin_scripts($hook_suffix) {

		global $pagenow;

	    if( 
	    	($pagenow === 'admin.php' && 'all_reservations' == $_GET['page']) || 
	    	($pagenow === 'admin.php' && 'global_settings' == $_GET['page'])
	    ) {
	    	//styles
		    wp_register_style('admin.css', ECWR_DIR . 'inc/private/views/css/admin.css', array(), false, 'all');
		    wp_enqueue_style('admin.css');

		    //scripts
		    wp_register_script('admin.js', ECWR_DIR . 'inc/private/views/js/admin.js', array(), false, 'all');
		    wp_enqueue_script('admin.js');
	    }

	}

 ?>