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
    <!-- Carousel/Banner -->
    <section class="bg-light">
       <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="images\pexels-pixabay-237272.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="images\pexels-pixabay-258154.jpg" class="d-block w-100" alt="...">
                  </div>
                  
                  <div class="carousel-item">
                    <img src="images\pexels-thorsten-technoman-338504.jpg" class="d-block w-100" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
        </div>
    </section>
 <!-- End of carousel -->
 <!-- Hotel intro section -->
 <section class="p-5 bg-light">
     <div class="container">
         <div class="row">
             <div class="col-md-8">
                <h2 class=" text-warning">The Coastal Bay Hotel</h2>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, veritatis sequi. Nostrum, consequatur! Vitae assumenda voluptate non beatae, nisi reprehenderit ipsa esse nihil ea dignissimos facere dolorem neque iusto aliquam perspiciatis explicabo quibusdam eaque dolor quod nostrum, tempora earum autem?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi necessitatibus officia unde earum quos consequatur voluptate ad repellendus, numquam error modi sunt perferendis tenetur illo.</p>      
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et itaque libero recusandae soluta blanditiis doloremque magnam porro dolorum, aspernatur praesentium, deleniti accusamus ut alias. Iste maiores quis incidunt repellat porro!</p> 
             </div>
             <div class="col-md d-none d-md-block">
                 <img src="images\pexels.jpg" class="img-thumbnail" alt="">
             </div>
        

         </div>
     </div>
 </section>
<hr>
 <!-- End of hotel intro section -->
 <!-- Services & Facilities -->
 <section class="p-5 bg-light">
     <div class="container">
         <h2 class="text-info text-center py-3">Services & Facilities</h2>
         <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="images\pexels-vlada-karpovich-7902912.jpg" class="img-fluid" alt="">
                        <h5 class="card-title p-3 text-dark">Infinity Pool</h5>
                        </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="images\pexels-oleg-magni-989711.jpg" class="img-fluid" alt="">
                        <h5 class="card-title p-3 text-dark">24/7 Bar</h5>
                        </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="images\pexels-valeria-boltneva-1833349.jpg" class="img-fluid" alt="">
                        <h5 class="card-title p-3 text-dark">Fine Dining</h5>
                        </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="images\pexels-burst-374148.jpg" class="img-fluid" alt="">
                        <h5 class="card-title p-3 text-dark">Luxury Spa</h5>
                        </div>
                </div>
            </div>
         </div>
     </div>
 </section>
 <hr>
 <!-- End of services and facilities -->
 <!-- Modal - Login/SignUp Form -->
 <div class="modal fade" id="loginform" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center text-dark" id="exampleModalToggleLabel">Log In</h5>
          
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="signinform.php" method="POST" id="signin" class="form">
                <div class="mb-3">
                  <label for="inputEmail" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                  <label for="inputPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPassword" name="inputPassword" required>
                </div>
                <div class="text-center d-grid mx-auto">
                    <button type="submit" class="btn btn-block btn-primary btn-warning text-dark">Sign In</button>
                </div>
                </form>
        </div>
        <div class="modal-footer text-center">
          <p>Don't have an account?</p>
          <button class="btn btn-link" data-bs-target="#signupform" data-bs-toggle="modal">Sign-Up</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="signupform" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signupform">Sign Up</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="signupform.php" method="POST" id="signup" class="form">
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="inputUsername" name="inputUsername" aria-label="Username" aria-describedby="basic-addon1" required>
                  </div>
                <div class="mb-3">
                  <label for="inputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="inputEmail1" name="inputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                  <label for="inputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="inputPassword1" name="inputPassword1" required>
                </div>
                
                <div class="text-center d-grid mx-auto">
                    <button type="submit" class="btn btn-block btn-primary btn-warning text-dark">Sign Up</button>
                </div>
                </form>
        </div>
        <div class="modal-footer">
            <p>Already have an account?</p>
          <button class="btn btn-link" data-bs-target="#loginform" data-bs-toggle="modal">Sign-In</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal -->
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