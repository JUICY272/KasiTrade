<?php

session_start();

include("includes/db.php");

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM products 
        WHERE seller_id='$user_id'
        ORDER BY product_id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Listings</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="product-view-container">

<h1>My Listings</h1>

<div class="product-grid">

<?php

while($row = mysqli_fetch_assoc($result)){

?>

<div class="product-card">

    <h2>

        <a href="productview.php?id=<?php echo $row['product_id']; ?>">

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

    <br>

    <a 
    href="delete_listing.php?id=<?php echo $row['product_id']; ?>"
    class="back-button"
    onclick="return confirm('Are you sure you want to delete this listing?');">
        Delete Listing
    </a>

    <a 
    href="edit_listing.php?id=<?php echo $row['product_id']; ?>"
    class="back-button">
        Edit Listing
    </a>

    <a href="update_status.php?id=<?php echo $row['product_id']; ?>&status=Available" class="back-button">
        Mark Available
    </a>

    <a href="update_status.php?id=<?php echo $row['product_id']; ?>&status=Reserved" class="back-button">
        Mark Reserved
    </a>

    <a href="update_status.php?id=<?php echo $row['product_id']; ?>&status=Sold" class="back-button">
        Mark Sold
    </a>

</div>

<?php

}

?>

</div>

<br>

<a href="dashboard.php" class="back-button">
    ← Back
</a>

</div>

</body>
</html>