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
    <!-- Start of FAQ's section -->
    <section class="p-5 bg-light">
        <div class="container">
            <h4 class="text-warning pt-5">Frequently Asked Questions</h4>
            <hr class="text-warning">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            Are the rates on your website per person or per room?
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                        All rates on the website are per room per stay, unless stated differently.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Do I pay a reservation fee?
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                        No, we will not charge you a reservation fee.

                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Are taxes included in the room rates?
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                        Once you have retrieved the availability for a specific hotel for the requested dates, by clicking on the room name, you will find information about taxes and room facilities. 
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Do you offer special discounts (for seniors, airlines employees, etc)?
                        </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                        We provide the best available rates for the dates of your stay. The discounts are already included and therefore it is not possible to have any other discount on the confirmed price.
                        </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        We have two small children; can we get extra beds in the room?</button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                        n general one extra bed for one child is available at a minor additional charge.
                        </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <!-- End of FAQs section -->
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