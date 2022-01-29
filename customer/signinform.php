<?php
    session_start();
    $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
    $email = isset($_POST["inputEmail"])?$_POST["inputEmail"]:'';
    $password = isset($_POST["inputPassword"])?$_POST["inputPassword"]:'';
    
    $sql= "SELECT * FROM customer_details WHERE email ='$email' and password = '$password'";
    $result = pg_query($con,$sql);
    $row  = pg_fetch_array($result);
        if(is_array($row)) {
        // if(isset($_POST["remember"])){
        //     setcookie("mail",$mail,time()+60*60);			
        //     setcookie("pass",$pw,time()+60*60);	
        // }
        $_SESSION["id"] = $row['customerID'];
        $_SESSION["name"] = $row['username'];
        echo $_SESSION["name"];
        header("Location:index.php");
        } 
    
    else {
        echo '<script>alert("Invalid username or password");window.location ="index.php";
        </script>';
     }
   


?>