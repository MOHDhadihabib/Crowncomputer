<?php
session_start();
include 'config.php';

// Check if the product ID is provided.
if (!isset($_GET['id'])) {
  echo 'Product ID not specified.';
  exit;
}

// Retrieve the product ID.
$product_id = $_GET['id'];


if (isset($_GET['stock'])) {
  $stock = $_GET['stock'];
}

// Check if the product exists in the database.
$query = "SELECT * FROM products WHERE id = '$product_id'";
$result = $conn->query($query);

if ($result->num_rows === 0) {
  echo 'Product not found.';
  exit;
}

// Retrieve the product details.
$product = $result->fetch_assoc();
$name = $product['name'];
$price = $product['price'];

$picture = $product['picture'];


// Add the product to the cart.
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}

if (!isset($_SESSION['cart'][$product_id])) {
  $_SESSION['cart'][$product_id] = array(
    'name' => $name,
    'price' => $price,
    'stock' => isset($stock)?$stock:1,
    'image' => $picture
  );
} else {
  if(isset($stock))
  {
    $_SESSION['cart'][$product_id]['stock'] = $stock;
  }
  else
  {
    $_SESSION['cart'][$product_id]['stock']++;
  }
}
$_SESSION['cart'][$product_id]['price_total'] = $price * $_SESSION['cart'][$product_id]['stock'] ;

$_SESSION['cart_details']['cart_total_price'] = 0;
$_SESSION['cart_details']['cart_total_qty'] = 0;

foreach ($_SESSION['cart'] as $prod_id => $prod) {
// print_r($prod);

	$_SESSION['cart_details']['cart_total_price'] += $prod['price_total'];
	$_SESSION['cart_details']['cart_total_qty'] += $prod['stock'];
}




// print_r($_SESSION['cart_details']['cart_total_price']);
// echo "<br>";
// print_r($_SESSION['cart_details']['cart_total_qty']);
// exit;

// Redirect the user back to the main page.
header('Location: productsindex.php');