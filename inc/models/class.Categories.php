<?php 

	if(isset($_POST['action']) && isset($_POST['src'])) {

		require_once("../../../../../wp-load.php");

		if($_POST['action'] == 'get_all' && $_POST['src'] == 'categories') {
			$categories = new Categories();
			$categories->get_all();
		}

	}

	class Categories {

		protected $table_name = 'ecw_categories';

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