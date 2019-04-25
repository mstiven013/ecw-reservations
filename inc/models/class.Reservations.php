<?php 

	if(isset($_POST['action']) && isset($_POST['src'])) {

		if(phpversion() >= 7) {
		    include(dirname(__FILE__, 6) . '/wp-load.php'); //Require wp load
        } else {
            include(realpath(__DIR__ . '/../../../../..') . '/wp-load.php'); //Require wp load
        }

		if($_POST['src'] == 'reservations') {

			switch ($_POST['action']) {
				case 'get_all':

					$requestMethod = (isset($_POST['method'])) ? $_POST['method'] : 'json';
					$reservations = new Reservations();
					$reservations->get_all($requestMethod);

					break;

				case 'create':

					$reservations = new Reservations();
					$reservations->create($_POST);

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
					$reservations->update($id, $reservation_date, $reservation_hour, $person_name, $person_phone, $person_email, $aditional_notes, $category_id, $service_id, $employee_id);

					break;

				case 'delete':

					$id = $_POST['id'];
					$reservations = new Reservations();
					$reservations->delete($id);

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
		protected $resp = [];

		public function __construct() {
		}

		public function create_table() {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "CREATE TABLE IF NOT EXISTS $tname (
						id INT(255) AUTO_INCREMENT PRIMARY KEY,
						user_email VARCHAR(50) NOT NULL,
						reservation_date VARCHAR(50) NOT NULL,
						reservation_hour VARCHAR(50) NOT NULL,
						message VARCHAR(2500)
					) CHARACTER SET utf8;";

			$wpdb->query($sql);

		}

		public function get_all($method) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name
			$tcategory = $wpdb->prefix . 'ecw_categories';
			$tservice = $wpdb->prefix . 'ecw_services';
			$temployee = $wpdb->prefix . 'ecw_employees';

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

		public function create($args) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$array = [];

			foreach ($_POST as $field => $val) {
				$key = '[' . $field . ']';
				$array[$key] = $val;
			}

			$user_email = strtr(get_option('ecwr_mail_to'), $array);
			$res_date = strtr(get_option('ecwr_reservation_date'), $array);
			$res_hour = strtr(get_option('ecwr_reservation_hour'), $array);

			//Generate email template
			$temp = get_option('ecwr_mail_template');
			$email_template = strtr($temp, $array);

			$sql = "INSERT INTO $tname (user_email, reservation_date, reservation_hour, message)
						VALUES ('$user_email', '$res_date', '$res_hour', '$email_template')";

			$query = $wpdb->query($sql);
            
			$resp['action'] = 'create';

			if($query) {

				require_once 'class.Emails.php';
				$email = new Emails();

				if($email->reservation($user_email, $email_template)) {
				    
					$resp['code'] = 200;
					$resp['msg'] = 'Resource saved successfully.';
					
				} else {
					$resp['error'] = $wpdb->last_error;
					$resp['code'] = 500;
					$resp['msg'] = 'Error saving this resource.';
				}

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

		public function delete($id) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "DELETE FROM $tname WHERE id = '$id'";

			$query = $wpdb->query($sql);

			$resp['action'] = 'delete';
			$resp['id'] = $id;

			if($query) {
				$resp['code'] = 200;
				$resp['msg'] = 'Resource updated successfully.';
			} else {
				$resp['error'] = $wpdb->last_error;
				$resp['code'] = 200;
				$resp['msg'] = 'An error has ocurred in server.';
			}

			echo json_encode($resp);

		}

		public function sendEmailCreate($reservation_id) {

		}

	}

 ?>