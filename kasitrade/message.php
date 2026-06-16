<?php

session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$seller_id = $_GET['seller_id'];
$product_id = $_GET['product_id'];

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Message Seller</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h1>Message Seller</h1>

<form action="send_message.php" method="POST">

<input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

<label>Your Message</label>
<textarea name="message" required></textarea>

<button type="submit">Send Message</button>

</form>

<br>

<a href="productview.php?id=<?php echo $product_id; ?>" class="back-button">← Back</a>

</div>

</body>
</html>