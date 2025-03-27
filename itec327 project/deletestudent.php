<?php
include "connect.php";

$id = $_GET["id"];

$sql = "DELETE from user where id = '$id'";

if(mysqli_query($conn, $sql)){
        header("Location: student2.php");
}
else{
    echo "Delete failed ". mysqli_error($conn);
}


?>