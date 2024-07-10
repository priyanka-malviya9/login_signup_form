<?php
require('conn.php');
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Signup Form</title>
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
			height: 560px;
			overflow: hidden;
			border-radius: 10px;
			box-shadow: 5px 20px 50px #000;
			background: linear-gradient(0deg, rgba(59, 93, 80, 1) 352%, rgba(13, 13, 12, 1) 100%);

		}

		label {
			color: #fff;
			font-size: 2.3em;
			justify-content: center;
			display: flex;
			margin: 20px;
			font-weight: bold;
			cursor: pointer;
			/* transition: .5s ease-in-out; */
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
			margin: 10px auto;
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
			margin-top: 20px;
		}

		.main p a {
			color: #fff;
		}
	</style>
</head>

<body>

	<?php


	if (isset($_POST['signup'])) {
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$city = mysqli_real_escape_string($conn, $_POST['city']);
		$mob = mysqli_real_escape_string($conn, $_POST['mob']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

		// for make encrypted password 
		$pass = password_hash($password, PASSWORD_BCRYPT);
		$cpass = password_hash($cpassword, PASSWORD_BCRYPT);


		// check existing email  
		$email_query = "SELECT * FROM signup WHERE email = '$email'";
		$email_result = mysqli_query($conn, $email_query);
		$email_count = mysqli_num_rows($email_result);

		if ($email_count > 0) {
			echo "<script>alert('Email already exits')</script>";
		}
		else {
			if ($password === $cpassword) 
			{
				$insert_query = "INSERT INTO signup (username, email, city, mobile, password, cpassword) 
	           VALUES ('$username','$email','$city','$mob', '$pass','$cpass')";

				$insert_result = mysqli_query($conn, $insert_query);
				if($insert_query) 
				{
					echo "<script>alert('Inserted successfully')</script>";
					echo "<script>location.replace('index.php');</script>";
				} 
			else 
			{
				echo "<script>alert('Not inserted')</script>";
			}
			}
				else {
				   echo "<script>alert('Password are not matching')</script>";
			   }
	
	    }
    }
	?>


	<div class="main">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
			<label for="chk" aria-hidden="true">Create Account</label>
			<input type="text" name="username" placeholder="Username" required="">
			<input type="email" name="email" placeholder="Email" required="">
			<input type="text" name="city" placeholder="City" required="">
			<input type="text" name="mob" placeholder="Mobile" required="" maxlength="10" minlength="10">
			<input type="password" name="password" placeholder="Password" required="">
			<input type="password" name="cpassword" placeholder="Confirm Password" required="">
			<button type="submit" name="signup">Signup</button>
			<p>Already have an account? <a href="index.php">Login</a></p>
		</form>
	</div>
</body>

</html>