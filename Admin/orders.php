<?php
include_once('../includes/db.php');

$db_connected = false;
if (isset($conn) && !$conn->connect_error) {
    $db_connected = true;
}

if ($db_connected) {
    $orders_query = "SELECT id, item_name, quantity, price, payment_method, DATE_FORMAT(order_date, '%d-%m-%Y %h:%i %p') as order_time FROM orders ORDER BY id DESC";
    $orders_result = $conn->query($orders_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Database - RestoAdmin</title>
    <link rel="stylesheet" href="../Asset/admin.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">🍽️ RestoAdmin</div>
        <ul class="nav-links">
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="orders.php" class="active">Orders Database</a></li>
            <li><a href="menu_items.php">Menu Items</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>All Restaurant Orders</h1>
            <div><span>Admin User</span></div>
        </div>

        <div class="table-container">
            <h2>Complete Order History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Time</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Amount</th>
                        <th>Payment Method</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($db_connected && $orders_result !== false && $orders_result->num_rows > 0) {
                        while($row = $orders_result->fetch_assoc()) {
                            $total = $row['price'] * $row['quantity'];
                            echo "<tr>";
                            echo "<td>#" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['order_time']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
                            echo "<td>₹" . number_format($row['price'], 2) . "</td>";
                            echo "<td>₹" . number_format($total, 2) . "</td>";
                            echo "<td>" . htmlspecialchars($row['payment_method']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align: center;'>No orders found in database.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>