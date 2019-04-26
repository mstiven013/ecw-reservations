<?php 

	class PublicEcw {

		public function __construct() {
			add_shortcode('reservation_form', array($this, 'reservation_form'));
			$this->register_scripts();
		}

		//Function to return reservation form in "reservation_form" shortcode
		public function reservation_form() {
		    
			ob_start();
			
            if(phpversion() >= 7) {
                include(dirname(__FILE__) . '/views/form.php');
            } else {
                include(realpath(__DIR__) . '/views/form.php');
            }
            
			$content = ob_get_clean();
			
			return $content;
		}

		public function register_scripts() {
			require_once 'controllers/scripts.php';
		}

	}

 ?>