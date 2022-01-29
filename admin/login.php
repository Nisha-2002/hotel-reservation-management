<?php
    session_start();
    $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
    $username = isset($_POST["username"])?$_POST["username"]:'';
    $password = isset($_POST["password"])?$_POST["password"]:'';
    
    $sql= "SELECT * FROM admin_details WHERE username ='$username' and password = '$password'";
    $result = pg_query($con,$sql);
    $row  = pg_fetch_array($result);
        if(is_array($row)) {
        // if(isset($_POST["remember"])){
        //     setcookie("mail",$mail,time()+60*60);			
        //     setcookie("pass",$pw,time()+60*60);	
        // }
        $_SESSION["name"] = $row['username'];
        header("Location:index.php");
        } 
    
    else {
        echo '<script>alert("Invalid username or password");window.location ="index.php";
        </script>';
     }
   


?>