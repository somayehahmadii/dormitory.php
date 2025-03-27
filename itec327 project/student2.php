<?php
include 'connect.php';
include 'session-check.php';

$sql = "SELECT * FROM user WHERE role = 'student'";


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
  <link rel="stylesheet" href="./css/admin.css">
 
  
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

.add-manager {
    padding: 10px 20px;
    background-color: #3a7d44;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-decoration: none;
}

.add-manager:hover {
    background-color: #6dbf65;
}


</style>
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
          <span onclick="window.location.href='dorm.php'; return false;">DORMS</span>
        </a>
        <a class="item" href="#">
          <i class="fa-solid fa-user"></i>
          <span onclick="window.location.href='manager2.php'; return false;">MANAGERS</span>
        </a>
        <a class="item" href="#">
          <i class="fa-solid fa-users"></i>
          <span>STUDENTS</span>
        </a>
      </div>
      <div class="logout">
        <a class="item" href="#">
          <i class="fas fa-power-off"></i>
          <span>LOG OUT</span>
        </a>
      </div>
    </nav>
  </header>
  

  <main>

  <main class="container">
    <div class="main-content">
      
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>username</th>
            

            <th colspan="2">Action</th>
        </tr>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
          <td><?php echo $row["name"]; ?></td>
          <td><?php echo $row["username"]; ?></td>
         
          <td><a href="sign-up2.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a></td>
          <td><a href="deletestudent.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
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
            <span onclick="window.location.href='dorm.php'; return false;">DORMS</span>
          </a>
          <a class="item" href="#">
            <i class="fa-solid fa-user"></i>
            <span>MANAGERS</span>
          </a>
          <a class="item" href="#">
            <i class="fa-solid fa-users"></i>
            <span>STUDENTS</span>
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
