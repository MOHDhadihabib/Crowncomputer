<?php
include("config.php");
$error = "";

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $uploadfile = $_FILES['picture']['name'];
  $tmname = $_FILES['picture']['tmp_name'];
  $folder = "pictures/" . $uploadfile;
  move_uploaded_file($tmname, $folder);

  if ($name != "" && $uploadfile != "") {
    $sql = "INSERT INTO categories (name, picture) VALUES ('$name', '$folder')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
      $error .= "<div class='alert alert-success'>Data INSERTED!</div>";
    } else {
      $error .= "<div class='alert alert-danger'>Error inserting data: " . mysqli_error($conn) . "</div>";
    }
  } else {
    $error .= "<div class='alert alert-danger'>All Fields are required</div>";
  }
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Product Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/3da5cff3a5.js" crossorigin="anonymous"></script>
  <style>
    

    body {
      background-color: black;
    }

    #heading {
    color: white;
  }


    #form {
      background-color: #FFFFFF;
      padding: 20px;
      border-radius: 10px;
    }

    #form label {
      font-weight: bold;
    }

    #form input[type="text"],
    #form input[type="number"],
    #form input[type="file"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #CED4D9;
      border-radius: 3px;
      transition: border-color 0.3s;
    }

    #form input[type="text"]:focus,
    #form input[type="number"]:focus,
    #form input[type="file"]:focus {
      border-color: rgb(106, 161, 143);
    }

    #ekleButton {
      margin-top: 15px;
      font-weight: bold;
    }

    #ekleButton:hover {
      box-shadow: -1px 1px 17px 0px rgba(0, 0, 0, 0.75);
    }

    .container {
      max-width: 500px;
      width: 100%;
    }
  </style>
</head>
<body>
  <h1 id="heading"><CEnter>ADD CATEGORY</CEnter></h1>
  <div class="container">
    <div class="border p-4" id="form">
      <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="UrunID" class="form-label">category NAME</label>
          <input type="text" class="form-control" name="name" id="UrunID" aria-describedby="" required>
        </div>

        <div class="mb-3">
          <label for="UrunImage" class="form-label">category Image</label>
          <input type="file" class="form-control" name="picture" id="UrunImage">
        </div>

        <div class="text-center">
          <button type="submit" name="submit" class="btn btn-success text-white btn-outline-success form-control w-50 mt-3" id="ekleButton">Add Stock</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const pushButton = document.getElementById('ekleButton');

    pushButton.addEventListener('click', function() {
      const itemID = document.getElementById('UrunID').value;
      const itemName = document.getElementById('UrunAdi').value;
      const quantity = document.getElementById('UrunMiktar').value;

      // Check if the item name is empty
      if (itemName === '') {
        alert('Please enter a product name');
        return false;
      }

      // Perform your desired operations with the input values here
      // ...
    });
  </script>
</body>
</html>
