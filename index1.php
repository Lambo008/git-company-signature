<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="login">
			<h1>Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>
<?php
	//if login has failed, show alert.
	if (isset($_GET["msg"]) && $_GET["msg"] == 'incorrect_psw') {
		echo "<script type='text/javascript'>alert('Incorrect password!');</script>";
	}else if(isset($_GET["msg"]) && $_GET["msg"] == 'incorrect_user'){
		echo "<script type='text/javascript'>alert('Incorrect user!');</script>";
	}
?>