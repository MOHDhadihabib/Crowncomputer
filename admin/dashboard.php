<?php
session_start();
include 'config.php'; // Include your database connection

// Fetch completed and ongoing orders
$ordersQuery = "SELECT o.id AS order_id, o.total, o.delivery_charges, o.order_date_time, o.status, u.full_name
                FROM orders o
                JOIN users u ON o.user_id = u.id";
$ordersResult = $conn->query($ordersQuery);

// Fetch all users
$usersQuery = "SELECT * FROM users";
$usersResult = $conn->query($usersQuery);

// Fetch all products
$productsQuery = "SELECT * FROM products";
$productsResult = $conn->query($productsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="path/to/your/styles.css"> <!-- Link to your CSS -->
</head>
<body>
    <h1>Order Management</h1>
    
    <h2>Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Delivery Charges</th>
                <th>Date & Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($ordersResult->num_rows > 0): ?>
                <?php while($order = $ordersResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo $order['full_name']; ?></td>
                        <td><?php echo $order['total']; ?></td>
                        <td><?php echo $order['delivery_charges']; ?></td>
                        <td><?php echo $order['order_date_time']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No orders found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Users</h2>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($usersResult->num_rows > 0): ?>
                <?php while($user = $usersResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['full_name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['phone']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No users found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Products</h2>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category ID</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($productsResult->num_rows > 0): ?>
                <?php while($product = $productsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['stock']; ?></td>
                        <td><?php echo $product['category_id']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No products found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
</body>
</html>
