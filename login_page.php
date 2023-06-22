<!DOCTYPE html>
<html>

<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="styles.css"> <!-- Include external CSS file -->
</head>

<body>
	<div id="center">
		<video height="240" loop autoplay muted>
			<source src="assets/gif.mp4" type="video/mp4"> <!-- Display a video/gif -->
		</video>
		<form action="login.php" method="post" id="login_form"> <!-- Form for user login, submits data to login.php -->
			<h2>LOGIN</h2>
			<?php if (isset($_GET['error'])) { ?> <!-- Check if an error message is set in the URL -->
				<p class="error">
					<?php echo $_GET['error']; ?>
				</p> <!-- Display error message if present -->
			<?php } ?>
			<label>Email</label>
			<input type="text" class="form_input_name" name="email" placeholder="Email"><br>
			<!-- Input field for email -->

			<label>Password</label>
			<input type="password" class="form_input_name" name="password" placeholder="Password"><br>
			<!-- Input field for password -->

			<button type="submit" id="loginButton">Login</button> <!-- Login button to submit the form -->
		</form>
	</div>
</body>

</html>