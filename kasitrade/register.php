<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - KasiTrade</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="auth-logo">

    <img 
    src="images/kasitrade-logo-use_upscaled.png" 
    alt="KasiTrade Logo">

</div>

<div class="container">

<h2>Create Account</h2>

<form action="register_process.php" method="POST">

    <label>Full Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input 
    type="password" 
    name="password" 
    pattern="^(?=.*[0-9])(?=.*[\W]).{6,}$"
    title="Password must be at least 6 characters and include a number and special character."
    required>

    <button type="submit">Register</button>

</form>

<p>
    Already have an account?
    <a href="login.php">Login</a>
</p>

</div>

</body>
</html>