<?php 

	if(isset($_POST['action']) && isset($_POST['src'])) {

		include(dirname(__FILE__, 6) . '/wp-load.php'); //Require wp load

		if($_POST['src'] == 'employees') {
			switch ($_POST['action']) {
				case 'get_all':

					$requestMethod = (isset($_POST['method'])) ? $_POST['method'] : 'json';
					$employees = new Employees();
					$employees->get_all($requestMethod);

					break;

				case 'create':

					//Required's
					$name = $_POST['name'];
					$lastname = $_POST['lastname'];
					$mobile = $_POST['mobile'];
					$email = $_POST['email'];

					//Optionals
					$phone = (isset($_POST['phone'])) ? $_POST['phone'] : null;
					$address = (isset($_POST['address'])) ? $_POST['address'] : null;
					$office = (isset($_POST['office'])) ? $_POST['office'] : null;

					$employees = new Employees();
					$employees->create($name, $lastname, $phone, $mobile, $email, $address, $office);

					break;

				case 'update':

					//Required's
					$id = $_POST['id'];
					$name = $_POST['name'];
					$lastname = $_POST['lastname'];
					$mobile = $_POST['mobile'];
					$email = $_POST['email'];

					//Optionals
					$phone = (isset($_POST['phone'])) ? $_POST['phone'] : null;
					$address = (isset($_POST['address'])) ? $_POST['address'] : null;
					$office = (isset($_POST['office'])) ? $_POST['office'] : null;

					$employees = new Employees();
					$employees->update($id, $name, $lastname, $phone, $mobile, $email, $address, $office);

					break;
				
				default:
					# code...
					break;
			}
		}

	}

	class Employees {

		protected $table_name = 'ecw_employees';

		public function __construct() {
		}

		public function create_table() {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "CREATE TABLE IF NOT EXISTS $tname (
						id INT(255) AUTO_INCREMENT PRIMARY KEY,
						name VARCHAR(100) NOT NULL,
						lastname VARCHAR(100) NOT NULL,
						phone VARCHAR(100),
						mobile VARCHAR(100),
						email VARCHAR(150) UNIQUE NOT NULL,
						address VARCHAR(250),
						office VARCHAR(100)
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

		public function create($name, $lastname, $phone, $mobile, $email, $address, $office) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "INSERT INTO $tname (name, lastname, phone, mobile, email, address, office) 
					VALUES ('$name', '$lastname', '$phone', '$mobile', '$email', '$address', '$office')";

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

		public function update($id, $name, $lastname, $phone, $mobile, $email, $address, $office) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "UPDATE $tname SET name = '$name', lastname = '$lastname', phone = '$phone', mobile = '$mobile', email = '$email', address = '$address', office = '$office' WHERE id = '$id' AND email = '$email'";

			$query = $wpdb->query($sql);

			$resp['action'] = 'update';

			if($query) {
				$resp['code'] = 200;
				$resp['msg'] = 'Resource updated successfully.';
			} else {
				$resp['code'] = 409;
				$resp['msg'] = 'This source already exists.';
			}

			echo json_encode($resp);

		}

	}

 ?>