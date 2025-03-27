<?php
include 'session-check.php';
include 'connect.php';



$sid = $_SESSION["user_id"];

$check_reservation_sql = "SELECT * FROM reservations WHERE student_id = '$sid' AND status = 'active'";
$start_date = date('Y-m-d'); 
$end_date = date('Y-m-d', strtotime('+1 month')); 
$amount = 500; 





$reserve_sql = "INSERT INTO reservations (student_id, status, start_date, start_end, amount) 
                VALUES ('$sid',  'active', '$start_date', '$end_date', '$amount')";

if(mysqli_query($conn,$reserve_sql)){
   
   
    header("Location:booking.php");
}
else{
    echo"nope !";
}

?>

