<?php

session_start();

include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM products 
        WHERE product_id='$product_id' 
        AND seller_id='$user_id'";

if(mysqli_query($conn, $sql)){
    header("Location: mylistings.php");
    exit();
}else{
    echo "Error deleting listing: " . mysqli_error($conn);
}

?>