<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$product_id = $_GET['id'];

$sql = "DELETE FROM products WHERE product_id='$product_id'";

if(mysqli_query($conn, $sql)){
    header("Location: products.php");
    exit();
}else{
    echo "Error deleting product: " . mysqli_error($conn);
}
?>