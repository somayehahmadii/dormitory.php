<?php
    include 'session-check.php';
    include 'connect.php';
 
   
    $sid = $_SESSION["user_id"]; 
   
    $sql = "SELECT reservations.reservation_id, reservations.start_date, 
    reservations.start_end AS end_date, reservations.amount AS total_price, reservations.status
FROM reservations 
WHERE reservations.student_id = '$sid' AND reservations.status = 'active'";
   $result = mysqli_query($conn, $sql);
   if (!$result) {
       die("Error fetching reservations: " . mysqli_error($conn));
   }

  
   $check_active_sql = "SELECT * FROM reservations WHERE student_id = '$sid' AND status = 'active'";
   $active_result = mysqli_query($conn, $check_active_sql);
   if (!$active_result) {
       die("Error checking active reservations: " . mysqli_error($conn));
   }
   $active_reservation = mysqli_num_rows($active_result) > 0;
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <script src="https://kit.fontawesome.com/8bccbe0543.js" crossorigin="anonymous"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/manager.css" />
  <style>
    .main-content {
      display: flex;
      flex-direction: column;
      padding: 50px;
      background-color: white;
      margin: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }
    .main-content h1 {
      margin-bottom: 20px;
    }
    .table-container {
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 15px;
      text-align: left;
    }
    th {
      background-color: #3a7d44;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #ddd;
    }
    button {
      padding: 10px 20px;
      background-color: #3a7d44;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #6dbf65;
    }
    .table-header {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 20px;
      padding: 10px 20px;
    }
    .add-room {
      padding: 10px 20px;
      background-color: #3a7d44;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      text-decoration: none;
    }
    .add-room:hover {
      background-color: #6dbf65;
    }
    .card {
      margin: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
      transition: transform 0.2s ease-in-out;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .card img {
      height: 200px;
      object-fit: cover;
    }
    .card-body {
      padding: 15px;
    }
    .btn-container {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }
    .btn-container .btn {
      width: 48%;
    }
    .main-content {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      padding: 20px;
    }
    .add-room {
      margin: 20px auto;
      display: block;
      width: fit-content;
    }
  </style>
  <title>Document</title>
</head>
<body>
  <header>
    <nav>
      <div class="img-name">
        <img src="./image/Untitled.png" alt="Logo">
      </div>
      <div class="menu-btns">
        <a class="item" href="#">
          <i class="fa-solid fa-house"></i>
          <span onclick="window.location.href='home.php'; return false;">HOME</span>

        </a>
        <a class="item" href="">
        <i class="fa-solid fa-bolt"></i>

          <span onclick="window.location.href='booking.php'; return false;">BOOKING</span>

        </a>
        <a class="item" href="">
          <i class="fa-solid fa-users"></i>
          <span onclick="window.location.href='account.php'; return false;">ACCOUNT</span>
            </a>
      </div>
      <div class="logout">
        <a class="item" href="#">
          <i class="fas fa-power-off"></i>
          <span onclick="window.location.href='logout.php'; return false;">LOG OUT</span>
        </a>
      </div>
    </nav>
  </header>
<div class="container">
  <h2>My Reservations</h2>

  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
  <?php elseif (isset($_GET['error'])): ?>
    <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
  <?php endif; ?>

  <table class="table table-bordered">
    <thead class="thead-dark">
      <tr>
        <th>Reservation ID</th>
       
        <th>Start Date</th>
        <th>End Date</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['reservation_id']; ?></td>
         
          <td><?php echo $row['start_date']; ?></td>
          <td><?php echo $row['end_date']; ?></td>
          <td>$<?php echo number_format($row['total_price'], 2); ?></td>
          <td><?php echo ucfirst($row['status']); ?></td>
          <td>
            <?php if ($row['status'] === 'active'): ?>
              <a href="cancel.php?id=<?php echo $row['reservation_id']; ?>" 
                 class="btn btn-danger" 
                 onclick="return confirm('Are you sure you want to cancel this reservation?');">Cancel</a>
            <?php else: ?>
              CANCELED
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

 

  <?php if ($active_reservation): ?>
    <p class="text-danger">You currently have an active reservation. Please cancel it to make a new one.</p>
  <?php else: ?>
    <a href="home-room.php" class="btn btn-primary">Make a New Reservation</a>
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
