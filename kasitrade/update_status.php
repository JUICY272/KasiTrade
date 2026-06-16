<?php

session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$product_id = $_GET['id'];
$status = $_GET['status'];
$user_id = $_SESSION['user_id'];

$sql = "UPDATE products 
        SET status='$status'
        WHERE product_id='$product_id'
        AND seller_id='$user_id'";

if(mysqli_query($conn, $sql)){
    header("Location: mylistings.php");
    exit();
}else{
    echo "Error updating status: " . mysqli_error($conn);
}

?>