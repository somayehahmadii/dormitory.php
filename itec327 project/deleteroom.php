<?php
include "connect.php";

$id = $_GET["id"];

$sql = "DELETE from room where id = '$id'";

if(mysqli_query($conn, $sql)){
        header("Location: room.php");
}
else{
    echo "Delete failed ". mysqli_error($conn);
}


?>