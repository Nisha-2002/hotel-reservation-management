<?php
    session_start();
    $db = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
    $username= isset($_POST["inputUsername"])?$_POST["inputUsername"]:'';
    $email = isset($_POST["inputEmail1"])?$_POST["inputEmail1"]:'';
    $password = isset($_POST["inputPassword1"])?$_POST["inputPassword1"]:'';
    $sql_u = "SELECT * FROM customer_details WHERE username='$username'";
  	$sql_e = "SELECT * FROM customer_details WHERE email ='$email'";
  	$res_u = pg_query($db, $sql_u);
  	$res_e = pg_query($db, $sql_e);
    
     
  	if (pg_num_rows($res_u) > 0) {
  	  echo '<script>alert("This username is already taken! If you already have an account, please login else sign-up with a different username.");window.location = "index.php";
      </script>';
     }
    else if(pg_num_rows($res_e) > 0){
  	  echo '<script>alert("This email is already linked with another account. Please login instead!");window.location = "index.php";
      </script>';
  	}
    else{
          $query = "INSERT INTO customer_details (username, email, password) 
      	    	  VALUES ('$username', '$email', '$password')";
           pg_query($db, $query);
           pg_query("COMMIT");
           $qcustid= "SELECT * FROM customer_details WHERE username = '$username'";
           $resultid = pg_query($db, $qcustid);
           $resultidacc  = pg_fetch_array($resultid);
           $custid = $resultidacc["customerID"];
           $_SESSION["id"] = $custid;
           $_SESSION["name"] = $resultidacc['username'];
           echo $_SESSION["name"];
           if(isset($_SESSION["id"]))
            header("Location:index.php");
           
           }
?>