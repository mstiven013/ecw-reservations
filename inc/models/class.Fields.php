<?php 

	if(isset($_POST['action']) && isset($_POST['src'])) {
        
        if(phpversion() >= 7) {
		    include(dirname(__FILE__, 6) . '/wp-load.php'); //Require wp load
        } else {
            include(realpath(__DIR__ . '/../../../../..') . '/wp-load.php'); //Require wp load
        }

		if($_POST['src'] == 'fields'){
			switch ($_POST['action']) {
				case 'get_all':
					$requestMethod = (isset($_POST['method'])) ? $_POST['method'] : 'json';

					$fields = new EcwrFields();
					$fields->get_all($requestMethod);
					break;

				case 'create':

					$fields = new EcwrFields();
					$fields->create($_POST['field_name'], $_POST['field_id'], $_POST['field_class'], $_POST['field_label'], $_POST['field_placeholder'], $_POST['field_type'], $_POST['field_columns'], $_POST['field_options'], $_POST['field_required'], $_POST['field_state'], $_POST['field_order'], $_POST['field_autocomplete']);
					break;

				case 'update':

					$id = $_POST['id'];

					$fields = new EcwrFields();
					$fields->update($id, $_POST['field_name'], $_POST['field_id'], $_POST['field_class'], $_POST['field_label'], $_POST['field_placeholder'], $_POST['field_type'], $_POST['field_columns'], $_POST['field_options'], $_POST['field_required'], $_POST['field_state'], $_POST['field_order'], $_POST['field_autocomplete']);
					break;

				case 'delete':

					$fields = new EcwrFields();
					$fields->delete($_POST['id']);
					break;

				
				default:
					$requestMethod = (isset($_POST['method'])) ? $_POST['method'] : 'json';

					$fields = new EcwrFields();
					$fields->get_all($requestMethod);
					break;
			}
		}

	}

	class EcwrFields {

		protected $table_name = 'ecw_custom_fields';
		protected $resp = [];

		public function __construct() {
		}

		public function create_table() {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "CREATE TABLE IF NOT EXISTS $tname (
						id INT(255) AUTO_INCREMENT PRIMARY KEY,
						field_name VARCHAR(100) NOT NULL,
						field_label VARCHAR(100),
						field_placeholder VARCHAR(200),
						field_type VARCHAR(200),
						field_class VARCHAR(200),
						field_id VARCHAR(200),
						field_columns INT(200) NOT NULL DEFAULT 12,
						field_options VARCHAR(200),
						field_required VARCHAR(200) NOT NULL DEFAULT 'false',
						field_state VARCHAR(200) NOT NULL DEFAULT 'true',
						field_order INT(200) NOT NULL DEFAULT 1,
						field_autocomplete VARCHAR(50) NOT NULL DEFAULT 'off'
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

		public function create($field_name, $field_id, $field_class, $field_label, $field_placeholder, $field_type, $field_columns, $field_options, $field_required, $field_state, $field_order, $field_autocomplete) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "INSERT INTO $tname (field_name, field_id, field_class, field_label, field_placeholder, field_type, field_columns, field_options, field_required, field_state, field_order, field_autocomplete) VALUES ('$field_name', '$field_id', '$field_class', '$field_label', '$field_placeholder', '$field_type', '$field_columns', '$field_options', '$field_required', '$field_state', '$field_order', '$field_autocomplete')";

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

		public function update($id, $field_name, $field_id, $field_class, $field_label, $field_placeholder, $field_type, $field_columns, $field_options, $field_required, $field_state, $field_order, $field_autocomplete) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "UPDATE $tname SET field_name = '$field_name', field_id = '$field_id', field_class = '$field_class', field_label = '$field_label', field_placeholder = '$field_placeholder', field_type = '$field_type', field_columns = '$field_columns', field_options = '$field_options', field_required = '$field_required', field_state = '$field_state', field_order = '$field_order', field_autocomplete = '$field_autocomplete' WHERE id = '$id'";

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

		public function delete($id) {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "DELETE FROM $tname WHERE id = '$id'";

			$query = $wpdb->query($sql);

			$resp['action'] = 'delete';

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

	}

 ?>