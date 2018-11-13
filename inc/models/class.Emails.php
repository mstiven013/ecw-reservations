<?php 

	class Emails {

		public function __construct() {
		}

		public function create_table() {

			global $wpdb;

			$tname = $wpdb->prefix . 'ecw_emails'; // Table name

			$sql = "CREATE TABLE IF NOT EXISTS $tname (
						id INT(255) AUTO_INCREMENT PRIMARY KEY,
						subject VARCHAR(100) NOT NULL,
						message VARCHAR(1000) NOT NULL,
						from VARCHAR(200) NOT NULL,
						to VARCHAR(200) NOT NULL
					) CHARACTER SET utf8;";

			$wpdb->query($sql);

		}

		public function get_all() {

			//Get all services model

		}

	}

 ?>