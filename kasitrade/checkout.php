<?php
session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$product_id = $_GET['id'];

$sql = "SELECT * FROM products WHERE product_id='$product_id'";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Secure Payment</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h1>Secure Payment</h1>

<h2><?php echo $product['title']; ?></h2>

<p>Amount: R<?php echo $product['price']; ?></p>

<form action="process_payment.php" method="POST">

<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
<input type="hidden" name="seller_id" value="<?php echo $product['seller_id']; ?>">
<input type="hidden" name="amount" value="<?php echo $product['price']; ?>">

<label>Card Number</label>
<input type="text" placeholder="4111 1111 1111 1111" required>

<label>Expiry Date</label>
<input type="text" placeholder="MM/YY" required>

<label>CVV</label>
<input type="text" placeholder="123" required>

<label>Name On Card</label>
<input type="text" placeholder="" required>

<label>Billing Address</label>
<input type="text" placeholder="1st Avenue Kempton Park Gauteng" required>

<button type="submit">Pay Securely</button>

</form>

<br>

<a href="productview.php?id=<?php echo $product_id; ?>" class="back-button">← Back</a>

</div>

</body>
</html>