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
    <title>Home Page</title>
</head>
<hr>
    <body class="bg-warning">
        <section class="p-5 mw-100 mh-100">
            <h1 class="p-3 pt-5 text-center">Work at <span class="text-info">The Coastal Bay Hotel</span>    ?</h1>
            <h4 class="p-3 pb-5 text-center">Manage Bookings and Reservations!</h4>
            <form class="p-3 justify-content-center text-center" action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold mx-3">Username</label>
                    <input type="text" class="form-control-sm" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold mx-3">Password</label>
                    <input type="password" class="form-control-sm" id="password" name="password" required>
                </div>
                
                <button type="submit" class="m-3 btn btn-primary btn-dark text-light">Log In</button>
            </form>
        </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>