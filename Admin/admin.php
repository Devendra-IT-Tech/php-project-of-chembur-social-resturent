<?php

include_once('../includes/db.php');

$db_connected = false;
if (isset($conn) && !$conn->connect_error) {
    $db_connected = true;
}


$total_orders = 0;
$total_revenue = 0;

if ($db_connected) {

    $count_query = "SELECT COUNT(id) as count FROM orders";
    $count_result = $conn->query($count_query);
    if ($count_result) {
        $total_orders = $count_result->fetch_assoc()['count'];
    }


    $rev_query = "SELECT SUM(price * quantity) as total FROM orders";
    $rev_result = $conn->query($rev_query);
    if ($rev_result) {
        $row = $rev_result->fetch_assoc();
        $total_revenue = $row['total'] ? $row['total'] : 0;
    }


    $orders_query = "SELECT id, item_name, quantity, price, payment_method, DATE_FORMAT(order_date, '%h:%i %p') as time FROM orders ORDER BY id DESC LIMIT 20";
    $recent_orders_result = $conn->query($orders_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChemburSocial Admin Dashboard</title>
<link rel="icon" href="../Asset/images/logo.png">
   <link rel="stylesheet" href="../Asset/admin.css">
</head>
<body>
    <div class="sidebar">

    <div class="sidebar-header">
            🍽️ RestoAdmin
        </div>
        <ul class="nav-links">
<ul class="nav-links">
    <li><a href="admin.php" class="active">Dashboard</a></li>
    <li><a href="orders.php">Orders Database</a></li>
    <li><a href="menu_items.php">Menu Items</a></li>
    <li><a href="customers.php">Customers</a></li>
    <li><a href="settings.php">Settings</a></li>
</ul>  
     </ul>
    </div>

    
    <div class="main-content">
        <div class="header">
            <h1>Live Database Overview</h1>
            <div>
    <a href="../login.php">
        <button class="admin-login-btn">Admin login</button>
    </a>
</div>
        </div>

        <?php if (!$db_connected): ?>
            <div class="db-error">
                <strong>Database Error:</strong> <?php echo $db_error_message; ?><br>
                Please ensure you have created the `restaurant_db` database and started your MySQL server.
            </div>
        <?php endif; ?>

    
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Orders Today</h3>
                <div class="value"><?php echo $total_orders; ?></div>
            </div>
            <div class="stat-card">
                <h3>Revenue Today</h3>
                <div class="value">₹<?php echo number_format($total_revenue, 2); ?></div>
            </div>
            <div class="stat-card">
                <h3>Active Menu Items</h3>
                <div class="value">42</div>
            </div>
        </div>

    
        <div class="table-container">
            <h2>Latest Database Orders</h2>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Time</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Payment Method</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if ($db_connected && $recent_orders_result !== false && $recent_orders_result->num_rows > 0) {
            while($row = $recent_orders_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>#" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['time']) . "</td>";
                echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                echo "<td>₹" . number_format($row['price'], 2) . "</td>";
                echo "<td>" . htmlspecialchars($row['payment_method']) . "</td>";
                echo "</tr>";
            }
        } else if ($db_connected) {
            echo "<tr><td colspan='6' style='text-align: center;'>No orders found in the database today.</td></tr>";
        } else {
            echo "<tr><td colspan='6' style='text-align: center;'>Cannot display orders. Database not connected.</td></tr>";
        }
        ?>
    </tbody>
</table>
        </div>
    </div>

</body>
</html>
<?php 

if (isset($conn) && $conn instanceof mysqli) {$conn->close(); 
}
?>