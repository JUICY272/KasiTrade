<?php

session_start();

include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];

$product_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM products"))['total'];

$order_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders"))['total'];

$message_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM messages"))['total'];

$total_revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(amount) AS total FROM orders"))['total'];

?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../css/style.css">

</head>
<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">

        <img 
        src="../images/kasitrade-logo-use_upscaled.png"
        style="height:80px;">

    </div>

    <div class="nav-links">

        <a href="index.php">Dashboard</a>

        <a href="users.php">Users</a>

        <a href="products.php">Products</a>

        <a href="orders.php">Orders</a>

        <a href="../dashboard.php">Main Site</a>

        <a href="../logout.php">Logout</a>

    </div>

</div>

<!-- CONTENT -->

<div class="product-view-container">

<h1>Admin Dashboard</h1>

<h2>Live Platform Statistics</h2>

<div class="product-grid">

    <div class="product-card">
        <h2>Total Users</h2>
        <h1><?php echo $user_count; ?></h1>
    </div>

    <div class="product-card">
        <h2>Total Products</h2>
        <h1><?php echo $product_count; ?></h1>
    </div>

    <div class="product-card">
        <h2>Total Orders</h2>
        <h1><?php echo $order_count; ?></h1>
    </div>

    <div class="product-card">
        <h2>Total Messages</h2>
        <h1><?php echo $message_count; ?></h1>
    </div>

    <div class="product-card">
        <h2>Total Payments</h2>
        <h1>R<?php echo $total_revenue ? $total_revenue : "0.00"; ?></h1>
    </div>

</div>

<h2>Management Tools</h2>

<div class="product-grid">

    <div class="product-card">

        <h2>Manage Users</h2>

        <p>
            View, edit and delete users from the platform.
        </p>

        <a href="users.php" class="back-button">
            Open Users
        </a>

    </div>

    <div class="product-card">

        <h2>Manage Products</h2>

        <p>
            View, edit and delete marketplace products.
        </p>

        <a href="products.php" class="back-button">
            Open Products
        </a>

    </div>

    <div class="product-card">

        <h2>Manage Orders</h2>

        <p>
            View completed payments and marketplace transactions.
        </p>

        <a href="orders.php" class="back-button">
            Open Orders
        </a>

    </div>

</div>

</div>

</body>
</html>