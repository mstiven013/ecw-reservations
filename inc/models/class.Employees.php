<?php 

	class Employees {

		protected $table_name = 'ecw_employees';

		public function __construct() {
			add_action('init', array($this, 'create_table'));
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

		public function get_all() {

			global $wpdb;

			$tname = $wpdb->prefix . $this->table_name; // Table name

			$sql = "SELECT * FROM $tname";

			$query = $wpdb->query($sql);

			if($query) {
				echo $query;
			}

			//Get all reservations model

		}

	}

 ?>