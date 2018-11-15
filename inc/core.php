<?php 

    include(dirname(__FILE__, 5) . '/wp-load.php'); //Require wp load

	//Require Reservation model
	require_once('models/class.Reservations.php');
	$reservation = new Reservations();
	add_action('init', array($reservation, 'create_table'));

	//Require Employee model
	require_once('models/class.Employees.php');
	$employees = new Employees();
	add_action('init', array($employees, 'create_table'));

	//Require Services model
	require_once('models/class.Services.php');
	$services = new Services();	
	add_action('init', array($services, 'create_table'));

	//Require Categories model
	require_once('models/class.Categories.php');
	$categories = new Categories();
	add_action('init', array($categories, 'create_table'));

	//Require Emails model
	require_once('models/class.Emails.php');
	$emails = new Emails();	
	add_action('init', array($emails, 'create_table'));

	//Get private codex
	include('private/private.php');
	
	//Get public codex
	include('public/public.php');
	$public = new PublicEcw();

 ?>