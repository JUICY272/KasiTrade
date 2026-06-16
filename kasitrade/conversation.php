<?php

session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$current_user = $_SESSION['user_id'];
$other_user = $_GET['user_id'];
$product_id = $_GET['product_id'];

$product_sql = "SELECT * FROM products WHERE product_id='$product_id'";
$product_result = mysqli_query($conn, $product_sql);
$product = mysqli_fetch_assoc($product_result);

$sql = "SELECT messages.*, users.name
        FROM messages
        JOIN users ON messages.sender_id = users.user_id
        WHERE product_id='$product_id'
        AND (
            (sender_id='$current_user' AND receiver_id='$other_user')
            OR
            (sender_id='$other_user' AND receiver_id='$current_user')
        )
        ORDER BY created_at ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Conversation</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="product-view-container">

<a href="inbox.php" class="back-button">← Back to Inbox</a>

<div class="product-view-card">

<h1><?php echo $product['title']; ?></h1>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="description-box" style="margin-bottom:15px;">

    <strong><?php echo $row['name']; ?>:</strong>

    <p style="text-align:left;">
        <?php echo $row['message']; ?>
    </p>

    <small><?php echo $row['created_at']; ?></small>

</div>

<?php } ?>

<form action="reply_message.php" method="POST">

<input type="hidden" name="receiver_id" value="<?php echo $other_user; ?>">
<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

<label>Reply</label>
<textarea name="message" required></textarea>

<button type="submit">Send Reply</button>

</form>

</div>

</div>

</body>
</html>