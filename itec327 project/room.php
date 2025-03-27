<?php
include 'connect.php';

include 'session-check.php';

$sql = "SELECT * FROM room ";
$result = mysqli_query($conn, $sql);
//$sql = "UPDATE dorms SET manager_d = 'yes' WHERE dorm_id = '$dorm_id'";

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
          <span onclick="window.location.href='room.php'; return false;">ROOMS</span>
        </a>
        <a class="item" href="">
          <i class="fa-solid fa-money-bill"></i>
          <span onclick="window.location.href='finance.php'; return false;">FINANCE</span>
        </a>
        <a class="item" href="">
          <i class="fa-solid fa-users"></i>
          <span onclick="window.location.href='addroom.php'; return false;">ADD ROOM</span>
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
  <main class="container">
    <div class="d-flex justify-content-end mb-3">
      <a href="addroom.php" class="btn btn-success add-room">+ Add room</a>
    </div>
    <div class="row main-content">
      <div class="card-columns">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <div class="card" style="width: 18rem;">
            <img src="<?php echo $row['images']; ?>" class="card-img-top" alt="Room Image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['room_type']; ?></h5>
              <p class="card-text">
                <strong>Room Number:</strong> <?php echo $row['room_number']; ?><br>
                <strong>Room Type:</strong> <?php echo $row['room_type']; ?><br>
                <strong>Capacity:</strong> <?php echo $row['capacity']; ?><br>
                <strong>Price:</strong> <?php echo $row['price']; ?><br>
                <strong>Status:</strong> <?php echo $row['status']; ?><br>
                <strong>Description:</strong> <?php echo $row['description']; ?>
              </p>
              <div class="btn-container">
                <a href="addroom2.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a>
                <a href="deleteroom.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this room?');">Delete</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>
  <footer>
    <div class="footer-content">
      <div class="footer-left">
        <div class="img-name">
          <img src="./image/logo2.png" alt="Footer Logo">
        </div>
        <div class="footer-links">
          <a class="item" href="#">
            <i class="fa-solid fa-house"></i>
            <span onclick="window.location.href='dorm.php'; return false;">ROOMS</span>
          </a>
          <a class="item" href="#">
            <i class="fa-solid fa-user"></i>
            <span>FINANCIALS</span>
          </a>
          <a class="item" href="#">
            <i class="fa-solid fa-users"></i>
            <span onclick="window.location.href='addroom.php'; return false;">ADD ROOM</span>
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
    </div>
  </footer>
</body>
</html>
