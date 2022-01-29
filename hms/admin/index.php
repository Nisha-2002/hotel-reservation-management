<?php
  session_start();
  if(!isset($_SESSION["name"]))
    header("location: authorize.php");
  $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
    
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <title>Home Page</title>
</head>
<hr>
    <body>
        <!-- Basic Navbar -->
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 fixed-top">
            <div class="container">
            <a href="index.php" class="navbar-brand text-info">The Coastal Bay Hotel</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item p-3">
                    <a href="logout.php" class="nav-link text-warning">Log-Out</a>
                </li>
            </ul>
            </div>
        </nav>
        <!-- End of basic Navbar -->
        <!-- Start of stats(cards showing number of reservation/customers)section -->
        <section class="bg-light pt-5">
            <div class="container pt-5">
            
                <div class="row">
                    <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="card text-white bg-primary h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-address-book"></i>
                                </div>
                                <div class="mr-5"><?php 
                                $q1 = "select count(*) as total_reservations from booking_details";
                                $totalReservations = pg_fetch_assoc(pg_query($con, $q1))["total_reservations"];
                                echo $totalReservations; ?><br>All-Time Reservations</div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="card text-white bg-warning o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-users ml-2"></i>
                                </div>
                                <div class="mr-5"><?php
                                $q2 = "select count(distinct customerid) as total_customers from guest_details";
                                $totalCustomers = pg_fetch_assoc(pg_query($con, $q2))["total_customers"];
                                echo $totalCustomers; ?><br> Guests</div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 mb-3">
                        <div class="card text-white bg-success o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                                <div class="mr-4"><?php
                                $date_today = date('Y-m-d');
                                $q3 = "select count(*) as upcoming_reservations from booking_details where checkindate >= '$date_today'";
                                $upcomingReservation = pg_fetch_assoc(pg_query($con, $q3))["upcoming_reservations"];
                                echo $upcomingReservation; ?> <br>Upcoming Reservations</div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- End of stats section -->
        <!-- Start of show details section -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#alltimereservation" type="button" role="tab" >All-Time Reservations</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#upcomingreservations" type="button" role="tab" >Upcoming Reservations</button>
                </li>
                
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#guests" type="button" role="tab" >All Guests</button>
                </li>
                
                </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="alltimereservation" role="tabpanel" aria-labelledby="home-tab">
                <table id="allreservationDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Booking ID</th>
                            <th scope="col">Customer ID</th>
                            <th scope="col">Check-In</th>
                            <th scope="col">Check-Out</th>
                            <th scope="col">Room type</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $q5 = "select * from booking_details";
                        $res5 = pg_query($con, $q5);$i=1; $id='hello';
                        while ($v=pg_fetch_assoc($res5)) { 
                            $q7 = "select customerid as custid from guest_details where bookingid = $v[bookingid]";
                            $customerid = pg_fetch_assoc(pg_query($con, $q7))["custid"];

                            ?>
                            
                                <tr>
                                    <?php $id = $v["bookingid"];?>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $v["bookingid"]?></td>
                                    <td><?php echo $customerid?></td>
                                    <td><?php echo $v["checkindate"]; ?></td>
                                    <td><?php echo $v["checkoutdate"]; ?></td>
                                    <td><?php echo $v["roomtype"]; ?></td>
                                    <td><?php echo $v["status"]; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" onClick="update_status(this.value)"data-bs-target="#changestatus" value="<?php echo $v['bookingid'];?>" name="submitbtn" >Update status</button>
                                    </td>
                                </tr>
                            
                        <?php ++$i; } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="guests" role="tabpanel" aria-labelledby="profile-tab">
                    <table id="guestTable" class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer ID</th>
                            <th scope="col">Full name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Alternate Contact</th>
                            <th scope="col">Address</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $q6 = "select distinct(customerid) from guest_details";$i=1;
                        $res6 = pg_query($con, $q6);
                        while($row=pg_fetch_assoc($res6)) { 
                            $q8 = "select * from guest_details where customerid=$row[customerid]";
                            $row1 = pg_fetch_assoc(pg_query($con, $q8));
                            
                            ?>
                            <tr>
                                <td scope="row"><?php echo $i; ?></td>
                                <td><?php echo $row1["customerid"]; ?></td>
                                <td><?php echo $row1["firstname"].' '.$row1["lastname"];  ?></td>
                                <td><?php echo $row1["emailid"]; ?></td>
                                <td><?php echo $row1["contactno"]; ?></td>
                                <td><?php echo $row1["altcontactno"]; ?></td>
                                <td><?php echo $row1["address"]; ?></td>
                            </tr>
                            
                        <?php ++$i;} ?>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="upcomingreservations" role="tabpanel">
                <table id="upcomingreservationDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Booking ID</th>
                            <th scope="col">Customer ID</th>
                            <th scope="col">Check-In</th>
                            <th scope="col">Check-Out</th>
                            <th scope="col">Room type</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $q9 = "select * from booking_details where checkindate >= '$date_today'";;
                        $res9 = pg_query($con, $q9);$i=1;
                        while ($v=pg_fetch_assoc($res9)) { 
                            $q10 = "select customerid as custid from guest_details where bookingid = $v[bookingid]";
                            $customerid = pg_fetch_assoc(pg_query($con, $q10))["custid"];

                            ?>
                            
                                <tr>
                                    <th scope="row"><?php echo $i; ?></th>
                                    <td><?php echo $v["bookingid"]?></td>
                                    <td><?php echo $customerid?></td>
                                    <td><?php echo $v["checkindate"]; ?></td>
                                    <td><?php echo $v["checkoutdate"]; ?></td>
                                    <td><?php echo $v["roomtype"]; ?></td>
                                    <td><?php echo $v["status"]; ?></td>
                                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" onClick="update_status(this.value)"data-bs-target="#changestatus" value="<?php echo $v['bookingid'];?>" name="submitbtn" >Update status</button>
                                    </td>
                                    
                                </tr>
                            
                        <?php ++$i; } ?>
                        </tbody>
                    </table>


                </div>
                </div>
                
            </div>
        </section>
        <!-- End of details section -->
        
        <!-- Start of modal to update status -->
        <div class="modal fade" id="changestatus" tabindex="-1" >
            <script>alert($("button").val());</script>
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="updatestatus.php" class="p-5">
                    <label for="bookingid">Booking ID :</label>
                    <input type="number" class="input-control mb-3" name="bookingid" id="BookingID" readonly>
                    <select class="form-select" name="status" id="status "aria-label="Default select example">
                        <option selected>Select status</option>
                        <option value="Booked">Booked</option>
                        <option value="Checked-In">Checked-In</option>
                        <option value="Checked-Out">Checked-Out</option>
                    </select>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button></form>
                </div>
                </div>
            </div>
        </div>
        <script>
            
            var input_id = document.getElementById("BookingID");
           
          
            function update_status(clicked) {
                input_id.value = clicked;
            }     
        </script>
       
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>