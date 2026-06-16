<?php

session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$sender_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];
$product_id = $_POST['product_id'];
$message = $_POST['message'];

$sql = "INSERT INTO messages
(sender_id, receiver_id, product_id, message)
VALUES
('$sender_id', '$receiver_id', '$product_id', '$message')";

if(mysqli_query($conn, $sql)){
    header("Location: conversation.php?product_id=$product_id&user_id=$receiver_id");
    exit();
}else{
    echo "Error sending reply: " . mysqli_error($conn);
}

?>