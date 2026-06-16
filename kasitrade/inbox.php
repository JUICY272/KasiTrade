<?php

session_start();
include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT 
            messages.product_id,
            messages.sender_id,
            messages.receiver_id,
            products.title,
            users.name,
            MAX(messages.created_at) AS latest_time
        FROM messages
        JOIN products ON messages.product_id = products.product_id
        JOIN users ON messages.sender_id = users.user_id
        WHERE messages.receiver_id='$user_id'
        GROUP BY messages.product_id, messages.sender_id
        ORDER BY latest_time DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inbox</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="product-view-container">

<h1>Inbox</h1>

<a href="dashboard.php" class="back-button">← Back</a>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="product-card">

    <h2><?php echo $row['title']; ?></h2>

    <p>Message from: <?php echo $row['name']; ?></p>

    <p>Latest message: <?php echo $row['latest_time']; ?></p>

    <a 
    href="conversation.php?product_id=<?php echo $row['product_id']; ?>&user_id=<?php echo $row['sender_id']; ?>" 
    class="back-button">
        Open Conversation
    </a>

</div>

<br>

<?php } ?>

</div>

</body>
</html>