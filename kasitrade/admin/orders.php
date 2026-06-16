<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$sql = "SELECT orders.*, 
               products.title,
               buyer.name AS buyer_name,
               seller.name AS seller_name
        FROM orders
        JOIN products ON orders.product_id = products.product_id
        JOIN users AS buyer ON orders.buyer_id = buyer.user_id
        JOIN users AS seller ON orders.seller_id = seller.user_id
        ORDER BY orders.order_id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Orders</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="product-view-container">

<h1>Manage Orders</h1>

<a href="index.php" class="back-button">← Back to Admin Dashboard</a>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="product-card">

    <h2><?php echo $row['title']; ?></h2>

    <p>Buyer: <?php echo $row['buyer_name']; ?></p>

    <p>Seller: <?php echo $row['seller_name']; ?></p>

    <h3>Amount: R<?php echo $row['amount']; ?></h3>

    <p>Status: <?php echo $row['payment_status']; ?></p>

    <small><?php echo $row['created_at']; ?></small>

</div>

<br>

<?php } ?>

</div>

</body>
</html>