<?php
include 'connect.php';
include 'session-check.php';

$id = $_GET["id"]; // Retrieved from the URL
$sql = "SELECT * FROM user WHERE id = '$id'";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $fullname = $row['name'];
    $username = $row['username']; 
    $password = $row['password']; 
    $phonenumber = $row['phonenumber'];
    $address = $row['address'];
   
}

$message = '';

if (isset($_POST["submit"])) {
    $up_username = $_POST['username'];
    $up_password = $_POST['password'];
    $up_fullname = $_POST['fullname'];
    $up_phonenumber = $_POST['phonenumber'];
    $up_address = $_POST['address'];
    $up_dorm = $_POST['dorm'];
    $up_id = $_POST["id"]; 
    $hash_password = password_hash($up_password, PASSWORD_DEFAULT);
    
    $sql = "UPDATE user SET name='$up_fullname', username='$up_username', password='$hash_password', phonenumber='$up_phonenumber', address='$up_address', dorm='$up_dorm' WHERE id='$up_id'";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: manager2.php');
        
        $message = "<div class='alert alert-success text-center' role='alert'>$username updated successfully!!</div>";
        
        $sql = "UPDATE dorms SET manager_d = 'yes' WHERE dorm_id = '$dorm_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Dorm is taken.";
        } else {
            echo "<script>alert('Error updating dorm table!');</script>";
        }            
    } else {
        $message = "<div class='alert alert-danger text-center' role='alert'>Error updating manager: ". mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: radial-gradient(circle, rgba(89, 122, 94, 1) 0%, rgba(13, 66, 30, 1) 100%);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Lato', sans-serif;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-green {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-green:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>
<main>
    <div class="container">
        <?php if ($message) echo $message; ?>
        <div class="header">
            <h2>Update Manager</h2>
        </div>
        <form action="" method="POST">
            <input type="hidden" value="<?php echo $id; ?>" name="id">
            <div class="form-group">
        <label for="fullname">Full Name:</label>
        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $fullname; ?>" required>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
    </div>
    <div class="form-group">
        <label for="phonenumber">Phone Number:</label>
        <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $phonenumber; ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
    </div>
            <div class="form-group">
                <label for="dorm">Choose Dorm:</label>
                <select id="dorm" name="dorm" class="form-control" required>
                <?php   
                echo"<option select name='dorms'>select dorm</option>'";
                $sql = "SELECT * from dorms where manager_d != 'yes';";
                        $result = mysqli_query($conn,$sql);
                 while ($row = mysqli_fetch_assoc($result)) {

                 echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                  }
                  echo"</select>";
                   ?>
                  
                </select>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-green btn-block" name="submit">Update</button>
            </div>
        </form>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
