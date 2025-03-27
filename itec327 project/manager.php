<?php
    include 'session-check.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
    />
    <script src="https://kit.fontawesome.com/8bccbe0543.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/manager.css" />


    <title>Document</title>
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
              <span onclick="window.location.href='room.php'; return false;">ROOMS</span>
            </a>
            <a class="item " href="">
            <i class="fa-solid fa-money-bill"></i>
              <span onclick="window.location.href='finance.php'; return false;">FINANCE</span>
            </a>
            <a class="item" href="">
            <i class="fa-solid fa-users"></i>
            <span onclick="window.location.href='addroom.php'; return false;">ADD ROOM</span>
            </a>
            
            </a>
            </div>
            <div class="logout">
        <a class="item" href="#">
          <i class="fas fa-power-off"></i>
          <span onclick="window.location.href='logout.php'; return false;">LOG OUT</span>

        </a>
      </div>
       
          </div>
              
              
            </nav>
            
          </header>
          
                  
              
            </div>
          </div>
        </section>
        <section class="main-boxx">
        <img src="./image/empty.png" alt=""> 
     </section>

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
            <span onclick="window.location.href='finance.php'; return false;">FINANCIALS</span>
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