<?php 

	if(isset($_POST['action']) && isset($_POST['src'])) {

		require_once("../../../../../wp-load.php");

		if($_POST['src'] == 'reservations') {

			switch ($_POST['action']) {
				case 'get_all':

					$requestMethod = (isset($_POST['method'])) ? $_POST['method'] : 'json';
					$reservations = new Reservations();
					$reservations->get_all($requestMethod);

					break;

				case 'create':

					//Required's
					$reservation_date = $_POST['reservation_date'];
					$reservation_hour = $_POST['reservation_hour'];
					$person_name = $_POST['person_name'];
					$person_phone = $_POST['person_phone'];
					$person_email = $_POST['person_email'];
					$category_id = $_POST['category_id'];
					$service_id = $_POST['service_id'];
					$employee_id = $_POST['employee_id'];

					//Optionals
					$aditional_notes = (isset($_POST['aditional_notes'])) ? $_POST['aditional_notes'] : null;

					$reservations = new Reservations();
					$reservations->create($reservation_date, $reservation_hour, $person_name, $person_phone, $person_email, $aditional_notes, $category_id, $service_id, $employee_id);

					break;

				case 'update':

					//Required's
					$id = $_POST['id'];
					$reservation_date = $_POST['reservation_date'];
					$reservation_hour = $_POST['reservation_hour'];
					$person_name = $_POST['person_name'];
					$person_phone = $_POST['person_phone'];
					$person_email = $_POST['person_email'];
					$category_id = $_POST['category_id'];
					$service_id = $_POST['service_id'];
					$employee_id = $_POST['employee_id'];

					//Optionals
					$aditional_notes = (isset($_POST['aditional_notes'])) ? $_POST['aditional_notes'] : null;

					$reservations = new Reservations();
					$reservations->create($id, $reservation_date, $reservation_hour, $person_name, $person_phone, $person_email, $aditional_notes, $category_id, $service_id, $employee_id);

					break;
				
				default:

					$requestMethod = (isset($_POST['method'])) ? $_POST['method'] : 'json';
					$reservations = new Reservations();
					$reservations->get_all($requestMethod);

					break;
			}
		}

	}

	class Reservations {

		protected $table_name = "ecw_reservations";

		public function __construct() {
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

		public function get_all($method) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "SELECT * FROM $tname";

			$query = $wpdb->get_results($sql);
			
			$data = array('data' => $query);

			switch ($method) {
				case 'json':
						echo json_encode($data);
					break;

				case 'array':
						return $query;
					break;
				
				default:
						echo json_encode($data);
					break;
			}

		}

		public function create($reservation_date, $reservation_hour, $person_name, $person_phone, $person_email, $aditional_notes, $category_id, $service_id, $employee_id) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "INSERT INTO $tname (reservation_date, reservation_hour, person_name, person_phone, person_email, aditional_notes, category_id, service_id, employee_id) 
					VALUES ('$reservation_date', '$reservation_hour', '$person_name', '$person_phone', '$person_email', '$aditional_notes', '$category_id', '$service_id', '$employee_id')";

			$query = $wpdb->query($sql);

			$resp['action'] = 'create';

			if($query) {
				$resp['code'] = 200;
				$resp['msg'] = 'Resource saved successfully.';
			} else {
				
				if( $wpdb->insert_id == 0 ) {
					$resp['code'] = 409;
					$resp['msg'] = 'This source already exists.';
				} else {
					$resp['code'] = 500;
					$resp['msg'] = 'Error saving this resource.';
				}

			}

			echo json_encode($resp);

		}

		public function update($id, $reservation_date, $reservation_hour, $person_name, $person_phone, $person_email, $aditional_notes, $category_id, $service_id, $employee_id) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "UPDATE $tname SET reservation_date = '$reservation_date', reservation_hour = '$reservation_hour', person_name = '$person_name', person_phone = '$person_phone', person_email = '$person_email', aditional_notes = '$aditional_notes', category_id = '$category_id', service_id = '$service_id', employee_id = '$employee_id' WHERE id = '$id'";

			$query = $wpdb->query($sql);

			$resp['action'] = 'update';

			if($query) {
				$resp['code'] = 200;
				$resp['msg'] = 'Resource updated successfully.';
			} else {
				$resp['error'] = $wpdb->last_error;
				$resp['code'] = 409;
				$resp['msg'] = 'This source already exists.';
			}

			echo json_encode($resp);

		}

	}

 ?>