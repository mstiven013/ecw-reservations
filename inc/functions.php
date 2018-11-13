<?php 

	require_once dirname(__FILE__, 5) . '/wp-load.php'; //Require wp load

	//Reservations
	require_once 'models/class.Reservations.php'; // Require and run Reservations model
	$reservations = new Reservations();
	$all_reservations = $reservations->get_all('array');

	//Employees
	require_once 'models/class.Employees.php'; // Require and run Employees model
	$employees = new Employees();
	$all_employees = $employees->get_all('array');

	//Services
	require_once 'models/class.Services.php'; // Require and run Services model
	$services = new Services();
	$all_services = $services->get_all('array');

	//Categories
	require_once 'models/class.Categories.php'; // Require and run Categories model
	$categories = new Categories();
	$all_categories = $categories->get_all('array');

 ?>