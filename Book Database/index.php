<?php
include 'Database.php';
$db = new Database();

//user login
if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = $db->login($email,$username,$password);
	if(count($result) == 1){
		session_start();
		foreach ($result as $data) {
			$_SESSION['username'] = $data['username'];
			$_SESSION['id'] = $data['id'];
			header('location: action.php');
		}
	}else{
		echo "Username or Password doesn't matched.";
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Book Database</title>
</head>
<body>
	<form action="" method="POST">
		<label for="email">Email:</label>
		<input type="email" name="email" required><br>
		<label for="username">Username:</label>
		<input type="text" name="username" required><br>
		<label for="password">Password:</label>
		<input type="password" name="password" required><br>
		<input type="submit" name="submit" value="Login">
	</form>
	
	<a href="register.php">Register</a><br><br>
</body>
</html>