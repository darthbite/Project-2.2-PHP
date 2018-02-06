<?php session_start();
include 'functions.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>UNWDMI Colombia</title>
</head>
<body>

      <header>
          <div class="container">
              <nav class="mx-auto w-50 p-0 navbar navbar-expand-lg navbar-light bg-light">
                <img src="images/logo.png" style="display: inline-block; max-width: 15%;"class="img-fluid">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                          <a class="nav-link" href="all.php">All</a>
                        </li>
                       <li class="nav-item">
                          <a class="nav-link" href="Ukraine.php">Ukraine</a>
                       </li>
                       <li class="nav-item active">
                         <a class="nav-link" href="Colombia.php">Colombia<span class="sr-only">(current)</span></a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" href="Vietnam.php">Vietnam</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" href="Georgia.php">Georgia</a>
                       </li>
                      <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                      </li>
                    </ul>
                </div>
              </nav>
              </div>
      </header>
      <?php
      if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
          $_SESSION['message'] = "You have to be logged in to see that page.";
          header("Location: index.php");
      }

      ?>
      <?php
      $query = "SELECT stn FROM `stations` WHERE country = 'Colombia';";
      $array1 = array();
      connect();
      $result = mysqli_query($connection, $query);
      if($result){
          while ($row = mysqli_fetch_assoc($result)) {
              $array1 = array_merge($array1, array_map('trim', explode(",", $row['stn'])));
          }
      }
      close();

       ?>
    <br>
    <h3 class="text-center">Weather Data for Columbia</h3>
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Station</th>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Temperature in C°</th>
            <th scope="col">Dew Point in C°</th>
            <th scope="col">Airpressure at sea level in Millibar</th>
            <th scope="col">Airpressure at station level in Millibar</th>
            <th scope="col">Visibility Range in KM</th>
            <th scope="col">Rainfall in CM</th>
            <th scope="col">Windspeed in KM/H</th>
            <th scope="col">Snowfall in CM</th>
            <th scope="col">Event</th>
            <th scope="col">Cloudiness in %</th>
            <th scope="col">Wind Direction in Degrees</th>
          </tr>
        </thead>
      <tbody>
          <?php
$files = glob("/var/weatherdata/*.xml");
          if (is_array($files))
          {
               foreach($files as $filename)
               {
                   $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
                   $withoutData = substr($withoutExt, 5);
                   if (in_array($withoutData, $array1)){
                      $xml_file = file_get_contents($filename, FILE_TEXT);
                      // and proceed with your code
                      $name = new SimpleXMLElement($xml_file);
                      $eventlist = $name ->MEASUREMENT ->FRSHTT;
                      $eventsplit = str_split($eventlist);
                      $ev = "";
                          if ($eventsplit[0] == '1'){
                                  $ev .= "❆";
                              }
                          if ($eventsplit[1] == "1"){
                                   $ev .="☂";
                               }
                          if ($eventsplit[2] == "1"){
                                   $ev .="☃";
                               }
                          if ($eventsplit[3] == "1"){
                                   $ev .="❅";
                               }
                          if ($eventsplit[4] == "1"){
                                   $ev .="🌩";
                               }
                          if ($eventsplit[5] == "1"){
                                   $ev .="🌪";
                               }
                          echo"<tr>";
                                echo"<td>". $name ->MEASUREMENT->STN."</th>";
                                echo"<td>". $name ->MEASUREMENT->DATE."</td>";
                                echo"<td>". $name ->MEASUREMENT->TIME."</td>";
                                echo"<td>". $name ->MEASUREMENT->TEMP."</td>";
                                echo"<td>". $name ->MEASUREMENT->DEWP."</td>";
                                echo"<td>". $name ->MEASUREMENT->SLP."</td>";
                                echo"<td>". $name ->MEASUREMENT->STP."</td>";
                                echo"<td>". $name ->MEASUREMENT->VISIB."</td>";
                                echo"<td>". $name ->MEASUREMENT->PRCP."</td>";
                                echo"<td>". $name ->MEASUREMENT->WDSP."</td>";
                                echo"<td>". $name ->MEASUREMENT->SNDP."</td>";
                                echo"<td>". $ev. "</td>";
                                echo"<td>". $name ->MEASUREMENT->CLDC."</td>";
                                echo"<td>". $name ->MEASUREMENT->WNDDIR."</td>";
                          echo"</tr>";
                      }
               }
          }
          ?>
      </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </body>
</html>
