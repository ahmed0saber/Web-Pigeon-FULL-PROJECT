<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "web-pigeon";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  //$conn->set_charset("UTF8");
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
