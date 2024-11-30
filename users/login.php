<?php


session_start();

include 'config.php';



if (isset($_POST["signup"])) {
  $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
  $address = mysqli_real_escape_string($conn, $_POST["address"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $cpassword = mysqli_real_escape_string($conn, $_POST["signup_cpassword"]);

  // Check if passwords match
  if ($password !== $cpassword) {
    echo "<script>alert('Passwords do not match');</script>";
  } else {
    // Check if email already exists
    $check_email = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
      echo "<script>alert('Email already exists');</script>";
    } else {
      // Insert new user into the database
      $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Use password_hash() for secure password hashing
      $sql = "INSERT INTO users (full_name, email, phone, address, password) VALUES ('$full_name', '$email', '$phone', '$address', '$hashed_password')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $_POST["full_name"] = "";
        $_POST["email"] = "";
        $_POST["phone"] = "";
        $_POST["address"] = "";
        $_POST["password"] = "";
        $_POST["signup_cpassword"] = "";
        echo "<script>alert('User registration successful');</script>";
      } else {
        echo "<script>alert('User registration failed');</script>";
      }
    }
  }
}

if (isset($_POST["login"])) {
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  $check_email = mysqli_query($conn, "SELECT id, password, full_name FROM users WHERE email = '$email'");
  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $stored_password = $row['password'];
    if (password_verify($password, $stored_password)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["full_name"] = $row['full_name'];
        header("Location: productsindex.php");
        exit();
    } else {
      echo "<script>alert('Login details are incorrect. Please try again.');</script>";
    }
  } else {
    echo "<script>alert('Login details are incorrect. Please try again.');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <div class="container">
    <div class="card">
      <div class="inner-box" id="card">
        <div class="card-front">
          <h2>LOGIN</h2>
          <form action="#" method="post">
            <input type="email" class="input-box" placeholder="example@mail.com" name="email" required>
            <input type="password" class="input-box" placeholder="Password" name="password"  required>
            <button type="submit" class="submit-btn" name="login">LOGIN</button>
            <input type="checkbox"><span>Remember Me</span>
          </form>
          <button type="button" class="btn" onclick="openRegister()">I'm New Here</button>
          <a href="#">Forget Password</a>
        </div>

        <div class="card-back">
          <h2>SIGNUP</h2>
          <form action="" method="post">
            <input type="text" class="input-box" placeholder="enter your name" name="full_name" required>
            <input type="email" class="input-box" placeholder="enter your email" name="email" required>
            <input type="number" class="input-box" placeholder="enter your phone number" name="phone" required>
            <input type="text" class="input-box" placeholder="enter your address" name="address" required>
            <input type="password" class="input-box" placeholder="enter your password" name="password" required>
            <input type="password" class="input-box" placeholder="confirm your password" name="signup_cpassword" required>

            <button type="submit" class="submit-btn" name="signup">SIGNUP</button>
          </form>
          <button type="button" class="btn" onclick="openLogin()">I've an account</button>
          <a href="#">Forget Password</a>
        </div>
      </div>
    </div>
  </div>
  <style>
    * {
  margin: 0;
  padding: 0;
}

.container {
  width: 100%;
  height: 100vh;
  font-family: sans-serif;
  background: rgb(187, 187, 245);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
}

.card {
  width: 350px;
  height: 500px;
  box-shadow: 0 0 40px 20px rgba(0, 0, 0, 0.26);
  perspective: 1000px;
}

.inner-box {
  position: relative;
  width: 100%;
  height: 100%;
  transform-style: preserve-3d;
  transition: transform 1s;
}

.card-front,
.card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  background-position: center;
  background-size: cover;
  background-image: linear-gradient(rgba(0, 0, 100, 0.8), rgba(0, 0, 100, 0.8)),
    url(https://i.postimg.cc/zG2yKQFM/background.jpg);
  padding: 55px;
  box-sizing: border-box;
  backface-visibility: hidden;
  border-radius: 5px;
}

.card-back {
  transform: rotateY(180deg);
}

.card h2 {
  font-weight: normal;
  font-size: 24px;
  text-align: center;
  margin-bottom: 20px;
}

.input-box {
  width: 100%;
  background: transparent;
  border: 1px solid #fff;
  margin: 6px 0;
  height: 32px;
  border-radius: 20px;
  padding: 0 10px;
  box-sizing: border-box;
  outline: none;
  text-align: center;
  color: #fff;
}

::placeholder {
  color: #fff;
  font-size: 12px;
}

button {
  width: 100%;
  background: transparent;
  border: 1px solid #fff;
  margin: 35px 0 10px;
  height: 32px;
  font-size: 12px;
  border-radius: 20px;
  padding: 0 10px;
  box-sizing: border-box;
  outline: none;
  color: #fff;
  cursor: pointer;
}

.submit-btn {
  position: relative;
}

.submit-btn::after {
  content: "\27a4";
  color: #333;
  line-height: 32px;
  font-size: 17px;
  height: 32px;
  width: 32px;
  border-radius: 50%;
  background: #fff;
  position: absolute;
  right: -1px;
  top: -1px;
}

span {
  font-size: 13px;
  margin-left: 10px;
}

.card .btn {
  margin-top: 70px;
}

.card a {
  color: #fff;
  text-decoration: none;
  display: block;
  text-align: center;
  font-size: 13px;
  margin-top: 8px;
}

  </style>
</body>

<script>
  var card = document.getElementById("card");

function openRegister() {
  card.style.transform = "rotateY(-180deg)";
}

function openLogin() {
  card.style.transform = "rotateY(0deg)";
}

</script>

</html>