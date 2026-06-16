<?php

session_start();

include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$seller_id = $_GET['id'];

$user_sql = "SELECT * FROM users WHERE user_id='$seller_id'";
$user_result = mysqli_query($conn, $user_sql);
$user = mysqli_fetch_assoc($user_result);

$rating_sql = "SELECT AVG(rating) AS average_rating
               FROM ratings
               WHERE seller_id='$seller_id'";

$rating_result = mysqli_query($conn, $rating_sql);
$rating_data = mysqli_fetch_assoc($rating_result);

$average_rating = round($rating_data['average_rating'], 1);

$product_sql = "SELECT * FROM products
                WHERE seller_id='$seller_id'
                ORDER BY product_id DESC";

$product_result = mysqli_query($conn, $product_sql);

?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $user['name']; ?> - Profile</title>

<link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="product-view-container">

<a href="products.php" class="back-button">← Back to Products</a>

<div class="product-view-card">

<h1><?php echo $user['name']; ?></h1>

<p>
<strong>Average Rating:</strong>

<?php
if($average_rating > 0){
    echo "⭐ " . $average_rating . " / 5";
}else{
    echo "No ratings yet";
}
?>

</p>

</div>

<br>

<h1><?php echo $user['name']; ?>'s Listings</h1>

<div class="product-grid">

<?php while($row = mysqli_fetch_assoc($product_result)){ ?>

<div class="product-card">

    <h2>
        <a href="productview.php?id=<?php echo $row['product_id']; ?>">
            <?php echo $row['title']; ?>
        </a>
    </h2>

    <img 
    src="<?php echo $row['image']; ?>" 
    alt="Product Image"
    class="product-image">

    <p><?php echo $row['description']; ?></p>

    <h3>R<?php echo $row['price']; ?></h3>

</div>

<?php } ?>

</div>

</div>

</body>
</html>