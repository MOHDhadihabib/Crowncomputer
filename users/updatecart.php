<?php
session_start();
include 'config.php'; // Ensure this file sets up the $conn variable

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Ensure quantity is at least 1
    if ($quantity < 1) {
        $quantity = 1;
    }

    // Update cart in session
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['stock'] = $quantity;

        // Recalculate total price
        $total_price = 0;
        foreach ($_SESSION['cart'] as $product) {
            $total_price += $product['price'] * $product['stock'];
        }
        $_SESSION['cart_details']['cart_total_price'] = $total_price;

        echo "Cart updated";
    } else {
        echo "Product not found in cart";
    }
}
?>
