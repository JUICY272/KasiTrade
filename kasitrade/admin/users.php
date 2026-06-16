<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$sql = "SELECT * FROM users ORDER BY user_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Manage Users</title>

<link rel="stylesheet" href="../css/style.css">

</head>
<body>

<div class="product-view-container">

<h1>Manage Users</h1>

<a href="index.php" class="back-button">
    ← Back to Dashboard
</a>

<div class="product-grid">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="product-card">

    <h2><?php echo $row['name']; ?></h2>

    <p><?php echo $row['email']; ?></p>

    <p>Role: <?php echo $row['role']; ?></p>

    <a 
    href="edit_user.php?id=<?php echo $row['user_id']; ?>" 
    class="back-button">
        Edit
    </a>

    <a 
    href="delete_user.php?id=<?php echo $row['user_id']; ?>" 
    class="back-button"
    onclick="return confirm('Delete this user?');">
        Delete
    </a>

</div>

<?php } ?>

</div>

</div>

</body>
</html>