<?php
session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$buyer_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$seller_id = $_POST['seller_id'];
$amount = $_POST['amount'];

$sql = "INSERT INTO orders
(buyer_id, seller_id, product_id, amount, payment_status)
VALUES
('$buyer_id', '$seller_id', '$product_id', '$amount', 'Paid')";

if(mysqli_query($conn, $sql)){

    $update_sql = "UPDATE products 
                   SET status='Sold'
                   WHERE product_id='$product_id'";

    mysqli_query($conn, $update_sql);

    header("Location: payment_success.php");
    exit();

}else{
    echo "Payment error: " . mysqli_error($conn);
}
?>