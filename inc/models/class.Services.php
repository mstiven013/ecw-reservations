<?php 

	if(isset($_POST['action']) || isset($_POST['src'])) {

		if($_POST['action'] == 'get_all' && $_POST['src'] == 'services') {

			require_once("../../../../../wp-load.php");
			$services = new Services();
			$services->get_all();
		}

	}

	class Services {

		protected $table_name = 'ecw_services';

		public function __construct() {
			add_action('init', array($this, 'create_table'));
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