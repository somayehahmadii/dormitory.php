<?php
include 'connect.php';
include 'session-check.php';

$sql = "SELECT * FROM dorms ";

$result = mysqli_query($conn, $sql);
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

  <link rel="stylesheet" href="./css/dorm.css">
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

.add-dorm {
    padding: 10px 20px;
    background-color: #3a7d44;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-decoration: none;
}

.add-dorm:hover {
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

        .add-dorm {
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
        <a class="item" href="#">
          <i class="fa-solid fa-user"></i>
          <span onclick="window.location.href='booking.php'; return false;">BOOKING</span>
        </a>
        <a class="item" href="#">
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

  <main class="container">
    
    <div class="row main-content">
       <div class="card-columns">
        

        <?php while ($row = mysqli_fetch_assoc($result)){ ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $row['picture']; ?>" class="card-img-top" alt="Dorm Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text">
                        <strong>Location:</strong> <?php echo $row['location']; ?><br>
                        <strong>Number:</strong> <?php echo $row['number']; ?><br>
                        <strong>Address:</strong> <?php echo $row['address']; ?>
                    </p>
                    <div class="btn-container">
                    <a href="home-room.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Rooms</a>
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
            <span onclick="window.location.href='home.php'; return false;">HOME</span>

          </a>
          <a class="item" href="#">
            <i class="fa-solid fa-user"></i>
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
</footer>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
</body>
</html>