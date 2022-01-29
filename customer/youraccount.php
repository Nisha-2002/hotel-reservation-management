<?php
  session_start();
  
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="customerstyle.css">
    <title>Home Page</title>
</head>
<hr>
    <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 fixed-top">
        <div class="container">
            <a href="index.php" class="navbar-brand text-info">The Coastal Bay Hotel</a>
            <form action="booknow.php" class="navbar-sm-nav form-inline px-3 ms-auto d-lg-none">
                <button class="btn btn-warning">Book Now</button>
            </form>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item px-3">
                        <a href="youraccount.php" class="nav-link"><?php echo(isset($_SESSION["name"])?'Your account':'')?></a>
                    </li>
                    <li class="nav-item px-3">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a href="faq.php" class="nav-link">FAQs</a>
                    </li>
                    <?php if(!isset($_SESSION["name"]))
                      echo
                        '<li class="nav-item px-3">
                            <button class="btn btn-link text-secondary text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginform">Sign-In</button>
                        </li>';?>
                        <?php if(isset($_SESSION["name"]))
                      echo
                        '<li class="nav-item px-3">
                        <a href="logout.php" class="nav-link">Log-Out</a>
                        </li>'?>
                    <form action="booknow.php" class="navbar-sm-nav form-inline px-3 ml-auto d-none d-lg-block">
                        <button class="btn btn-warning">Book Now</button>
                    </form>
                </ul>
            </div>
            
        </div>
    </nav>
    <!-- End of Navbar -->
    <!-- Previous bookings -->
    <section class="p-5  bg-light">
        <div class="container">
            <h4 class="text-warning">Your bookings</h4>
            <hr class="text-warning">
            <?php
                $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
                $customerid= $_SESSION["id"];
                $que1 = "Select * from booking_details where bookingid in (select bookingid from guest_details where customerid='$customerid')";
                $res1= pg_query($con, $que1);
                while($row=pg_fetch_assoc($res1))
                {

                     echo '<div class="card mb-3 bg-dark text-light">';
                            echo '<div class="card-body">';
                                echo '<div class="row mb-3">';
                                            echo '<div class="col-md-4">';
                                                echo '<h5 class="card-title text-info mb-2">'.$row["roomtype"].'</h5>';
                                            echo '</div>';
                                            echo '<div class="col-md-2">';
                                                echo '<p class="text-warning">Check-In Date </p><p>'.$row["checkindate"].'</p>';
                                            echo '</div>';
                                            echo '<div class="col-md-2">';
                                                echo '<p class="text-warning">Check-Out Date </p><p>'.$row["checkoutdate"].'</p>';
                                            echo '</div>';
                                            echo '<div class="col-md-2">';
                                                echo '<p class="text-warning">Amount Paid   </p><p>₹'.$row["payableamount"].'</p>';
                                            echo '</div>';
                                            echo '<div class="col-md-2">';
                                                echo '<p class="text-warning">Status </p><p class="text-success">'.$row["status"].'</p>';
                                            echo '</div>'; 
                                echo '</div>';   
                            echo '</div>';
                        echo '</div>';
                }?>
        </div>
    </section>
    <!-- End of previous bookings section -->
    <!-- Start of footer section -->
  <footer class="bg-dark p-5">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-2 p-3 ml-5">
        <h5 class="text-warning py-3">Pages</h5>
        <a href="index.php" class="text-decoration-none text-light">Home</a><br>
        <a href="faq.php" class="text-decoration-none text-light">FAQs</a><br>
        <a href="booknow.php" class="text-decoration-none text-light">Book Your Stay</a>
      </div>
      <div class="col-md-2 p-3">
        <h5 class="text-warning py-3">Address</h5>
        <p class="text-light">4, Coastal Beach Road,<br> East High,<br> Maldives.</p>
      </div>
      <div class="col-md-2 p-3">
        <h5 class="text-warning py-3">Contact</h5>
        <p class="text-light">+91 99654 78321<br> coastalbayhotel@gmail.com</p>
      </div>
      <div class="col-md-3"></div>
    </div>

  </footer>
  <!-- End of footer section -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>