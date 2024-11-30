<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_crowncomputer";

// Create Connection
$con = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$price = "";
$stock = "";
$picture = "";
$category_id = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Show the method of the product
    if (!isset($_GET["id"])) {
        header("location: productsindex.php");
        exit;
    }
    $id = $_GET["id"];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: productsindex.php");
        exit;
    }

    $name = $row["name"];
    $price = $row["price"];
    $stock = $row["stock"];
    $picture = $row["picture"];
    $category_id = $row["category_id"];
} else {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $picture = $_POST["picture"];
    $category_id = $_POST["category_id"];

    if (empty($name) || empty($price) || empty($stock) || empty($picture) || empty($category_id)) {
        $errorMessage = "ALL fields are required";
    } else {
        $sql = "UPDATE products SET name = ?, price = ?, stock = ?, picture = ?, category_id = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("siisii", $name, $price, $stock, $picture, $category_id, $id);
        $result = $stmt->execute();

        if (!$result) {
            $errorMessage = "Invalid query: " . $con->error;
        } else {
            $successMessage = "Product updated correctly";
            header("Location: productsindex.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    if (!empty($errorMessage)) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>$errorMessage</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
  </div>";
    }
    ?>

    <div class="container my-5">
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>

            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="price" value="<?php echo $price; ?>">
                </div>
            </div>

            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Stock</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="stock" value="<?php echo $stock; ?>">
                </div>
            </div>

            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Picture</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" name="picture" value="<?php echo $picture; ?>">
                </div>
            </div>

            <div class="row md-3">
                <label class="col-sm-3 col-form-label">Category ID</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="category_id" value="<?php echo $category_id; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
    <div class='row md-3'>
                <div class='offset-sm-3 col-sm-6'>
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>$successMessage</strong> 
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
</div>
</div>
    </button>
  </div>";
            }
            ?>

            <div class="row md-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="productsindex.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
