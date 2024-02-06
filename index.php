<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <link rel="stylesheet" href="login.css">
</head>
<body>

<div>
    <img src="logo.png" class="logo"> 
</div>

<div class="container">
    <div class="heading">Log In</div>
    <form action="newlead.php" method="post" class="form">
        <input required="" class="input" type="text" name="username" id="username" placeholder="Username">
        <input required="" class="input" type="password" name="password" id="password" placeholder="Password">
        <button class="login-button" type="submit">Log in</button>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    // Check if username and password match
    if ($inputUsername === "Learners Academy" && $inputPassword === "Learners123") {
        // Redirect to the desired page upon successful login
        header("Location: index.php");
        exit();
    } else {
        // Display an error message if login fails
        echo "<script>alert('Incorrect username or password. Please try again.');</script>";
    }
}
?>

</body>
</html>
