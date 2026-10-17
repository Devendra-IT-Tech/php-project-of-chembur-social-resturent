<?php
include_once('../includes/db.php');

$db_connected = false;
if (isset($conn) && !$conn->connect_error) {
    $db_connected = true;
}

if ($db_connected) {
    $customers_query = "SELECT * FROM customer ORDER BY id DESC";
    $customers_result = $conn->query($customers_query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - RestoAdmin</title>
    <link rel="stylesheet" href="../Asset/admin.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">🍽️ RestoAdmin</div>
        <ul class="nav-links">
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="orders.php">Orders Database</a></li>
            <li><a href="menu_items.php">Menu Items</a></li>
            <li><a href="customers.php" class="active">Customers</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Customer Database</h1>
            <div><span>Admin User</span></div>
        </div>

        <div class="table-container">
            <h2>Registered Customers</h2>
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ($db_connected && $customers_result !== false && $customers_result->num_rows > 0) {
                        while($row = $customers_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>#" . htmlspecialchars($row['id'] ?? $row['customer_id'] ?? '1') . "</td>";
                            echo "<td>" . htmlspecialchars($row['name'] ?? $row['customer_name'] ?? 'Guest Customer') . "</td>";
                            echo "<td>" . htmlspecialchars($row['email'] ?? 'N/A') . "</td>";
                            echo "<td>" . htmlspecialchars($row['phone'] ?? 'N/A') . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' style='text-align: center;'>No customer records found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>