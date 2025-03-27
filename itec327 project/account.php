<?php
include 'session-check.php';
include 'connect.php';


$sid = $_SESSION["user_id"];

$sql =  "SELECT r.reservation_id,  r.start_date, r.start_end AS end_date, 
r.amount AS total_price, r.status
FROM reservations r
       
        WHERE r.student_id = '$sid' AND r.status = 'active'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $room_details = mysqli_fetch_assoc($result);

   
    $total_price = $room_details['total_price'];
    $installments = 3; 
    $payment_per_installment = $total_price / $installments;
} else {
    $room_details = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


<link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
    />
    <script src="https://kit.fontawesome.com/8bccbe0543.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/admin.css" />
    


    <title>Account</title>
  </head>
  <body>
   
     
      <div id="left">
        <section class="main-box">
          <header>
            <nav>
            <div class="img-name">
            <img src="./image/Untitled.png" alt="" />
            </div>

            <div class="menu-btns">
            <a class="item" href="">
            <i class="fa-solid fa-house"></i>
              <span onclick="window.location.href='home.php'; return false;">HOME</span>
            </a>
            <a class="item " href="">
            <i class="fa-solid fa-bolt"></i>
              <span onclick="window.location.href='booking.php'; return false;">BOOKING</span>
            </a>
            <a class="item" href="">
            <i class="fa-solid fa-user"></i>
              <span onclick="window.location.href='account.php'; return false;">ACCOUNT</span>
            </a>
            
            </a>
            </div>
            <div class="logout">
        <a class="item" href="">
          <i class="fas fa-power-off"></i>
          <span onclick="window.location.href='logout.php'; return false;">LOG OUT</span>
        </a>
      </div>
       
          </div>
              
              
            </nav>
            
          </header>
          
<div class="container">
    <h2>My Account</h2>

    <?php if ($room_details): ?>
        <div class="card">
            <div class="card-header bg-primary text-white">Reserved Room Details</div>
            <div class="card-body">
                <p><strong>Reservation ID:</strong> <?php echo $room_details['reservation_id']; ?></p>
                
                <p><strong>Start Date:</strong> <?php echo $room_details['start_date']; ?></p>
                <p><strong>End Date:</strong> <?php echo $room_details['end_date']; ?></p>
                <p><strong>Total Price:</strong> $<?php echo number_format($room_details['total_price'], 2); ?></p>
                <h5>Installment Plan</h5>
                <p><strong>Number of Installments:</strong> <?php echo $installments; ?></p>
                <p><strong>Payment Per Installment:</strong> $<?php echo number_format($payment_per_installment, 2); ?></p>
            </div>
        </div>
    <?php else: ?>
        <p class="text-danger">No active reservations found.</p>
    <?php endif; ?>
</div>
<footer>
    <div class="footer-content">
      <div class="footer-left">
        <div class="img-name">
          <img src="./image/logo2.png" alt="Footer Logo">
        </div>
        <div class="footer-links">
          <a class="item" href="#">
            <i class="fa-solid fa-house"></i>
            <span onclick="window.location.href='home.php'; return false;">HOME</span>

          </a>
          <a class="item" href="#">
          <i class="fa-solid fa-bolt"></i>
          <span onclick="window.location.href='booking.php'; return false;">BOOKING</span>
          </a>
          <a class="item" href="#">
            <i class="fa-solid fa-users"></i>
            <span onclick="window.location.href='account.php'; return false;">ACCOUNT</span>

          </a>
        </div>
      </div>
      <div class="footer-right">
        <div class="socials">
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fab fa-telegram-plane"></i></a>
        </div>
      </div>
    </div>
    <div class="footer-links">
      <a href="/en/info/policy/" class="footer-link-item">Privacy Policy</a>
      <a href="/en/info/terms/" class="footer-link-item">Terms of Use</a>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
