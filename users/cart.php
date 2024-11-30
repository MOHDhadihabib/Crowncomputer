<?php
session_start();
if (!isset($_SESSION["id"])) {
  header("Location: login.php");
  exit();
}
?>

<body>
  <div id="w">
    <header id="title">
      <h1>YOUR CART</h1>
    </header>
    <div id="page">
      <table id="cart">
        <thead>
          <tr>
            <th class="first">Photo</th>
            <th class="second">Name</th>
            <th class="third">Price</th>
            <th class="fourth">Quantity</th>
            <th class="fifth">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- shopping cart contents -->

          <?php
include 'config.php';

// Check if the cart is empty.
if (empty($_SESSION['cart'])) {
  echo '<center><h1 class="empty">Your Cart Is Empty.</h1></center>';
  echo '<br>';
  echo '<center><a class="btn btn-danger" href="productsindex.php">Return to home</a></center>';
  exit;
}

$cart = $_SESSION['cart'];

$insert = false;
if (isset($_POST['submit'])) {
  $id = $_SESSION["id"];
  $total = $_SESSION['cart_details']['cart_total_price'];
  $delivery_charges = 500;
  $order_date_time = date('Y-m-d H:i:s');

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "INSERT INTO orders (user_id, total, delivery_charges, order_date_time, status) VALUES ('$id', '$total', '$delivery_charges', '$order_date_time', 'pending')";

  if ($conn->query($sql) === TRUE) {
    $order_id = mysqli_insert_id($conn);

    foreach ($cart as $product_id => $product) {
      $price = $product['price'];
      $stock = $product['stock'];

      $sql = "INSERT INTO order_details (order_id, product_id, price, qty) VALUES ('$order_id', '$product_id', '$price', '$stock')";

      if ($conn->query($sql) !== TRUE) {
        echo "Error inserting into order_details table: " . $conn->error;
        exit;
      }
    }

    $insert = true;
    $_SESSION['cart'] = [];
    $_SESSION['cart_details'] = null;

    // emails
    include 'Email/email.php';

    // Redirect to a success page or any other page you want after successful insertion
    header("Location: inovice1.php");
    exit;
  } else {
    echo "Error inserting into orders table: " . $conn->error;
    exit;
  }

  $conn->close();
}
?>

<?php foreach ($cart as $product_id => $product) { ?>
  <tr>
    <td><img class="img" src="<?php echo $product['image']; ?>" alt="Sorry, it is not available yet"></td>
    <td><?php echo $product['name']; ?></td>
    <td><?php echo $product['price']; ?></td>
    <td><?php echo $product['stock']; ?></td>
    <td>
      <a class="btn btn-danger" href="removeitem.php?product_id=<?php echo $product_id; ?>">Remove Item</a>
    </td>
  </tr>
<?php } ?>

<!-- tax + subtotal -->
<center>
<tr class="totalprice">
  <td class="light"><h1>Total:</h1></td>
  <td colspan="2">&nbsp;</td>
  <td colspan="2"><span class="thick"><?php echo $_SESSION['cart_details']['cart_total_price']; ?></span></td>
</tr>
</center>
<!-- checkout btn -->
<tr class="checkoutrow">
  <td colspan="5" class="checkout">
    <form action="" method="post">
      <button type="submit" id="submitbtn" name="submit">Checkout Now!</button>
    </form>
  </td>
</tr>
</tbody>
</table>
</div>
</div>
<style>
/* Your CSS styles here */
</style>
</body>
  <style>
    @import url(https://fonts.googleapis.com/css?family=Fredoka+One);

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
  outline: none;
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
html { overflow-y: scroll; }
body {
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 62.5%;
  line-height: 1;
  color: #414141;
  background: white;
  padding: 25px 0;
}

::selection { background: #bdc0e8; }
::-moz-selection { background: #bdc0e8; }
::-webkit-selection { background: #bdc0e8; }

br { display: block; line-height: 1.6em; } 

article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section { display: block; }
ol, ul { list-style: none; }

input, textarea { 
  -webkit-font-smoothing: antialiased;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  outline: none; 
}

blockquote, q { quotes: none; }
blockquote:before, blockquote:after, q:before, q:after { content: ''; content: none; }
strong, b { font-weight: bold; }
em, i { font-style: italic; }

table { border-collapse: collapse; border-spacing: 0; }
img { border: 0; max-width: 100%; }

h1 {
  font-family: 'Fredoka One', Helvetica, Tahoma, sans-serif;
  color: #fff;
  text-shadow: 1px 2px 0 #7184d8;
  font-size: 3.5em;
  line-height: 1.1em;
  padding: 6px 0;
  font-weight: normal;
  text-align: center;
}


/* page structure */
#w {
  display: block;
  width: 600px;
  margin: 0 auto;
}

#title {
  display: block;
  width: 100%;
  background: #95a6d6;
  padding: 10px 0;
  -webkit-border-top-right-radius: 6px;
  -webkit-border-top-left-radius: 6px;
  -moz-border-radius-topright: 6px;
  -moz-border-radius-topleft: 6px;
  border-top-right-radius: 6px;
  border-top-left-radius: 6px;
}

#page {
  display: block;
  background: #fff;
  padding: 15px 0;
  -webkit-box-shadow: 0 2px 4px rgba(0,0,0,0.4);
  -moz-box-shadow: 0 2px 4px rgba(0,0,0,0.4);
}

/** cart table **/
#cart {
  display: block;
  border-collapse: collapse;
  margin: 0;
  width: 100%;
  font-size: 1.2em;
  color: #444;
}
#cart thead th {
  padding: 8px 0;
  font-weight: bold;
}

#cart thead th.first {
  width: 175px;
}
#cart thead th.second {
  width: 45px;
}
#cart thead th.third {
  width: 230px;
}
#cart thead th.fourth {
  width: 130px;
}
#cart thead th.fifth {
  width: 20px;
}

#cart tbody td {
  text-align: center;
  margin-top: 4px;
}

tr.productitm {
  height: 65px;
  line-height: 65px;
  border-bottom: 1px solid #d7dbe0;
}


#cart tbody td img.thumb {
  vertical-align: bottom;
  border: 1px solid #ddd;
  margin-bottom: 4px;
}

.qtyinput {
  width: 33px;
  height: 22px;
  border: 1px solid #a3b8d3;
  background: #dae4eb;
  color: #616161;
  text-align: center;
}

tr.totalprice, tr.extracosts {
  height: 35px;
  line-height: 35px;
}
tr.extracosts {
  background: #e4edf4;
}

.remove {
  cursor: pointer;
  position: relative;
  right: 12px;
  top: 5px;
}


.light {
  color: #888b8d;
  text-shadow: 1px 1px 0 rgba(255,255,255,0.45);
  font-size: 1.1em;
  font-weight: normal;
}
.thick {
  color: #272727;
  font-size: 1.7em;
  font-weight: bold;
}


/** submit btn **/
tr.checkoutrow {
  background: #cfdae8;
  border-top: 1px solid #abc0db;
  border-bottom: 1px solid #abc0db;
}
td.checkout {
  padding: 12px 0;
  padding-top: 20px;
  width: 100%;
  text-align: right;
}


#submitbtn {
  width: 150px;
  height: 35px;
  outline: none;
  border: none;
  border-radius: 5px;
  margin: 0 0 10px 0;
  font-size: 1.3em;
  letter-spacing: 0.05em;
  font-family: Arial, Tahoma, sans-serif;
  color: #fff;
  text-shadow: 1px 1px 0 rgba(0,0,0,0.2);
  cursor: pointer;
  overflow: hidden;
  border-bottom: 1px solid #0071ff;
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #66aaff), color-stop(100%, #4d9cff));
  background-image: -webkit-linear-gradient(#66aaff, #4d9cff);
  background-image: -moz-linear-gradient(#66aaff, #4d9cff);
  background-image: -o-linear-gradient(#66aaff, #4d9cff);
  background-image: linear-gradient(#66aaff, #4d9cff);
}
#submitbtn:hover {
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #4d9cff), color-stop(100%, #338eff));
  background-image: -webkit-linear-gradient(#4d9cff, #338eff);
  background-image: -moz-linear-gradient(#4d9cff, #338eff);
  background-image: -o-linear-gradient(#4d9cff, #338eff);
  background-image: linear-gradient(#4d9cff, #338eff);
}
#submitbtn:active {
  border-bottom: 0;
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #338eff), color-stop(100%, #4d9cff));
  background-image: -webkit-linear-gradient(#338eff, #4d9cff);
  background-image: -moz-linear-gradient(#338eff, #4d9cff);
  background-image: -o-linear-gradient(#338eff, #4d9cff);
  background-image: linear-gradient(#338eff, #4d9cff);
  -webkit-box-shadow: inset 0 1px 3px 1px rgba(0,0,0,0.25);
  -moz-box-shadow: inset 0 1px 3px 1px rgba(0,0,0,0.25);
  box-shadow: inset 0 1px 3px 1px rgba(0,0,0,0.25);
}
  </style>
</body>