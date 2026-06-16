<?php

session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$seller_id = $_POST['seller_id'];
$reviewer_id = $_SESSION['user_id'];
$rating = $_POST['rating'];

$sql = "INSERT INTO ratings (seller_id, reviewer_id, rating)
VALUES ('$seller_id', '$reviewer_id', '$rating')";

if(mysqli_query($conn, $sql)){
    header("Location: products.php");
    exit();
}else{
    echo "Error submitting rating: " . mysqli_error($conn);
}

?>