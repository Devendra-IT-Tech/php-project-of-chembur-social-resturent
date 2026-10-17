<?php
include_once('../includes/db.php');

$db_connected = false;
if (isset($conn) && !$conn->connect_error) {
    $db_connected = true;
}

if ($db_connected) {
    // Queries unique menu items sold or fetches from a products table
    $menu_query = "SELECT DISTINCT item_name, price FROM orders ORDER BY item_name ASC";
    $menu_result = $conn->query($menu_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Items - RestoAdmin</title>
    <link rel="stylesheet" href="../Asset/admin.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">🍽️ RestoAdmin</div>
        <ul class="nav-links">
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="orders.php">Orders Database</a></li>
            <li><a href="menu_items.php" class="active">Menu Items</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Active Menu Items</h1>
            <div><span>Admin User</span></div>
        </div>

        <div class="table-container">
            <h2>Available Dishes & Drinks</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($db_connected && $menu_result !== false && $menu_result->num_rows > 0) {
                        while($row = $menu_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                            echo "<td>₹" . number_format($row['price'], 2) . "</td>";
                            echo "<td><span class='status status-completed'>Available</span></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' style='text-align: center;'>No menu items available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>