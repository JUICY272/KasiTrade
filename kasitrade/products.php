<?php

session_start();

include("includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$search = "";
$category = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}

if(isset($_GET['category'])){
    $category = $_GET['category'];
}

$sql = "SELECT products.*, users.name
        FROM products
        JOIN users ON products.seller_id = users.user_id
        WHERE 1";

if($search != ""){
    $sql .= " AND title LIKE '%$search%'";
}

if($category != ""){
    $sql .= " AND category='$category'";
}

$sql .= " ORDER BY products.product_id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Browse Products - KasiTrade</title>

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

<!-- PAGE CONTENT -->

<div class="page-content">

<h1 style="padding-left:20px;">
    Browse Products
</h1>

<!-- SEARCH + FILTER -->

<form method="GET" action="products.php" class="search-form">

    <input 
    type="text" 
    name="search" 
    placeholder="Search products..."
    value="<?php echo $search; ?>">

    <select name="category">

        <option value="">All Categories</option>

        <option value="Electronics">Electronics</option>
        <option value="Clothing">Clothing</option>
        <option value="Furniture">Furniture</option>
        <option value="Books">Books</option>
        <option value="Home Appliances">Home Appliances</option>
        <option value="Beauty">Beauty</option>
        <option value="Sports">Sports</option>
        <option value="Toys">Toys</option>
        <option value="Vehicles">Vehicles</option>
        <option value="Other">Other</option>

    </select>

    <button type="submit">
        Search
    </button>

</form>

<!-- PRODUCT GRID -->

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

        <a href="productview.php?id=<?php echo $row['product_id']; ?>">

            <?php echo $row['title']; ?>

        </a>

    </h2>

    <img 
    src="<?php echo $row['image']; ?>" 
    alt="Product Image"
    class="product-image">

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