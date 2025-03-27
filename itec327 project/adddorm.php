<?php
include 'connect.php';
include 'session-check.php';

$message = '';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $number = $_POST['number'];
    $address = $_POST['address'];
    $image_path = 'picture';
    if ($_FILES["picture"]["error"] == 0) {
        $image_path = "uploads/" . basename($_FILES["picture"]["name"]);
        move_uploaded_file($_FILES["picture"]["tmp_name"], $image_path);
    }



   
   

    $sql = "INSERT INTO dorms (name, picture, location, number, address) 
                    VALUES ('$name', '$image_path', '$location', '$number', '$address')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $update_sql = "UPDATE dorms SET dorm_id = $last_id WHERE id = $last_id";
        mysqli_query($conn, $update_sql);
        $message = "<div class='alert alert-success text-center' role='alert'>$name added successfully!!</div>";
    } else {
        $message = "<div class='alert alert-danger text-center' role='alert'>Error with adding a new manager: " . mysqli_error($conn) . "</div>";
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
</head>
<body>
    

<div class="container">
        <?php echo $message; ?>
        <div class="header text-center mb-4">
                <p>ADD DORM FORM</p>
            </header>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="picture">Picture:</label>
                    <input type="file" class="form-control" id="picture" name="picture" accept=".jpg, .jpeg, .png" required>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="number">Number:</label>
                    <input type="text" class="form-control" id="number" name="number" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="submit-btn-container">
                <button type="submit" class="btn btn-green" name="submit">Submit</button>





</div>
            </form>
             
            
        </div>
    </div>
</main>
</body>
</html>
