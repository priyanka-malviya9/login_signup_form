<?php
require('conn.php');
session_start();
?>


<!DOCTYPE html>
<html>

<head>
	<title>Login Form</title>
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

	<style>
		body {
			margin: 0;
			padding: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			font-family: 'Jost', sans-serif;
			background: linear-gradient(0deg, rgba(59, 93, 80, 1) 32%, rgba(13, 13, 12, 1) 100%);

		}

		.main {
			width: 400px;
			height: 400px;
			overflow: hidden;
			border-radius: 10px;
			box-shadow: 2px 2px 20px #000;
			background: linear-gradient(0deg, rgba(59, 93, 80, 1) 42%, rgba(13, 13, 12, 1) 100%);

		}

		label {
			color: #fff;
			font-size: 2.3em;
			justify-content: center;
			display: flex;
			margin: 50px;
			font-weight: bold;
			cursor: pointer;
			transition: .5s ease-in-out;
		}

		input {
			width: 70%;
			height: 20px;
			background: #e0dede;
			justify-content: center;
			display: flex;
			margin: 20px auto;
			padding: 10px;
			border: none;
			outline: none;
			border-radius: 5px;
		}

		button {
			width: 60%;
			height: 40px;
			margin: 30px auto 20px auto;
			justify-content: center;
			display: block;
			color: #fff;
			background: #1e362d;
			font-size: 1em;
			font-weight: bold;
			/* margin-top: 20px; */
			outline: none;
			border: none;
			border-radius: 5px;
			transition: .2s ease-in;
			cursor: pointer;
		}

		button:hover {
			background: #274238;
		}

		.main p {
			font-size: small;
			text-align: center;
			/* color: black; */
		}

		.main p a {
			color: #fff;
		}
	</style>

</head>

<body>

	<?php

	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		// check email is exits or not
		$email_search = "select * from signup where email = '$email'";
		$email_result = mysqli_query($conn, $email_search);

		$email_count = mysqli_num_rows($email_result);

		if ($email_count) {
			// fetch the password for validation 
			$email_pass = mysqli_fetch_assoc($email_result);

			// get registered  password which stored in database
			$db_pass = $email_pass['password'];

			// fetch corresponding username of email by session
			$_SESSION['username'] = $email_pass['username'];

			// for verifying the both password - registered password in database and login time password are same or not  
			$pass_decode = password_verify($password, $db_pass);

			if ($pass_decode) {
				$insert = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
				$result = mysqli_query($conn, $insert);
				if ($result) {

					echo "<script>alert('Login successfully!')</script>";
					echo "<script>location.replace('welcome.php');</script>";
				}

				// header('location:signup.php');
			} else {
				echo "<script>alert('Incorrect password')</script>";
			}
		} else {
			echo "<script>alert('Invalid email')</script>";
		}
	}
	?>



	<div class="main">
		<div class="login">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<label for="chk" aria-hidden="true">Login</label>
				<input type="email" name="email" placeholder="Email" required="">
				<input type="password" name="password" placeholder="Password" required="">
				<button type="submit" name="login" value="loginBtn">Login</button>
				<p>Don't have an account? <a href="signup.php">Signup</a></p>

			</form>

		</div>
	</div>
</body>

</html>