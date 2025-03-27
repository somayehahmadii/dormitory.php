<?php
include 'connect.php';


$message = '';
if (isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $dorm=$_POST['dorm'];
  
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'manager';
    if($dorm != "none"){
        $sql = "SELECT dorm_id FROM dorms WHERE name = '$dorm'";
        
        $result = mysqli_query($conn,$sql);
        
        if (mysqli_num_rows($result)==1){
            $row = mysqli_fetch_assoc($result);
            $dorm_id = $row["dorm_id"];
        }

    $sql = "INSERT INTO user (name, password, username, phonenumber, address, dorm_id, dorm_name,  role) 
            VALUES ('$fullname', '$hash_password', '$username', '$phonenumber', '$address', '$dorm_id', '$dorm', '$role')";
    if (mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success text-center' role='alert'>$username added successfully!!</div>";
        $sql = "UPDATE dorms SET manager_d = 'yes' WHERE dorm_id = '$dorm_id'";
        $result= (mysqli_query($conn, $sql));
                  
    } else {
        $message = "<div class='alert alert-danger text-center' role='alert'>Error with adding a new manager: ". mysqli_error($conn) . "</div>";
    }
 
}
else{
    echo "<script>alert('You should select a dorm!!');</script>";
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
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
            max-width: 400px;
            width: 100%;
            color: white;
        }

        .form-group label {
            color: white;
        }

        .btn-green {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-green:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .header p {
            font-size: 1.5em;
            font-weight: bold;
            margin: 0;
        }

        .alert {
            margin-bottom: 20px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .header p {
                font-size: 1.2em;
            }
        }
    </style>
    <title>Add Manager</title>
</head>
<body>
    <div class="container">
        <?php echo $message; ?>
        <div class="header text-center mb-4">
            <p>ADD MANAGER FORM</p>
        </div>
        <form action="addmanager.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullname">FULL NAME:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="username">USER NAME:</label>
                <input type="text" class="form-control" id="username" name="username"  required>
            </div>
            <div class="form-group">
                <label for="password">PASSWORD:</label>
                <input type="password" class="form-control" id="password" name="password"   required>
            </div>
            <div class="form-group">
                <label for="phonenumber">PHONE NUMBER:</label>
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" required>
            </div>
            <div class="form-group">
                <label for="address">ADDRESS:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="dorm">CHOOSE DORM:</label>
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
                <button type="submit" name="submit" class="btn btn-green">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
