<?php
    session_start();
    $con = pg_connect("host=localhost port=5432 dbname=hotel user=postgres password=Nisha@1965");
    $checkindate = isset($_POST["checkInDate"])?$_POST["checkInDate"]:'';
    $checkoutdate = isset($_POST["checkOutDate"])?$_POST["checkOutDate"]:'';
    $roomType =  isset($_POST["roomType"])?$_POST["roomType"]:'';
    $payableAmount = isset($_POST["payableAmount"])?$_POST["payableAmount"]:'';
    $firstName = isset($_POST["firstName"])?$_POST["firstName"]:'';
    $lastName = isset($_POST["lastName"])?$_POST["lastName"]:'';
    $contactNo = isset($_POST["contactNo"])?$_POST["contactNo"]:'';
    $altContactNo = isset($_POST["altContactNo"])?$_POST["altContactNo"]:'';
    $mailId = isset($_POST["mailId"])?$_POST["mailId"]:'';
    $address = isset($_POST["address"])?$_POST["address"]:'';
    $cardNo = isset($_POST["cardNo"])?$_POST["cardNo"]:'';
    $expDate = isset($_POST["expDate"])?$_POST["expDate"]:'';
    $cvv = isset($_POST["cvv"])?$_POST["cvv"]:'';
    $cardName = isset($_POST["cardName"])?$_POST["cardName"]:'';
    echo($payableAmount);
    $q1 ="INSERT INTO booking_details(bookingid, checkindate, checkoutdate, roomtype, payableamount, status)
        VALUES ( default, '$checkindate', '$checkoutdate', '$roomType', $payableAmount, 'Booked')";
    pg_query($con, $q1);
    $q11 = "SELECT currval(pg_get_serial_sequence('booking_details','bookingid')) as bookingid;";
    $id_res = pg_query($con, $q11);
    $row = pg_fetch_assoc($id_res);
    $id = $row["bookingid"];
    $customerid = $_SESSION["id"];
    if($altContactNo!='')
        $q2 ="INSERT INTO guest_details(
            bookingid, customerid, firstname, lastname, contactno, altcontactno, emailid, address)
            VALUES ($id, $customerid, '$firstName', '$lastName', $contactNo, $altContactNo, '$mailId', '$address')";
    else
    $q2 ="INSERT INTO guest_details(
        bookingid, customerid, firstname, lastname, contactno, emailid, address)
        VALUES ($id, $customerid, '$firstName', '$lastName', $contactNo, '$mailId', '$address')";
    
        pg_query($con, $q2);
    $q3 ="INSERT INTO public.payment_details(
        bookingid, paymentid, cardno, expdate, cvv, cardname)
        VALUES ($id, default, $cardNo, '$expDate-01', $cvv, '$cardName');";
    pg_query($con, $q3);
    header("location:youraccount.php");
?>