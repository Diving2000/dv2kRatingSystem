<?php

	// Database login credentials
	$host = "-----";
	$user = "-----";
	$password = "-----";
	$database = "-----";

	// Opret database forbindelse
	$con = new mysqli($host, $user, $password, $database);
	$con->set_charset("utf-8");

	if($con->connect_error){
		die('Cannot connect to database: (' . $con->connect_errno . ')' . $con->connect_error);
	}
