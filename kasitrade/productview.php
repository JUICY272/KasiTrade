<?php

include("includes/db.php");

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE product_id='$id'";

$result = mysqli_query($conn, $sql);

$product = mysqli_fetch_assoc($result);

/* LOAD ALL PRODUCT IMAGES */

$image_sql = "SELECT * FROM product_images 
              WHERE product_id='$id'";

$image_result = mysqli_query($conn, $image_sql);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
    <?php echo $product['title']; ?>
</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="product-view-container">

    <a href="products.php" class="back-button">
        ← Back to Products
    </a>

    <div class="product-view-card">

        <!-- IMAGE GALLERY -->

        <div class="image-gallery">

        <?php

        while($img = mysqli_fetch_assoc($image_result)){

        ?>

            <img 
            src="<?php echo $img['image_path']; ?>" 
            alt="Product Image">

        <?php

        }

        ?>

        </div>

        <!-- PRODUCT INFO -->

        <h1>
            <?php echo $product['title']; ?>
        </h1>

        <h2>
            R<?php echo $product['price']; ?>
        </h2>

        <p class="category">
            Category: <?php echo $product['category']; ?>
        </p>

        <div class="description-box">

            <?php echo nl2br($product['description']); ?>

        </div>

	<br>

	<a 
	href="message.php?seller_id=<?php echo $product['seller_id']; ?>&product_id=<?php echo $product['product_id']; ?>" 
	class="back-button">
	    Message Seller
	</a>

	<?php if($product['status'] == "Reserved"){ ?>

	<a 
	href="checkout.php?id=<?php echo $product['product_id']; ?>" 
	class="back-button">
	    Proceed to Secure Payment
	</a>

	<?php } ?>

	<?php
	$seller_id = $product['seller_id'];
	?>

	<br>

	<h2>Rate this Seller</h2>

	<form action="rate_seller.php" method="POST">

	    <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">

	    <label>Select Rating</label>

	    <select name="rating" required>
	        <option value="">Choose rating</option>
	        <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
	        <option value="4">⭐⭐⭐⭐ - Good</option>
	        <option value="3">⭐⭐⭐ - Average</option>
	        <option value="2">⭐⭐ - Poor</option>
	        <option value="1">⭐ - Bad</option>
	    </select>

	    <button type="submit">Submit Rating</button>

	</form>

    </div>

</div>

</body>
</html>