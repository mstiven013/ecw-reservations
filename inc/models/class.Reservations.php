<?php 

	if(isset($_POST['action']) && isset($_POST['src'])) {

		require_once("../../../../../wp-load.php");

		if($_POST['action'] == 'get_all' && $_POST['src'] == 'reservations') {
			$reservations = new Reservations();
			$reservations->get_all();
		}

	}

	class Reservations {

		protected $table_name = 'ecw_reservations';

		public function __construct() {
			add_action('init', array($this, 'create_table'));
		}

		public function create_table() {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "CREATE TABLE IF NOT EXISTS $tname (
						id INT(255) AUTO_INCREMENT PRIMARY KEY,
						reservation_date DATE NOT NULL,
						reservation_hour TIME NOT NULL,
						person_name VARCHAR(50) NOT NULL,
						person_phone VARCHAR(30) NOT NULL,
						person_email VARCHAR(50) NOT NULL,
						aditional_notes VARCHAR(250) ,
						category_id INT NOT NULL,
						service_id INT NOT NULL,
						employee_id INT NOT NULL
					) CHARACTER SET utf8;";

			$wpdb->query($sql);

		}

		public function get_all() {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "SELECT * FROM $tname";

			$query = $wpdb->get_results($sql);
			
			$data = array('data' => $query);

			echo json_encode($data);

		}

	}

 ?>