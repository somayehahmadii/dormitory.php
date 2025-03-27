<?php
include "connect.php";

$id = $_GET["id"];

$sql = "DELETE from dorms where id = '$id'";

if(mysqli_query($conn, $sql)){
        header("Location: dorm.php");
}
else{
    echo "Delete failed ". mysqli_error($conn);
}


?>