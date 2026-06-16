<?php

session_start();

include("../includes/db.php");

if($_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE user_id='$id'";

if(mysqli_query($conn, $sql)){

    header("Location: users.php");

} else {

    echo "Error deleting user.";

}

?>