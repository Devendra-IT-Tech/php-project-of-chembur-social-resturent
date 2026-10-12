<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Asset/images/logo.png" >
    <title>Welcome Back!</title>
   <link rel="stylesheet" href="Asset/style.css">
</head>
<body id="body-login">
    <div id="chumber-logo">
        <img src="Asset/images/logo.png">
    </div>
<section id="login-left">
    <img src="Asset/images/interior.jpg">
</section>

    <section id="login-right">
    <div id="header">
        <br>
            <h1>Welcome back</h1>
            <br>
    </div>
    <div id="login-form">
        <form action="" method="POST">
            <label id="email">name:</label><br>
            <input placeholder="name" type="text" id="email-box" name="name"required><br>
            <label id="password">Password:</label><br>
            <input placeholder="Password" type="password" id="Password-box" name="password" required><br>
            <button>LOGIN</button><br>
            <a id="forget" href=""> Forget Password</a><br>
            <h6>If u don't have account?</h6>
            <a href="regsitration.php">SignUp</a>
        </form>
    </div>
    </section>

<?php
include_once('includes\db.php');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"] ?? '');
    $password = test_input($_POST["password"] ?? '');
    $stmt = $conn->prepare("SELECT * FROM customer WHERE name = ?");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if ($user['PASSWORD'] === $password) {
            header("location: ChemburSocial.html");
            exit();
        } else {
            echo "<center>Incorrect Password</center>";
        }
    } else {
        echo "<center>User is not found</center>";
    }
}
?>
</body>
</html>
