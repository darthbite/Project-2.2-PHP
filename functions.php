<?php
//create database connection
function connect(){
    $GLOBALS['connection'] = $connection = mysqli_connect("localhost", "root", "usbw", "unwdmi");

	//test if connection occurs
	if (mysqli_connect_errno())
	{
		die("Database connection failed: ".
		mysqli_connect_error() .
		" (" . mysqli_connect_errno() . ")");
	}
}

// Close database connection
function close(){
    mysqli_close($GLOBALS['connection']);
}

//checks the submitted data for unwanted stuff.. USE THIS FOR EVERY FORM!!!
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
