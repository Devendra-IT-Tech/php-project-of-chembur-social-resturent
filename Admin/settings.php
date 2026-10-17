<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - RestoAdmin</title>
    <link rel="stylesheet" href="../Asset/admin.css">
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">🍽️ RestoAdmin</div>
        <ul class="nav-links">
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="orders.php">Orders Database</a></li>
            <li><a href="menu_items.php">Menu Items</a></li>
            <li><a href="customers.php">Customers</a></li>
            <li><a href="settings.php" class="active">Settings</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>System Settings</h1>
            <div><span>Admin User</span></div>
        </div>

        <div class="table-container">
            <h2>Restaurant Configuration</h2>
            <br>
            <p><strong>Database Name:</strong> scr</p>
            <p><strong>Server Host:</strong> localhost</p>
            <p><strong>Currency:</strong> INR (₹)</p>
            <p><strong>System Status:</strong> <span class="status status-completed">Online</span></p>
        </div>
    </div>

</body>
</html>