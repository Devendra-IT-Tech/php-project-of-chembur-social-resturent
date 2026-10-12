<?php
include_once('includes/db.php');

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_name'])) {
    $item_name = $_POST['item_name'];
    $unit_price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $payment_method = $_POST['payment_method'];
    
    // Calculate total price based on quantity
    $total_price = $unit_price * $quantity;

    // Insert order with quantity, total price, and payment method
    $stmt = $conn->prepare("INSERT INTO orders (item_name, price, quantity, total_price, payment_method) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sddds", $item_name, $unit_price, $quantity, $total_price, $payment_method);
        if ($stmt->execute()) {
            $msg = "Order placed successfully for $quantity x $item_name! Total: ₹$total_price via $payment_method";
        } else {
            $msg = "Error placing order. Please try again.";
        }
        $stmt->close();
    } else {
        $msg = "Database prepare failed: " . addslashes($conn->error) ;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Asset/images/logo.png">
    <title>Order - Chembur Social</title>

    <link rel="stylesheet" href="Asset/style.css">
</head>
<body class="product_body">
    
   <section class="nav-order">
    <nav>
        <div id="nav-order">
        <ul>
            <li><a href="ChemburSocial.html#Home" id="nav-box">Home</a></li>
            <li><a href="ChemburSocial.html#about" id="nav-box">About Us</a></li>
            <li><a href="Product.php" id="nav-box">Order</a></li>
            <li><a href="Table.php" id="nav-box">Table</a></li>
            <li><a href="ChemburSocial.html#contact" id="nav-box">Contact US</a></li>
        </ul>
        </div>
    </nav>
   </section>
   
<div id="Order-Container">

    
    <div class="box-food" id="starter">
        <form action="Product.php" method="POST">
            <input type="hidden" name="item_name" value="Garlic Bread">
            <input type="hidden" name="price" value="150.00">
            <div class="food-image">
                <img src="Asset/images/garlic bread.jpg" alt="garlic-bread">
            </div>
            <div class="food-info">
                <h3>Garlic Bread</h3>
                <p>₹150.00</p>
            </div>
            <div class="order-options">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px;" required>
            </div>
            <div class="order-options">
                <label>Payment:</label>
                <select name="payment_method" required>
                    <option value="Cash">Cash on Delivery</option>
                    <option value="UPI">UPI / Google Pay</option>
                    <option value="Card">Credit / Debit Card</option>
                </select>
            </div>
            <div class="order-btn">
                <button type="submit">order now</button>
            </div>
        </form>
    </div>
    <div class="box-food starter">
        <form action="Product.php" method="POST">
            <input type="hidden" name="item_name" value="French Fries">
            <input type="hidden" name="price" value="120.00">
            <div class="food-image">
                <img src="Asset/images/french fries.jpg" alt="French fries">
            </div>
            <div class="food-info">
                <h3>French Fries</h3>
                <p>₹120.00</p>
            </div>
            <div class="order-options">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px;" required>
            </div>
            <div class="order-options">
                <label>Payment:</label>
                <select name="payment_method" required>
                    <option value="Cash">Cash on Delivery</option>
                    <option value="UPI">UPI / Google Pay</option>
                    <option value="Card">Credit / Debit Card</option>
                </select>
            </div>
            <div class="order-btn">
                <button type="submit">order now</button>
            </div>
        </form>
    </div>

    
    <div class="box-food starter">
        <form action="Product.php" method="POST">
            <input type="hidden" name="item_name" value="Chicken Wings">
            <input type="hidden" name="price" value="250.00">
            <div class="food-image">
                <img src="Asset/images/Chicken wings.jpg" alt="Chicken wings">
            </div>
            <div class="food-info">
                <h3>Chicken Wings</h3>
                <p>₹250.00</p>
            </div>
            <div class="order-options">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px;" required>
            </div>
            <div class="order-options">
                <label>Payment:</label>
                <select name="payment_method" required>
                    <option value="Cash">Cash on Delivery</option>
                    <option value="UPI">UPI / Google Pay</option>
                    <option value="Card">Credit / Debit Card</option>
                </select>
            </div>
            <div class="order-btn">
                <button type="submit">order now</button>
            </div>
        </form>
    </div>

    <div class="box-food starter">
        <form action="Product.php" method="POST">
            <input type="hidden" name="item_name" value="Paneer Tikka">
            <input type="hidden" name="price" value="220.00">
            <div class="food-image">
                <img src="Asset/images/Paneertikka.jpg" alt="Paneer Tikka">
            </div>
            <div class="food-info">
                <h3>Paneer Tikka</h3>
                <p>₹220.00</p>
            </div>
            <div class="order-options">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px;" required>
            </div>
            <div class="order-options">
                <label>Payment:</label>
                <select name="payment_method" required>
                    <option value="Cash">Cash on Delivery</option>
                    <option value="UPI">UPI / Google Pay</option>
                    <option value="Card">Credit / Debit Card</option>
                </select>
            </div>
            <div class="order-btn">
                <button type="submit">order now</button>
            </div>
        </form>
    </div>


    <div class="box-food Main">
        <form action="Product.php" method="POST">
            <input type="hidden" name="item_name" value="Burgers">
            <input type="hidden" name="price" value="180.00">
            <div class="food-image">
               <img src="Asset/images/burger.jpg" alt="Burger">
            </div>
            <div class="food-info">
                <h3>Burgers</h3>
                <p>₹180.00</p>
            </div>
            <div class="order-options">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px;" required>
            </div>
            <div class="order-options">
                <label>Payment:</label>
                <select name="payment_method" required>
                    <option value="Cash">Cash on Delivery</option>
                    <option value="UPI">UPI / Google Pay</option>
                    <option value="Card">Credit / Debit Card</option>
                </select>
            </div>
            <div class="order-btn">
                <button type="submit">order now</button>
            </div>
        </form>
    </div>


    <div class="box-food Main">
        <form action="Product.php" method="POST">
            <input type="hidden" name="item_name" value="Margherita Pizza">
            <input type="hidden" name="price" value="300.00">
            <div class="food-image">
                <img src="Asset/images/Margherita_pizza.jpg" alt="Margherita_pizza">
            </div>
            <div class="food-info">
                <h3>Margherita Pizza</h3>
                <p>₹300.00</p>
            </div>
            <div class="order-options">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px;" required>
            </div>
            <div class="order-options">
                <label>Payment:</label>
                <select name="payment_method" required>
                    <option value="Cash">Cash on Delivery</option>
                    <option value="UPI">UPI / Google Pay</option>
                    <option value="Card">Credit / Debit Card</option>
                </select>
            </div>
            <div class="order-btn">
                <button type="submit">order now</button>
            </div>
        </form>
    </div>


    <div class="box-food">
        <form action="Product.php" method="POST">
            <input type="hidden" name="item_name" value="Fresh Citrus Salad">
            <input type="hidden" name="price" value="160.00">
            <div class="food-image">
                <img src="Asset/images/salad.jpg" alt="Fresh Citrus salad">
            </div>
            <div class="food-info">
                <h3>Fresh Citrus Salad</h3>
                <p>₹160.00</p>
            </div>
            <div class="order-options">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="1" min="1" max="10" style="width: 60px;" required>
            </div>
            <div class="order-options">
                <label>Payment:</label>
                <select name="payment_method" required>
                    <option value="Cash">Cash on Delivery</option>
                    <option value="UPI">UPI / Google Pay</option>
                    <option value="Card">Credit / Debit Card</option>
                </select>
            </div>
            <div class="order-btn">
                <button type="submit">order now</button>
            </div>
        </form>
    </div>
 <?= $msg; ?>
</div>

    <div class="footer-order">
        <footer id="footer-info">
            <h1>Chembur Social</h1>
            <p>Your simple online order website</p>
            <div id="contact-order">
                <p>📞 9876543210</p>
                <p>✉ chumbersocial@shopease.com</p>
            </div>
            <hr>
            <p>© 2026 ShopEase</p>
        </footer>
    </div>
</body>
</html>