<?php

session_start();
include("includes/db.php");

$product_id = $_POST['product_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];
$user_id = $_SESSION['user_id'];

$sql = "UPDATE products SET
        title='$title',
        description='$description',
        price='$price',
        category='$category'
        WHERE product_id='$product_id'
        AND seller_id='$user_id'";

if(mysqli_query($conn, $sql)){
    header("Location: mylistings.php");
    exit();
}else{
    echo "Error updating listing: " . mysqli_error($conn);
}

?>