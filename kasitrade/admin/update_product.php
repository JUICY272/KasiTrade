<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$product_id = $_POST['product_id'];
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];

$sql = "UPDATE products SET
        title='$title',
        description='$description',
        price='$price',
        category='$category'
        WHERE product_id='$product_id'";

if(mysqli_query($conn, $sql)){
    header("Location: products.php");
    exit();
}else{
    echo "Error updating product: " . mysqli_error($conn);
}
?>