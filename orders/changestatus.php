<?php
// Assuming you have already established a database connection in your config.php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];
        $new_status = 'delivered';

        // Update the order status in the database
        $sql = "UPDATE orders SET status = '$new_status' WHERE id = $order_id";
        $result = $conn->query($sql);

        if ($result) {
            // Redirect to the page where you display all orders (for example, orders.php)
            header("Location: index.php");
            exit;
        } else {
            echo "Error updating order status: " . $conn->error;
        }
    }
}
?>

<!-- Your HTML code for displaying the orders and changing status -->
<!-- For example, you can display the orders in a table -->
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['total']}</td>
                        <td>{$row['status']}</td>
                        <td>";
                if ($row['status'] === 'pending') {
                    echo "<form method='post'>
                            <input type='hidden' name='order_id' value='{$row['id']}'>
                            <button type='submit'>Mark Delivered</button>
                          </form>";
                } else {
                    echo "Already Delivered";
                }
                echo "</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No orders found.</td></tr>";
        }
        ?>
    </tbody>
</table>
