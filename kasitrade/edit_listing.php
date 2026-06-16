<?php

session_start();
include("includes/db.php");

$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM products 
        WHERE product_id='$product_id' 
        AND seller_id='$user_id'";

$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Listing</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h1>Edit Listing</h1>

<form action="update_listing.php" method="POST">

<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

<label>Product Title</label>
<input type="text" name="title" value="<?php echo $product['title']; ?>" required>

<label>Description</label>
<textarea name="description"><?php echo $product['description']; ?></textarea>

<label>Price</label>
<input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>

<label>Category</label>
<input type="text" name="category" value="<?php echo $product['category']; ?>">

<button type="submit">Update Listing</button>

</form>

<br>
<a href="mylistings.php" class="back-button">← Back</a>

</div>

</body>
</html>