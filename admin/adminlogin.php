


<?php



if (isset($_POST["login"])) {
  $ADMIN_EMAILID = mysqli_real_escape_string($conn, $_POST["ADMIN_EMAILID"]);
  $ADMIN_PASSWORD = mysqli_real_escape_string($conn, $_POST["ADMIN_PASSWORD"]);

  $check_email = mysqli_query($conn, "SELECT ADMINid, ADMIN_PASSWORD , ADMIN_NAME FROM admin  WHERE ADMIN_EMAILID = '$ADMIN_EMAILID'");
  if (mysqli_num_rows($check_email) > 0) {
    $row = mysqli_fetch_assoc($check_email);
    $stored_password = $row['ADMIN_PASSWORD'];
    if (password_verify($password, $stored_password)) {
        $_SESSION["ADMINid"] = $row['ADMINid'];
        $_SESSION["ADMIN_NAME"] = $row['ADMIN_NAME'];
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

<style>
@import url('https://fonts.googleapis.com/css?family=Playfair+Display:400,900|Poppins:400,500');
	* {
	  margin: 0;
	  padding: 0;
	  text-decoration: none;
	  box-sizing: border-box;
	}
	body {
	  margin: 0;
	  padding: 0;
	  background: #f6f6f6;
	  font-family: 'Poppins', sans-serif;
	  overflow-x: hidden;
	  height: 100vh;
	  margin: auto;
	  display: flex;
	}

	img {
		max-width: 100%;
	}

	.app {
	  background-color: #fff;
	  width: 330px;
	  height: 570px;
	  margin: 2em auto;
	  border-radius: 5px;
	  padding: 1em;
	  position: relative;
	  overflow: hidden;
	  box-shadow: 0 6px 31px -2px rgba(0, 0, 0, .3);
	}

	a {
		text-decoration: none;
		color: #257aa6;
	}

	p {
		font-size: 13px;
		color: #333;
		line-height: 2;
	}
		.light {
			text-align: right;
			color: #fff;
		}
			.light a {
				color: #fff;
			}

	.bg {
		width: 400px;
		height: 550px;
		background: #257aa6;
		position: absolute;
		top: -5em;
		left: 0;
		right: 0;
		margin: auto;
		background-image: url("background.jpg");
		background-position: center;
		background-size: cover;
		background-repeat: no-repeat;
		clip-path: ellipse(69% 46% at 48% 46%);
	}

	form {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		width: 100%;
		text-align: center;
		padding: 2em;
	}

	header {
	    width: 220px;
	    height: 220px;
	    margin: 1em auto;
	  }

	form input {
	    width: 100%;
	    padding: 13px 15px;
	    margin: 0.7em auto;
	    border-radius: 100px;
	    border: none;
	    background: rgb(255,255,255,0.3);
	    font-family: 'Poppins', sans-serif;
	    outline: none;
	    color: #fff;
	}
	input::placeholder {
	    color: #fff;
	    font-size: 13px;
	}

	.inputs {
		margin-top: -4em;
	}

	footer {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		padding: 2em;
		text-align: center;
	}

	button {
		width: 100%;
	    padding: 13px 15px;
	    border-radius: 100px;
	    border: none;
	    background: #257aa6;
	    font-family: 'Poppins', sans-serif;
	    outline: none;
	    color: #fff;
	}
	
	@media screen and (max-width: 640px) {
			.app {
				width: 100%;
				height: 100vh;
				border-radius: 0;
			}

			.bg {
				top: -7em;
				width: 450px;
				height: 95vh;
			}
			header {
				width: 90%;
				height: 250px;
			}
			.inputs {
				margin: 0;
			}
			input, button {
				padding: 18px 15px;
			}
		}
    </style>

   <div class="app">

		<div class="bg"></div>

		<form action="dashboard.php" method="post">
			<header>
				<img src="https://assets.codepen.io/3931482/internal/avatars/users/default.png?format=auto&height=80&version=1592223909&width=80">
			</header>

			<div class="inputs">
				<input type="text" name="ADMIN_EMAILID" placeholder="EMAIL">
				<input type="password" name="ADMIN_PASSWORD" placeholder="PASSWORD">

				<p class="light"><a href="#">Forgot password?</a></p>
				<button name="login" type="submit">LOGIN</button>

			</div>

		</form>

		<footer>
		</footer>


	</div>