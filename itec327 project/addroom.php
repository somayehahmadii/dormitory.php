<?php
include 'connect.php';
include 'session-check.php';

$message = '';
$dorm_id = null;
$user_id = $_SESSION['user_id']; 

$sql = "SELECT dorms.dorm_id 
        FROM dorms 
        JOIN user ON dorms.dorm_id = user.dorm_id 
        WHERE user.id = '$user_id' AND user.role = 'manager'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $dorm_id = $row['dorm_id'];
} else {
    die("Error: Manager's dorm ID not found.");
}



if (isset($_POST['submit'])) {
    $room_number = $_POST['room-number'];
    $room_type = $_POST['room-type'];
    $capacity = $_POST['capacity'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $image_path = 'images';
   
    
    if ($_FILES["images"]["error"] == 0) {
        $image_path = "uploads/" . basename($_FILES["images"]["name"]);
        move_uploaded_file($_FILES["images"]["tmp_name"], $image_path);
    }
  
    $sql = "INSERT INTO room (room_number, room_type, capacity, price, status, description, images, dorm_id) 
            VALUES ('$room_number', '$room_type', '$capacity', '$price', '$status', '$description', '$image_path', '$dorm_id')";
           
           if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $update_sql = "UPDATE room SET room_id = $last_id WHERE id = $last_id";
            mysqli_query($conn, $update_sql);
       
        $message = "<div class='alert alert-success text-center' role='alert'>$room_number added successfully!!</div>";
    } else {
        $message = "<div class='alert alert-danger text-center' role='alert'>Error with adding a new room: " . mysqli_error($conn) . "</div>";
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
            height: 150vh;
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
    <title>Add room</title>
</head>
<body>

<div class="container">
    <?php echo $message; ?>
    <div class="header text-center mb-4">
        <p>ADD ROOM FORM</p>
    </div>
    <form action="addroom.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="room-number">Room Number:</label>
            <input type="text" class="form-control" id="room-number" name="room-number" required>
        </div>
        <div class="form-group">
            <label for="room-type">Room Type:</label>
            <select id="room-type" class="form-control" name="room-type" required>
                <option value="">Select Room Type</option>
                <option value="single">Single</option>
                <option value="double">Double</option>
                <option value="suite">Suite</option>
            </select>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="number" class="form-control" id="capacity" name="capacity" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="status">Availability Status:</label>
            <select id="status" class="form-control" name="status" required>
                <option value="">Select Status</option>
                <option value="available">Available</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Under Maintenance</option>
            </select>
        </div>
       
        <div class="form-group">
            <label for="description">Room Description:</label>
            <textarea id="description" class="form-control" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="images">Upload Images:</label>
            <input type="file" class="form-control" id="images" name="images" accept=".jpg, .jpeg, .png" multiple required>
        </div>
        <div class="submit-btn-container text-center">
            <button type="submit" class="btn btn-green" name="submit">Submit</button>
        </div>
    </form>
</div>

</body>
</html>