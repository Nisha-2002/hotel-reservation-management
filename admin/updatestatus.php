<?php
  session_start();
  if(!isset($_SESSION["name"]))
    header("location: authorize.php");
  $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
  $bookingid = isset($_POST["bookingid"])?$_POST["bookingid"]:'';
  $status = isset($_POST["status"])?$_POST["status"]:'';
  $query = "update booking_details set status='$status' where bookingid=$bookingid";
  pg_query($con, $query);
 header("location:index.php");
    
  ?>