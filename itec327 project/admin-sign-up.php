

<?php
include 'connect.php';


if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'admin'; 
    if ($password === $confirm_password) {
    $sql = "INSERT INTO user (name, username, password,  role) 
                VALUES ('$name', '$username', '$hash_password',  '$role')";
    if(mysqli_query($conn, $sql)){
        echo $name." added successfully !!";
        echo "<script>alert('Successfully added');</script>";
    }

    else{
        echo "Error with adding a new student". mysqli_error($conn);
    }
} else {
    echo "Passwords do not match.";
}

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

    .form-container {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
        max-width: 500px;
        width: 100%;
    }

    .btn-green {
        background-color: #0d421e;
        color: white;
    }

    .btn-green:hover {
        background-color: #092d14;
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
    <div class="form-container">
        <header class="text-center mb-4">
            <img src="./image/Untitled.png" alt="Logo" class="img-fluid rounded-circle" style="width: 100px;">
        </header>
        <form action="admin-sign-up.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name & Surname:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" class="form-control" required>
            </div>
            <p class="text-center">Already have an account? <a href="login.php" class="text-light">Login</a>.</p>
            <div class="d-grid mb-3">
                <button type="submit" name="signup" class="btn btn-green">Sign Up</button>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" name="submit" class="btn btn-secondary" onclick="window.location.href='login.php'; return false;">Login</button>
            </div>
            <div class="d-grid mb-3">
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
