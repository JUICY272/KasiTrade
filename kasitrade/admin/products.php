<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$sql = "SELECT * FROM products ORDER BY product_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Products</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="product-view-container">

<h1>Manage Products</h1>

<a href="index.php" class="back-button">← Back to Admin Dashboard</a>

<div class="product-grid">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="product-card">

    <img src="../<?php echo $row['image']; ?>" style="width:100%; height:180px; object-fit:cover; border-radius:10px; margin-bottom:15px;">

    <h2><?php echo $row['title']; ?></h2>

    <p><?php echo $row['description']; ?></p>

    <h3>R<?php echo $row['price']; ?></h3>

    <p>Category: <?php echo $row['category']; ?></p>

    <a href="edit_product.php?id=<?php echo $row['product_id']; ?>" class="back-button">Edit</a>

    <a 
    href="delete_product.php?id=<?php echo $row['product_id']; ?>" 
    class="back-button"
    onclick="return confirm('Are you sure you want to delete this product?');">
        Delete
    </a>

</div>

<?php } ?>

</div>

</div>

</body>
</html>