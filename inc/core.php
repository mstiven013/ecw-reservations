<?php 

	//Require Reservation model
	require_once 'models/class.Reservations.php';
	$reservation = new Reservations();

	//Require Employee model
	require_once 'models/class.Employees.php';
	$employees = new Employees();

	//Require Services model
	require_once 'models/class.Services.php';
	$services = new Services();	

	//Require Categories model
	require_once 'models/class.Categories.php';
	$categories = new Categories();

	//Require Emails model
	require_once 'models/class.Emails.php';
	$emails = new Emails();	

	//Get private codex
	require_once 'private/private.php';
	
	//Get public codex
	require_once 'public/public.php';

 ?>