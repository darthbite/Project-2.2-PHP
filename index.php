<!doctype html>
<?php
    session_start();
    $_SESSION['message'] = "";
    //include file with database connection functions.
    include 'functions.php';
?>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>UNWDMI Login</title>

</head>
<body>
    <header>
        <div class="container">

              <img src="images/logo.png" style="display: inline-block; max-width: 15%;"class="img-fluid">

            </div>
    </header>
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
                    header('Location: all.php'); //<----- NEW PAGE HERE
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

    <form action="" method="post">
        <div class="container">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
