<?php
session_start();
$_SESSION['message'] = "";
//include file with database connection functions.
include 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<h1>Login</h1>
</head>
<body>
	<?php
    //checking if form was submitted
        if (isset($_POST['submit'])) {
        //storing the filled in username and pass after being checked by tester
            $login = test_input($_POST['username']);
            $pw = test_input($_POST['password']);

            $query = "SELECT * FROM users ";
            $query .= "WHERE UserName = '$login' ";
            $query .= "AND Password = '$pw'";
            connect();

            $result = mysqli_query($connection, $query);
            if($result){
                if(mysqli_num_rows($result) == 1){
                    $row = mysqli_fetch_assoc($result);
					$_SESSION['loggedin'] = true;
                    $_SESSION['userid'] = $row['ID'];
                    $_SESSION['username'] = $row['UserName'];
                    close();
                    //piece of code to check if the connection is closed after closing
                    // if(mysqli_ping($GLOBALS['connection'])){
                    //     echo "Connection live!";
                    // }
                    // else{
                    //     echo "Connection closed as it should.";
                    // }
                    header('Location: home.php'); //<----- NEW PAGE HERE
                }
                else{
                    $_SESSION['message'] = "Please enter a valid username or password";
                    close();
                    //header('Location: error.php');
                }
            }
            else{
                die("Database query failed.");
            }
        }
        else {
            $_SESSION['message'] = "Please enter your username and password";
        }
    ?>
<br/><br/>
    <form action="" method="post">
    	Username: <input type="text" name="username" /><br/>
    	Password: <input type="password" name="password" /><br/>
        <?php echo $_SESSION['message'] ?>
    	<br/>
    	<input type="submit" name="submit" value="submit" />


    </form>

</body>
</html>
