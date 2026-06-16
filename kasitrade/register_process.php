<?php

include("includes/db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = "user";

$sql = "INSERT INTO users (name, email, password, role)
VALUES ('$name', '$email', '$password', '$role')";

if(mysqli_query($conn, $sql)){
    header("Location: login.php");
    exit();

} else {
    echo "Error: " . mysqli_error($conn);
}

?>