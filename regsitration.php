<?php
include_once("includes/db.php");

$msg = "";
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Use prepared statements to securely insert the customer data
    $stmt = $conn->prepare("INSERT INTO customer (name, email, PASSWORD) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            $msg = "Registration successful! Please login.".header("location:login.php");

        } else {
            $msg = "Error: Email or username might already exist.";
        }
        $stmt->close();
    } else {
        $msg = "Database error: " . addslashes($conn->error) ;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Asset/images/logo.png">
    <title>Sign Up - Chembur Social</title>
    <link rel="stylesheet" href="Asset/style.css">
</head>
<body class="body-signup">


    <div class="signup-container">
        <center><h1>Chembur Social</h1></center>
        
        <h2>Create Account</h2>
        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit" name="submit">Sign Up</button><br>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
        <center>
        <?= $msg; ?>
</center>
    </div>
</body>
</html>