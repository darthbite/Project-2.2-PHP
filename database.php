<?php
function connect(){
	$connection = mysqli_connect("localhost", "root", "toor", "unwdmi");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	//mysqli_select_db($hi, "unwdmi") or die(mysqli_error());
}
?>