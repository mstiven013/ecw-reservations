<?php 

	class PublicEcw {

		public function __construct() {
			add_shortcode('reservation_form', array($this, 'reservation_form'));
			$this->register_scripts();
		}

		//Function to return reservation form in "reservation_form" shortcode
		public function reservation_form() {
			$content = file_get_contents(ECWR_DIR . 'inc/public/views/form.php');
			return $content;
		}

		public function register_scripts() {
			require_once 'controllers/scripts.php';
		}

	}

 ?>