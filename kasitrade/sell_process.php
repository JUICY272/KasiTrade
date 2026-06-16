<?php

session_start();
include("includes/db.php");

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];
$seller_id = $_SESSION['user_id'];

$main_image = "";

$sql = "INSERT INTO products
(title, description, price, category, seller_id, image, status)
VALUES
('$title', '$description', '$price', '$category', '$seller_id', '$main_image', 'Available')";

if(mysqli_query($conn, $sql)){

    $product_id = mysqli_insert_id($conn);

    foreach($_FILES['images']['name'] as $key => $image_name){

        $image_tmp = $_FILES['images']['tmp_name'][$key];

        $upload_path = "uploads/" . time() . "_" . $image_name;

        move_uploaded_file($image_tmp, $upload_path);

        if($key == 0){
            $main_image = $upload_path;

            $update_sql = "UPDATE products 
                           SET image='$main_image' 
                           WHERE product_id='$product_id'";

            mysqli_query($conn, $update_sql);
        }

        $image_sql = "INSERT INTO product_images 
        (product_id, image_path)
        VALUES
        ('$product_id', '$upload_path')";

        mysqli_query($conn, $image_sql);
    }

    header("Location: products.php");
    exit();

}else{

    echo "Error: " . mysqli_error($conn);

}

?>