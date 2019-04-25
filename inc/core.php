<?php 

    if(phpversion() >= 7) {
	    include(dirname(__FILE__, 5) . '/wp-load.php'); //Require wp load
	} else {
	    include(realpath(__DIR__ . '/../../../..') . '/wp-load.php');
	}

	//Require Reservation model
	require_once('models/class.Reservations.php');
	$reservation = new Reservations();
	add_action('init', array($reservation, 'create_table'));

	//Require Emails model
	require_once('models/class.Fields.php');
	$fields = new EcwrFields();	
	add_action('init', array($fields, 'create_table'));

	//Get private codex
	include('private/private.php');
	
	//Get public codex
	include('public/public.php');
	$public = new PublicEcw();

 ?>