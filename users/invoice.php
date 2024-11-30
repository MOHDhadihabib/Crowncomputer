<?php
session_start();
include 'config.php';

$id = $_SESSION["id"];
$query = "SELECT * FROM users where id='$id'";
$result = $conn->query($query);
$full_name = $email = $phone = $address = '';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
}

$order_id = isset($_GET['id']) ? $_GET['id'] : $id;

$query = "SELECT od.*, p.name AS product_name, p.price AS product_price, p.picture AS product_image, o.delivery_charges
          FROM order_details od 
          JOIN products p ON od.product_id = p.id 
          JOIN orders o ON od.order_id = o.id 
          WHERE od.id = '$order_id'";
$result = $conn->query($query);
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/semantic.min.css"> <!-- Update this path -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .invoice {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: auto;
            max-width: 800px;
        }
        .header {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2em;
        }
        .header h4 {
            margin: 0;
            font-weight: normal;
        }
        .ui.card {
            margin-bottom: 20px;
        }
        .ui.celled.table thead {
            background-color: #007BFF;
            color: white;
        }
        .ui.celled.table td {
            padding: 10px;
        }
        .ui.card .content {
            border-top: 2px solid #007BFF;
        }
        .bigfont {
            font-size: 24px;
            font-weight: bold;
            color: #007BFF;
        }
        .total-amount {
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container invoice">
    <div class="header">
        <h1 class="ui header pageTitle">Invoice</h1>
        <h4 class="ui sub header invDetails">Order ID: <?php echo $order_id; ?></h4>
    </div>
    
    <div class="ui segment cards">
        <div class="ui card">
            <div class="content">
                <div class="header">Company Details</div>
            </div>
            <div class="content">
                <ul>
                    <li><strong>Name:</strong> CROWN COMPUTER</li>
                    <li><strong>Phone:</strong> 03153897198</li>
                    <li><strong>Email:</strong> hadi.habib315@gmail.com</li>
                    <li><strong>Contact:</strong> admin</li>
                </ul>
            </div>
        </div>
        
        <div class="ui card customercard">
            <div class="content">
                <div class="header">Customer Details</div>
            </div>
            <div class="content">
                <ul>
                    <li><strong>Name:</strong> <?php echo ($full_name); ?></li>
                    <li><strong>Address:</strong> <?php echo ($address); ?></li>
                    <li><strong>Phone:</strong> <?php echo ($phone); ?></li>
                    <li><strong>Email:</strong> <?php echo ($email); ?></li>
                </ul>
            </div>
        </div>

<!-- Displaying Order Details Table -->
<table class="ui celled table">
    <thead>
        <tr>
            <th>Product Image</th> <!-- New Column -->
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Shipping Cost</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $totalAmount = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                $product_image = $row['product_image']; // Get the product image
                $qty = $row['qty'];
                $delivery_charges = $row['delivery_charges'];
                $subtotal = $product_price * $qty;
                $totalAmount += $subtotal + $delivery_charges;
                ?>
                <tr>
                    <td><img src="<?php echo ($product_image); ?>" alt="<?php echo ($product_name); ?>" style="width: 50px; height: auto;"></td> <!-- Display Product Image -->
                    <td><?php echo ($product_name); ?></td>
                    <td>PKR <?php echo number_format($product_price); ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><span class="font-weight-600">PKR <?php echo number_format($subtotal); ?></span></td>
                    <td>PKR <?php echo number_format($delivery_charges); ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
            </tbody>
        </table>
        
        <!-- Total Amount Card -->
        <div class="total-amount">
            <small class="ui sub header">Amount Due:</small>
            <p class="bigfont">PKR <?php echo number_format($totalAmount); ?></p>
        </div>
    </div>
</div>

</body>
</html>
