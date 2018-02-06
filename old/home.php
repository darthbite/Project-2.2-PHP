<?php
session_start();
include 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<h1>Home</h1>
<form>
    <input type="button" value="Logout" onclick="window.location.href='logout.php'" />
</form>
<?php
if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
    $_SESSION['message'] = "You have to be logged in to see that page.";
    header("Location: login.php");
}

?>
</head>
<body>
<?php
$query = "SELECT DISTINCT country FROM stations;";
connect();
$result = mysqli_query($connection, $query);
?>
    <h2> Dynamic Drop Down List </h2>
<?php
if($result){
    echo '<select name="country"<OPTION>';
    echo "Select an option</OPTION>";
    while ($row = mysqli_fetch_assoc($result)){
        $country = $row['country'];
        echo '<option value="'.$country.'">'.$country.'</option>';
    }
}else echo"no result";
close();
?>

</body>
</html>
