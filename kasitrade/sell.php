<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sell Item - KasiTrade</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">
        <img 
        src="images/kasitrade-logo-use_upscaled.png"
        style="height:90px;vertical-align:middle">
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

<div class="container">

<h1 style="text-align:center;">
    Sell an Item
</h1>

<form action="sell_process.php" method="POST" enctype="multipart/form-data">

    <label>Product Title</label>
    <input type="text" name="title" required>

    <label>Description</label>
    <textarea name="description"></textarea>

    <label>Price</label>
    <input type="number" step="0.01" name="price" required>

    <label>Category</label>
    	<select name="category" required>
    	<option value="">Select a category</option>
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

    <label>Product Images</label>
    <input type="file" name="images[]" accept="image/*" multiple required>

    <button type="submit">
        Upload Product
    </button>

</form>

</div>

<script>

function toggleMenu(){

    document
    .getElementById("dropdownMenu")
    .classList
    .toggle("show");

}

</script>

</body>
</html>