
<?php
 session_start();

include "connect.php";

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user where username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row["password"];
        if (password_verify($password, $hashed_password)){
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["loggedin"] = true;
            if ($row["role"] == 'student'){
               
                header("Location: student.php");   
            }
            else if($row["role"] == 'manager'){
                header("Location: manager.php");   
            }else{
                header("Location: admin.php");  
            }
            
        }
        else{
            $error = "Password Incorrect";
            header("Location: login.php?error=$error");
            exit();
        }
    }
    else{
        $error = "Invalid Username";
        header("Location: login.php?error=$error");
        exit();
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <style>
        body {
            background: radial-gradient(circle, rgba(13, 66, 30, 0.9), rgba(0, 40, 15, 0.9));
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .social-auth a {
            color: white;
            font-size: 1.5rem;
            margin: 0 10px;
            text-decoration: none;
        }

        .social-auth a:hover {
            color: #cccccc;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <header class="text-center mb-4">
            <img src="./image/Untitled.png" alt="Logo" class="img-fluid rounded-circle" style="width: 100px; height: auto;">
        </header>
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <p class="text-center">Don't have an account? <a href="sign up.php" class="text-light">Sign up</a>.</p>
            <div class="d-grid mb-3">
                <button type="submit" name="submit" class="btn btn-green">Login</button>
            </div>
            <div class="d-grid mb-3">
                <button type="button" onclick="window.location.href='sign up.php';" class="btn btn-secondary">Sign Up</button>
            </div>
            <div class="d-grid">
                <button type="reset" class="btn btn-outline-light">Clear</button>
            </div>
        </form>
        <div class="social-auth text-center mt-4">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-google-plus-g"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

