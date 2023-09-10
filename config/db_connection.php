<?php

  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "my_cricketers";

  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  if(!$con) {
    echo 'Connection error: ' . mysqli_connect_error();
  }
