<?php
session_start();

include 'config.php';

$id = $_SESSION["id"];
$query = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($query);
$full_name = $email = $phone = $address = '';

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
}

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

if ($order_id == '') {
    // If order_id is not provided in the URL, you can fetch the latest order for the user.
    $query = "SELECT id FROM orders WHERE user_id='$id' ORDER BY order_date_time DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $order_id = $row['id'];
    }
}

$query = "SELECT od.*, p.name AS product_name, p.price AS product_price, p.id AS product_id, p.picture, o.delivery_charges
FROM order_details od 
JOIN products p ON od.product_id = p.id 
JOIN orders o ON od.order_id = o.id 
WHERE od.order_id = '$order_id'"; 

$result = $conn->query($query);

if (!$result) {
    echo "Query error: " . $conn->error;
    exit;
}

// Calculate total amount
$totalAmount = 0;
?>

<style>
  /* Add your custom font family */
  body {
    font-family: 'YourFontFamily', Arial, sans-serif;
  }

  /* Add background color and borders to the invoice container */
  .invoice {
    background-color: #f2f2f2;
    padding: 20px;
    border: 2px solid #333;
    border-radius: 10px;
    margin: 50px auto;
    max-width: 800px;
  }

  /* Style the header */
  .invoice-header {
    text-align: center;
    margin-bottom: 20px;
  }

  /* Style the page title */
  .pageTitle {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #333;
  }

  /* Style the sub-header */
  .sub-header {
    font-size: 1.2rem;
    color: #666;
  }

  /* Style the cards */
  .ui.card {
    background-color: #fff;
    border: 2px solid #ccc;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
    margin-bottom: 20px;
  }

  /* Style card content */
  .card .content {
    padding: 0;
  }

  /* Style card lists */
  .card ul {
    list-style: none;
    padding: 0;
  }

  /* Style card list items */
  .card li {
    margin-bottom: 10px;
  }

  /* Style the table */
  .ui.celled.table {
    margin-top: 20px;
    border: 2px solid #ccc;
    border-collapse: collapse;
  }

  /* Style table headers and cells */
  .ui.celled.table th,
  .ui.celled.table td {
    border: 2px solid #ccc;
    padding: 10px 15px;
  }

  /* Style table header background */
  .ui.celled.table th {
    background-color: #f7f7f7;
  }

  /* Center align text in the card */
  .ui.card.center.aligned {
    text-align: center;
  }

  /* Style big font text */
  .bigfont {
    font-size: 2rem;
    color: #555;
  }

  /* Style additional content text */
  .content p {
    margin-top: 20px;
    font-size: 1rem;
    color: #666;
  }
</style>

<style>
  @page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;
  }
}

body{
  background:#EEE;
}

.bigfont {
  font-size: 3rem !important;
}
.invoice{
  width:970px !important;
  margin:50px auto;
}

.logo {
  float:left;
  padding-right: 10px;
  margin:10px auto;
}

dt {
float:left;
}
dd {
float:left;
clear:right;
}

.customercard {
  min-width:65%;
}

.itemscard {
  min-width:98.5%;
  margin-left:0.5%;
}

.logo {
  max-width: 5rem;
  margin-top: -0.25rem;
}

.invDetails {
  margin-top: 0rem;
}

.pageTitle {
  margin-bottom: -1rem;
}

</style>
<style>
  .invoice {
    font-family: Arial, sans-serif;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    margin: 50px auto;
    max-width: 800px;
  }

  .invoice-header {
    text-align: center;
    margin-bottom: 20px;
  }

  .pageTitle {
    font-size: 2rem;
    margin-bottom: 10px;
    color: #333;
  }

  .sub-header {
    font-size: 1.2rem;
    color: #666;
  }

  .ui.card {
    background-color: #f7f7f7;
    border: none;
    box-shadow: none;
    padding: 20px;
    margin-bottom: 20px;
  }

  .card .content {
    padding: 0;
  }

  .card ul {
    list-style: none;
    padding: 0;
  }

  .card li {
    margin-bottom: 10px;
  }

  .ui.celled.table {
    margin-top: 20px;
    border: none;
    box-shadow: none;
  }

  .ui.celled.table th,
  .ui.celled.table td {
    border-color: #ddd;
    padding: 10px 15px;
  }

  .ui.celled.table th {
    background-color: #f7f7f7;
  }

  .ui.card.center.aligned {
    text-align: center;
  }

  .bigfont {
    font-size: 2rem;
    color: #555;
  }

  .content p {
    margin-top: 20px;
    font-size: 1rem;
    color: #666;
  }
</style>


<div class="container invoice">
  <div class="invoice-header">
    <div class="ui left aligned grid">
      <div class="row">
        <div class="left floated left aligned six wide column">
          <div class="ui">
            <h1 class = "ui header pageTitle">Invoice</h1>
            <br><br>
            <h4 class="ui sub header invDetails"><?php echo $order_id?></h4>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ui segment cards">
    <div class="ui card">
      <div class="content">
      <div class="header">Company Details</div>
      </div>
      <div class="content">
        <ul>
          <li> <strong> Name: CROWN COMPUTER </strong> </li>
          <li><strong> Phone: </strong>03153897198</li>
          <li><strong> Email: </strong>hadi.habib315@gmail.com</li>
          <li><strong> Contact: </strong> admin</li>
        </ul>
      </div>
      </div>
    </div>
    <div class="ui card customercard">
      <div class="content">
      <div class="header">Customer Details</div>
      </div>
      <div class="content">
        <ul>
          <li> <strong> Name:<?php echo $full_name ?> </strong> </li>
          <li><strong> Address: </strong><?php echo $address ?></li>
          <li><strong> Phone: </strong><?php echo $phone  ?></li>
          <li><strong> Email: </strong> <?php echo $email ?></li>
        </ul>
      </div>
    </div>

    <div class="ui segment itemscard">
      <div class="content">
<table class="ui celled table">
    <thead>
        <tr>
            <th>Product image</th>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Shipping Cost</th>
        </tr>
    </thead>

<tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                $product_name = $row['product_name'];
                $product_price = $row['product_price'];
                $qty = $row['qty'];
                $delivery_charges = $row['delivery_charges'];
                $subtotal = $product_price * $qty;
                $totalAmount += $subtotal + $delivery_charges;
                ?>

                <tr>
                    <td><img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="<?php echo htmlspecialchars($product_name); ?>" class="product-image"></td>
                    <td><?php echo htmlspecialchars($product_name); ?></td>
                    <td>PKR <?php echo number_format($product_price); ?></td>
                    <td><?php echo $qty; ?></td>
                    <td><span class="font-weight-600">PKR <?php echo number_format($subtotal); ?></span></td>
                    <td>PKR <?php echo number_format($delivery_charges); ?></td>
                </tr>

                <?php
            }
            ?>
        </tbody>
  </table>

      </div>
    </div>

    <div class="ui card">
      <div class="content center aligned text segment">
        <small class="ui sub header"> Amount Due (AUD): </small>
        <p class="bigfont"><?php echo $totalAmount?>  </p>
      </div>
    </div>
<div class="content">
        Payment is requested within 15 days of recieving this invoice.
      </div>
    </div>
  </div>
</div>
