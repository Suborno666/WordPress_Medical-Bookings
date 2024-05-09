<?php

	$conn = mysqli_connect("localhost","root","admin#123");

	if(!$conn){

		die("Error in connection: %s\n".mysqli_connect_error($conn));
		
	}

	$dbName = "WordPress";
    
	$db_selected = mysqli_select_db($conn, $dbName);

	if(!$db_selected){
		die('Cannot use this db: '.mysqli_error($conn));
	}

?>	

