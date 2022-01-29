<?php
  session_start();
  if(!isset($_SESSION["id"]))
  {
    echo "<script>
    alert('Please login/sign-up to book your stay!');
    window.location.href='index.php';  
    </script>";
  }
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
    <title>Book Now Page</title>
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
    <!-- Start of check availabilty form -->
    <section class="bg-light p-5">
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="row">
                    <div class="col-md-4 col-sm-6 mb-3">
                        <label for="checkindate" class="form-label fw-bold">Check-In Date:</label>
                        <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" id="checkindate" name="checkindate" value="<?php echo isset($_POST['checkindate']) ? $_POST['checkindate'] : '' ?> required" >
                    </div>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <label for="checkoutdate" class="form-label fw-bold">Check-Out Date:</label>
                        <input type="date" min="<?php echo date("Y-m-d"); ?>" class="form-control" id="checkoutdate" name="checkoutdate" value="<?php echo isset($_POST['checkoutdate']) ? $_POST['checkoutdate'] : '' ?> required" >
                    </div>
                    <div class="col-md-4 col-sm-12 mb-3 ms-0">
                        <label for="roomtype" class="form-label fw-bold">Room Type:</label>
                        <select class="form-select" id="roomtype" name="roomtype" value="<?php echo isset($_POST['roomtype']) ? $_POST['roomtype'] : '' ?>" >
                            <option selected>All</option>
                            <?php
                                $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
                                $que = "select * from suites";
                                $res = pg_query($con, $que);
                                while($row = pg_fetch_assoc($res))
                                    echo '<option value="'.$row["room_type_id"].'">'.$row["room_type"].'</option>';
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning btn-block" id="checkAvailability">Check Availability</button>
                 
                </div>
            </form>`
        </div>
    </section>
    <!-- End of check availability form -->
    <!-- Start of rooms display -->
    <section class="p-5">
        <div class="container">
            

            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    $checkindate = $_POST["checkindate"];
                    $checkoutdate = $_POST["checkoutdate"];
                    $room_type = $_POST["roomtype"];
                    if($room_type=="All")
                        $que2 = "Select * from suites";
                    else
                        $que2 = "select * from suites where room_type_id=$room_type";
                    $res2 =pg_query($con, $que2);
                
                    $que3 = "select * from ($que2) as que2 where no_available>0";
                    $que4 = "select * from ($que2) as que2 except (select * from ($que2) as que2 where no_available>0)";
                    $res3 = pg_query($con, $que3);
                    $res4 = pg_query($con, $que4);
                    $status='Available';
                    while($row=pg_fetch_assoc($res3))
                    {
                        $status='Available';
                        $begin = new DateTime($checkindate);
                        $end   = new DateTime($checkoutdate);
                    
                        for($j = $begin; $j <= $end; $j->modify('+1 day')){
                            $i = $j->format("Y-m-d");
                            $query5 = "select count(*) as freq  from booking_details where ('$i'= checkindate or '$i'=checkoutdate or ('$i' between checkindate and checkoutdate)) and roomtype='$row[room_type]'";
                            $result5 = pg_query($con, $query5);
                            $row5 = pg_fetch_assoc($result5);
                            if($row5['freq']>=$row["no_available"])
                            {
                                $status = "Unavailable";
                                break;}
                            }
                        
                        echo '<div class="card mb-3 bg-light">';
                            echo '<div class="row p-3">';
                                echo '<div class="col-md-4 p-3">';
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode(pg_unescape_bytea($row["room_image"])).'"class="card-img-top img-thumbnail w-100 img-fluid rounded-start">';
                                echo '</div>';
                                echo '<div class="col-md-8 p-3"';           
                                    echo '<div class="card-body">';
                                                echo '<h5 class="card-title text-info">'.$row["room_type"].'</h5>';
                                                echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod laoreet leo, et bibendum felis scelerisque non. Etiam sodales venenatis enim at tristique. Phasellus aliquet fringilla ipsum, vitae mattis ligula.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod laoreet leo, et bibendum felis scelerisque non. Etiam sodales venenatis enim at tristique. Phasellus aliquet fringilla ipsum, vitae mattis ligula.</p>';
                                                if($status=="Available")
                                                {echo '<p class="text-success">Available</p>';
                                                echo '<p class="text-black lead">₹ '.$row["room_cost"].'/night</p>';
                                                echo '<form action="bookingdetails.php" method=POST>';
                                                    echo '<input class="d-none" type="date" name="checkindate" value='.$checkindate.'>';
                                                    echo '<input class="d-none" type="date" name="checkoutdate" value='.$checkoutdate.'>';
                                                    echo '<input class="d-none" type="text" name="roomtype" value="'.$row["room_type"].'">';
                                                    echo '<input class="d-none" type="text" name="roomtypeid" value='.$row["room_type_id"].'>';
                                                echo '<button class="btn btn-warning">Book Now</button>';}
                                                else
                                                    {
                                                        echo '<p class="text-danger">Unavailable</p>';
                                                        echo '<p class="text-black lead">₹ '.$row["room_cost"].'/night</p>';
                                                
                                                    }
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                    while($row=pg_fetch_assoc($res4))
                    {
                        echo '<div class="card mb-3 bg-light">';
                            echo '<div class="row p-3">';
                                echo '<div class="col-md-4 p-3">';
                                    echo '<img src="data:image/jpeg;base64,'.base64_encode(pg_unescape_bytea($row["room_image"])).'"class="card-img-top img-thumbnail w-100 img-fluid rounded-start">';
                                echo '</div>';
                                echo '<div class="col-md-8 p-3"';           
                                    echo '<div class="card-body">';
                                                echo '<h5 class="card-title text-info">'.$row["room_type"].'</h5>';
                                                echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod laoreet leo, et bibendum felis scelerisque non. Etiam sodales venenatis enim at tristique. Phasellus aliquet fringilla ipsum, vitae mattis ligula.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod laoreet leo, et bibendum felis scelerisque non. Etiam sodales venenatis enim at tristique. Phasellus aliquet fringilla ipsum, vitae mattis ligula.</p>';
                                                echo '<p class="text-danger">Unavailable</p>';
                                                echo '<p class="text-black lead">₹ '.$row["room_cost"].'/night</p>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                }?>
            <!-- // <div class="card mb-3">
            //     <div class="row">
            //         <div class="col-md-4">
            //             <img src="..." class="img-fluid rounded-start" alt="...">
            //         </div>
            //         <div class="col-md-8">
            //             <div class="card-body">
            //                 <h5 class="card-title">Card title</h5>
            //                 <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            //                 <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            //             </div>
            //         </div>
            //     </div>
            // </div> -->
        </div>
    </section>
    <!-- End of rooms display -->
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