<?php
include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $up_username = $_POST['username'];
    $up_password = $_POST['password'];
    $up_fullname = $_POST['fullname'];
    $up_phonenumber = $_POST['phonenumber'];
    $up_address = $_POST['address'];
    $up_dorm = $_POST['dorm'];

    $sql = "UPDATE user set name='$up_fullname', username = '$up_username', password = '$up_password', phonenumber='$up_phonenumber', address='$up_address', dorm='$up_dorm'  WHERE id = '$up_id'";

    if(mysqli_query($conn, $sql)){
        header('Location: manager2.php');
    }
    else{
        echo "Error while updating the students information";
    }
}




?>
<?php
include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
   $up_name = $_POST['name'];
        $up_username = $_POST['username'];
        $up_password = $_POST['password'];
        $up_confirm_password = $_POST['confirm_password'];

        $sql = "UPDATE user set name='$up_name', username = '$up_username', password = '$up_password', confirm_password='$up_confirm_password'  WHERE id = '$up_id'";
        if(mysqli_query($conn, $sql)){
            header('Location: student2.php');
    }
    else{
        echo "Error while updating the students information";
    }
}




?>