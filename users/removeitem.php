<?php
session_start();
// Check if the product_id is provided in the URL.
if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    // Redirect the user to the cart page if the product_id is missing.
    header('Location: cart.php');
    exit();
}

// Get the product ID from the URL.
$product_id = $_GET['product_id'];

// Check if the product_id exists in the cart.
if (isset($_SESSION['cart'][$product_id])) {
    // Calculate the amount to be deducted from the total price and quantity.
    $removed_product = $_SESSION['cart'][$product_id];
    $removed_product_total_price = $removed_product['price_total'];
    $removed_product_quantity = $removed_product['quantity'];

    // Remove the product from the cart.
    unset($_SESSION['cart'][$product_id]);

    // Update the cart total price and quantity.
    $_SESSION['cart_details']['cart_total_price'] -= $removed_product_total_price;
    $_SESSION['cart_details']['cart_total_qty'] -= $removed_product_quantity;
}

// Redirect the user back to the cart page.
header('Location: cart.php');
exit();
?>
