<?php 

	if(isset($_POST['action']) && isset($_POST['src'])) {

		include(dirname(__FILE__, 6) . '/wp-load.php'); //Require wp load

		if($_POST['src'] == 'services'){
			switch ($_POST['action']) {
				case 'get_all':
					$requestMethod = (isset($_POST['method'])) ? $_POST['method'] : 'json';

					$services = new Services();
					$services->get_all($requestMethod);
					break;

				case 'create':

					$title = $_POST['title'];
					$description = $_POST['description'];
					$image = (isset($_POST['image'])) ? $_POST['image'] : "no_image";

					$services = new Services();
					$services->create($title, $description, $image);
					break;

				case 'update':

					$id = $_POST['id'];
					$title = $_POST['title'];
					$description = $_POST['description'];
					$image = (isset($_POST['image'])) ? $_POST['image'] : "no_image";

					$services = new Services();
					$services->update($id, $title, $description, $image);
					break;

				
				default:
					$requestMethod = (isset($_POST['method'])) ? $_POST['method'] : 'json';

					$services = new Services();
					$services->get_all($requestMethod);
					break;
					break;
			}
		}

	}

	class Services {

		protected $table_name = 'ecw_services';
		protected $resp = [];

		public function __construct() {
		}

		public function create_table() {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name;// Table name

			$sql = "CREATE TABLE IF NOT EXISTS $tname (
						id INT(255) AUTO_INCREMENT PRIMARY KEY,
						title VARCHAR(100) NOT NULL,
						description VARCHAR(100),
						image VARCHAR(200)
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

		public function create($title, $description, $image) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "INSERT INTO $tname (title, description, image) VALUES ('$title', '$description', '$image')";

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

		public function update($id, $title, $description, $image) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "UPDATE $tname SET title = '$title', description = '$description', image = '$image' WHERE id = '$id'";

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