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
            <a href="#" class="navbar-brand text-info">The Coastal Bay Hotel</a>
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
    <!-- Start of booking form -->
    <section class="p-5">
        <div class="container p-5">
            <div class="step progress d-none">
            <div class="progress-bar" role="progressbar" style="width: 33.33%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="step progress d-none">
            <div class="progress-bar" role="progressbar" style="width: 66.66%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="step progress d-none">
            <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <form action="book.php" class="p-5 bg-dark text-light rounded mt-3" id="confirmation-form" method="POST">
                <div class="tab d-none">
                        <h4 class="text-warning">Booking Details</h4>
                        <br><hr class="text-warning">
                        <div class="">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="checkInDate" class="form-label">Check-In Date</label>
                                    <input type="date" class="form-control" id="checkInDate" name="checkInDate" value="<?php echo $_POST["checkindate"]?>" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="checkOutDate" class="form-label">Check-Out Date</label>
                                    <input type="date" class="form-control"  id="checkOutDate" name="checkOutDate" value="<?php echo $_POST["checkoutdate"]?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label for="roomType" class="form-label">Room Type</label>
                                    <input type="text" class="form-control" id="roomType" name="roomType" value="<?php echo $_POST["roomtype"]?>" readonly>
                                </div>
                            </div>
                            <h5 class="text-warning mb-3">Pricing</h5>
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Price per night</p>
                                </div>
                                <div class="col-md-4 text-warning">
                                    <p>₹<?php 
                                        $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
                                        $q = "select * from suites where room_type_id = ".$_POST['roomtypeid']."";
                                        $res = pg_query($con,$q);
                                        while($row = pg_fetch_assoc($res))
                                        {
                                            echo $row["room_cost"];
                                            $price = $row["room_cost"];
                                        }
                                        ?></p>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-8">
                                    <p>No. Of days of stay</p>
                                </div>
                                <div class="col-md-4 text-warning">
                                    <p><?php 
                                        $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
                                        $earlier = new DateTime($_POST['checkindate']);
                                        $later = new DateTime($_POST['checkoutdate']);
                                        $abs_diff = $later->diff($earlier)->format("%a");
                                        echo $abs_diff;
                                        ?></p>
                                </div>
                            </div> 
                            <hr class="text-warning">
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Total Room Rent</p>
                                </div>
                                <div class="col-md-4 mb-1 text-warning">
                                    <p>₹<?php 
                                        echo $price*$abs_diff;
                                        ?></p>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Service charges & Tax (18%)</p>
                                </div>
                                <div class="col-md-4 mb-1 text-warning">
                                    <p>₹<?php 
                                        $tax =18/100*($price*$abs_diff);
                                        echo $tax;
                                        ?></p>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-7">
                                </div>
                                <div class="col-md-3 mb-1 text-warning">
                                    <hr class="text-warning">
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Total Payable Amount</p>
                                </div>
                                <div class="col-md-4 mb-1 text-warning fw-bold">
                                    <p class="lead">₹<?php 
                                        echo $tax + ($price*$abs_diff);
                                        ?>
                                    </p>
                                    <input type="number" id="payableAmount" class="form-control d-none"  name="payableAmount" value="<?php 
                                        echo $tax + ($price*$abs_diff);
                                        ?>" readonly>
                                </div>
                            </div> 
                        </div>
                    </div>
                        <div class="tab d-none">
                            <h4 class="text-warning">Personal Details</h4>
                            <br><hr class="text-warning">
                            <div class="">
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" id="firstName" name="firstName" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" id="lastName" name="lastName" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="contactNo" class="form-label">Contact No.</label>
                                        <input type="tel" class="form-control" placeholder="Contact Number" id="contactNo" name="contactNo" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="altContactNo" class="form-label">Alternative contact no.</label>
                                        <input type="tel" class="form-control" placeholder="Alternative Contact No." id="altContactNo" name="altContactNo">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="mailId" class="form-label">E-Mail ID</label>
                                        <input type="email" class="form-control" placeholder="Enter your email id" id="mailId" name="mailId" required>
                                    </div>
                                </div> 
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="address" class="form-label">Permanent Residential Address</label>
                                        <textarea class="form-control" cols="50" rows="6" placeholder="Enter your address" id="address" name="address" required></textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>
                
                        <div class="tab d-none">
                            <h4 class="text-warning">Payment Details</h4>
                            <br><hr class="text-warning">
                            <h5 class="text-warning mb-3">Card Details</h5><br>
                            <div class="">
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="cardno" class="form-label">Card Number</label>
                                        <input type="number" class="form-control" maxlength="16" placeholder="Card No." id="cardNo" name="cardNo" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="expDate" class="form-label">Expiry Date</label>
                                        <input type="month" class="form-control" placeholder="" id="expDate" name="expDate" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="cvv" class="form-label">CVV</label>
                                        <input type="number" class="form-control" placeholder="CVV" id="cvv" name="cvv" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="cardname" class="form-label">Card Holder Name</label>
                                        <input type="text" class="form-control" placeholder="Name on the card" id="cardName" name="cardName" required>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 mb-3">
                                <button type="button" class="btn btn-warning btn-block"id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            </div>
                            <div class="col-sm-9"></div>
                            <div class="col-sm-1 mb-3">
                                <button class="btn btn-warning btn-block"type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                
                            </div>
                        </div>
                           
            </div>

            </form>
            
            
        </div>
    </section>

    <!-- End of booking form -->
    <!-- Java Script -->
    
    <script>
        
        var currentTab = 0; 
        // // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            
        // This function will display the specified tab of the form ...
        var x = document.getElementsByClassName("tab");
        x[n].classList.remove("d-none");
        // ... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").classList.add("d-none");
        } else {
            if(document.getElementById("prevBtn").classList.contains("d-none"))
                document.getElementById("prevBtn").classList.remove("d-none");
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML ="Confirm";
            
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        
        // // ... and run a function that displays the correct step indicator:
        fixStepIndicator(n)
        }

        function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].classList.add("d-none");
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form... :
        if (currentTab >= x.length) {
            //...the form gets submitted:
            document.getElementById("confirmation-form").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
        }
        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                // add an "invalid" class to the field:
                
                // and set the current valid status to false:
                valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].classList.remove("d-none");
            }
            return valid; // return the valid status
            }

        
    

        function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].classList.add("d-none")
        }
        //... and adds the "active" class to the current step:
        x[n].classList.remove("d-none");
        }
        </script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></>
</body>
</html>