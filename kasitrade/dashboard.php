<?php

session_start();

include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$sql = "SELECT products.*, users.name 
        FROM products
        JOIN users ON products.seller_id = users.user_id
        ORDER BY products.product_id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KasiTrade Dashboard</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">
        <img 
        src="images/kasitrade-logo-use_upscaled.png" 
        alt="KasiTrade Logo"
        style="height:90px; vertical-align:middle;">
    </div>

    <div class="nav-links">
        <a href="dashboard.php">Home</a>
        <a href="products.php">Browse</a>
        <a href="sell.php">Sell Item</a>
    </div>

    <div class="profile-menu">

    <button class="profile-button" onclick="toggleMenu()">

        <img 
        src="images/user.png" 
        alt="User Icon"
        style="height:23px; vertical-align:middle;">

        <?php echo $_SESSION['name']; ?>

    </button>

    <div class="dropdown" id="dropdownMenu">

        <a href="profile.php">My Profile</a>

        <a href="mylistings.php">My Listings</a>

	<a href="inbox.php">Inbox</a>

        <a href="logout.php">Logout</a>

    </div>

</div>

</div>

<!-- MAIN CONTENT -->

<div style="padding:30px;">

    <h1>Latest Products</h1>

    <div class="product-grid">

<?php

while($row = mysqli_fetch_assoc($result)){

$seller_id = $row['seller_id'];

$rating_sql = "SELECT AVG(rating) AS average_rating
               FROM ratings
               WHERE seller_id='$seller_id'";

$rating_result = mysqli_query($conn, $rating_sql);
$rating_data = mysqli_fetch_assoc($rating_result);

$average_rating = round($rating_data['average_rating'], 1);

?>

<div class="product-card">

    <h2>
        <a 
        href="productview.php?id=<?php echo $row['product_id']; ?>"
        style="color:#10a29e; text-decoration:none;">

            <?php echo $row['title']; ?>

        </a>
    </h2>

    <img src="<?php echo $row['image']; ?>" alt="Product Image" class="product-image">   

    <p>
        <?php echo $row['description']; ?>
    </p>

    <h3>
        R<?php echo $row['price']; ?>
    </h3>

    <p class="status-badge">

    <?php

    if($row['status'] == "Available"){

    ?>

    <img src="images/green.png" class="status-icon">

    Available

    <?php

    }elseif($row['status'] == "Reserved"){

    ?>

    <img src="images/orange.png" class="status-icon">

    Reserved

    <?php

    }else{

    ?>

    <img src="images/red.png" class="status-icon">

    Sold

    <?php

    }

    ?>

    </p>

    <p>
    	Seller:
	<a href="userprofile.php?id=<?php echo $row['seller_id']; ?>">
	    <?php echo $row['name']; ?>
	</a>
    </p>

    <p>
        ⭐
        <?php
        if($average_rating > 0){
            echo $average_rating . " / 5";
        }else{
            echo "No ratings yet";
        }
        ?>
    </p>

</div>

<?php

}

?>

    </div>

</div>

<script>

function toggleMenu(){

    document
    .getElementById("dropdownMenu")
    .classList
    .toggle("show");

}

</script>

<?php include("includes/footer.php"); ?>

</body>
</html>