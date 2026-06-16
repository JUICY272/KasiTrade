<?php

session_start();

include("includes/db.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id='$user_id'";

$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

$rating_sql = "SELECT AVG(rating) AS average_rating 
               FROM ratings 
               WHERE seller_id='$user_id'";

$rating_result = mysqli_query($conn, $rating_sql);
$rating_data = mysqli_fetch_assoc($rating_result);

$average_rating = round($rating_data['average_rating'], 1);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

<h1>My Profile</h1>

<p>
<strong>Name:</strong>
<?php echo $user['name']; ?>
</p>

<p>
<strong>Email:</strong>
<?php echo $user['email']; ?>
</p>

<p>
<strong>Role:</strong>
<?php echo $user['role']; ?>
</p>

<p>

<strong>Average Rating:</strong>

<?php

if($average_rating > 0){

    echo $average_rating . " / 5";

}else{

    echo "No ratings yet";

}

?>

</p>

<br>

<a href="dashboard.php" class="back-button">
    ← Back
</a>

</div>

</body>
</html>