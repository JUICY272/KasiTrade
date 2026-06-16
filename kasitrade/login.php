<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - KasiTrade</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="auth-logo">

    <img 
    src="images/kasitrade-logo-use_upscaled.png"
    alt="KasiTrade Logo">

</div>

<div class="container">

<h2>Login</h2>

<?php

if(isset($_GET['error'])){

    echo "
    <div style='
        background:red;
        color:white;
        padding:10px;
        margin-bottom:15px;
        border-radius:5px;
        text-align:center;
    '>

    Incorrect email or password!

    </div>
    ";

}

?>

<form action="login_process.php" method="POST">

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>

</form>

<p>
    Don't have an account?
    <a href="register.php">Register</a>
</p>

</div>

</body>
</html>