<?php
session_start();
include 'config.php';

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// Add a logout URL for the logout button
$logoutUrl = "logout.php"; // You need to create this logout.php file to handle the logout logic
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/20034a5f5a.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .navbar {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-item .nav-link {
            font-size: 1rem;
        }

        .nav-link.logout-btn {
            color: #dc3545;
            font-weight: bold;
        }

        .nav-link.logout-btn:hover {
            color: #c82333;
            text-decoration: none;
        }

        .container-fluid {
            padding-top: 20px;
            padding-bottom: 50px;
        }

        .product-item {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .carimg {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .card-body {
            background-color: #ffffff;
            padding: 20px;
        }

        .card-title, .card-text {
            color: #333;
        }

        .cart-btn {
            display: flex;
            align-items: center;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .cart-btn i {
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Product Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>
            </ul>
            <a class="nav-link logout-btn" href="cart.php"<?php echo $logoutUrl; ?>">
                <i class="fas fa-sign-out-alt"></i> cart
            </a>
            <a class="nav-link logout-btn" href="logout.php"<?php echo $logoutUrl; ?>">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <?php
            $query = "SELECT * FROM products";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                foreach ($result as $row) {
                    $name = $row['name'];
                    $price = $row['price'];
                    $stock = $row['stock'];
                    $picture = $row['picture'];
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 product-item">
                        <div class="card">
                            <img src="<?php echo $picture ?>" class="card-img-top carimg" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $name ?></h5>
                                <p class="card-text">Price: <?php echo $price ?> Rs</p>
                                <a href="addtocart.php?id=<?php echo $row['id']; ?>" class="btn cart-btn">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
