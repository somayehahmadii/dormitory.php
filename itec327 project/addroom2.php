<?php
include 'connect.php';
include 'session-check.php';

$message = '';
$dorm_id = null;
$dorm_name = null;
$sql = "SELECT dorms.dorm_id, dorms.name FROM dorms 
        JOIN user ON dorms.dorm_id = user.dorm_id 
        WHERE role = 'manager'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $dorm_id = $row['dorm_id'];
    $dorm_name = $row['name'];
}
$id = $_GET["id"]; // Retrieved from the URL
$sql = "SELECT * FROM room WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $room = mysqli_fetch_assoc($result);
    $room_number = $room['room_number'];
    $room_type = $room['room_type'];
    $capacity = $room['capacity'];
    $price = $room['price'];
    $status = $room['status'];
    $description = $room['description'];
    $image_path = $room['images'];
} else {
    $message = "<div class='alert alert-danger text-center' role='alert'>Room not found!</div>";
}
if (isset($_POST['submit'])) {
    $up_room_number = $_POST['room-number'];
    $up_room_type = $_POST['room-type'];
    $up_capacity = $_POST['capacity'];
    $up_price = $_POST['price'];
    $up_status = $_POST['status'];
    $up_description = $_POST['description'];
    $up_image_path = $image_path; 

    
    if (isset($_FILES["images"]) && $_FILES["images"]["error"] == 0) {
        $upload_dir = "uploads/";
        $up_image_path = $upload_dir . basename($_FILES["images"]["name"]);
        if (!move_uploaded_file($_FILES["images"]["tmp_name"], $up_image_path)) {
            $message = "<div class='alert alert-danger text-center' role='alert'>Image upload failed. Using previous image.</div>";
        }
    }
   
   
    $sql = "UPDATE room SET room_number = '$up_room_number',  room_type = '$up_room_type', capacity = '$up_capacity', price = '$up_price', status = '$up_status', description = '$up_description', images = '$up_image_path' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success text-center' role='alert'>Room $up_room_number updated successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger text-center' role='alert'>Error updating room: " . mysqli_error($conn) . "</div>";
    }
}
?>

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
    <title>Edit Room</title>
</head>
<body>

<div class="container">
    <?php echo $message; ?>
    <div class="header text-center mb-4">
        <p>ADD ROOM FORM</p>
    </div>
    <form action="addroom2.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="room-number">Room Number:</label>
            <input type="text" class="form-control" id="room-number" name="room-number" value="<?php echo $room_number; ?>" required>
        </div>
        <div class="form-group">
            <label for="room-type">Room Type:</label>
            <select id="room-type" class="form-control" name="room-type" required>
                <option value="">Select Room Type</option>
                <option value="single" <?php echo $room_type == 'single' ? 'selected' : ''; ?>>Single</option>
                <option value="double" <?php echo $room_type == 'double' ? 'selected' : ''; ?>>Double</option>
                <option value="suite" <?php echo $room_type == 'suite' ? 'selected' : ''; ?>>Suite</option>
            </select>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="number" class="form-control" id="capacity" name="capacity" value="<?php echo $capacity; ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Availability Status:</label>
            <select id="status" class="form-control" name="status" required>
                <option value="">Select Status</option>
                <option value="available" <?php echo $status == 'available' ? 'selected' : ''; ?>>Available</option>
                <option value="occupied" <?php echo $status == 'occupied' ? 'selected' : ''; ?>>Occupied</option>
                <option value="maintenance" <?php echo $status == 'maintenance' ? 'selected' : ''; ?>>Under Maintenance</option>
            </select>
        </div>
       
        <div class="form-group">
            <label for="description">Room Description:</label>
            <textarea id="description" class="form-control" name="description" rows="4" required><?php echo $description; ?></textarea>
        </div>
        <div class="form-group">
            <label for="images">Upload New Image:</label>
            <input type="file" class="form-control" id="images" name="images" accept=".jpg, .jpeg, .png">
            <small class="form-text text-white">Current Image: <?php echo $image_path; ?></small>
        </div>
        <div class="submit-btn-container text-center">
            <button type="submit" class="btn btn-green" name="submit">Update</button>
        </div>
    </form>
</div>

</body>
</html>
