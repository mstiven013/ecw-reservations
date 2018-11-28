<?php 
	
	include(dirname(__FILE__, 5) . '/wp-load.php'); //Require wp load

	//Reservations
	function all_reservations() {
		require_once('models/class.Reservations.php'); // Require and run Reservations model
		$reservations = new Reservations();
		$res = $reservations->get_all('array');
		echo $res;
	}

	//Employees
	function all_employees() {
		require_once('models/class.Employees.php'); // Require and run Employees model
		$employees = new Employees();
		return $employees->get_all('array');
	}

	//Services
	function all_services() {
		require_once('models/class.Services.php'); // Require and run Services model
		$services = new Services();
		return $services->get_all('array');
	}

	//Categories
	function all_categories() {
		require_once('models/class.Categories.php'); // Require and run Categories model
		$categories = new Categories();
		return $categories->get_all('array');
	}

	//Fields
	function all_fields() {
		require_once('models/class.Fields.php'); // Require and run Fields model
		$fields = new EcwrFields();
		return $fields->get_all('array');
	}

	function fields_sort($a, $b, $sortby = 'field_order') {
	  return $a->field_order > $b->field_order;
	}

 ?>