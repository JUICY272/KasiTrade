<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    echo "Access denied.";
    exit();
}

$user_id = $_GET['id'];

$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">

<h1>Edit User</h1>

<form action="update_user.php" method="POST">

<input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

<label>Name</label>
<input type="text" name="name" value="<?php echo $user['name']; ?>" required>

<label>Email</label>
<input type="email" name="email" value="<?php echo $user['email']; ?>" required>

<label>Role</label>
<input type="text" name="role" value="<?php echo $user['role']; ?>" required>

<button type="submit">Update User</button>

</form>

<br>
<a href="users.php" class="back-button">← Back</a>

</div>

</body>
</html>