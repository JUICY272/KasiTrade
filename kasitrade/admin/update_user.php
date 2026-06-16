<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$user_id = $_POST['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];

$sql = "UPDATE users SET
        name='$name',
        email='$email',
        role='$role'
        WHERE user_id='$user_id'";

if(mysqli_query($conn, $sql)){
    header("Location: users.php");
    exit();
}else{
    echo "Error updating user: " . mysqli_error($conn);
}
?>