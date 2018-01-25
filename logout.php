<!DOCTYPE html>
<html>
<head>
<title></title>
<h1></h1>
</head>
<body>
	<?php
    session_start();
    session_destroy();
    header("Location: index.php");
	?>
</body>
</html>
