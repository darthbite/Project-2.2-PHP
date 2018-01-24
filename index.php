<?php
include("database.php");
echo connect();
session_start();
?>
<html>
<body>
<head>
	<title>H&M Weather Data</title>
	<INPUT TYPE="button" value="test" class= "btn btn-primary" onClick="parent.location='index.php?content=test'">
	<?php
	$content = 'home';
	if(isset($_GET['content'])){
		$content = $_GET['content'];
	} 
	include("".$content .".php");
?>
</body>
</html>
