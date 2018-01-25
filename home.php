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
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo "Welcome to the member's area, " . $_SESSION['username'] . "!". "</br>";
    }
    else {
        $_SESSION['message'] = "You have to be logged in to see that page.";
        header("Location: login.php");
    }
?>
</head>
<body>
<?php
    $query = "SELECT DISTINCT country FROM stations;";
    //$query = "SELECT 'stations.stn', 'station_data.stn', 'stations.country'
    //FROM 'stations' JOIN 'station_data' ON 'stations.stn'='station_data.stn';";
    connect();
    $result = mysqli_query($connection, $query);
    if($result){
        while ($rows = mysqli_fetch_assoc($result)){
            echo $rows['country']. "</br>";
        }
    }
    else{
        die("Database query failed.");
    }
    close();
?>

</body>
</html>
