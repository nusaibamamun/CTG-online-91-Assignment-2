<?php
include 'Database.php';
$db = new Database();

//user login
if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = $db->login($username,$password);
	if(count($result) == 1){
		session_start();
		foreach ($result as $data) {
			$_SESSION['username'] = $data['username'];
			$_SESSION['id'] = $data['id'];
			header('location: dashboard.php');
		}
	}else{
		echo "Username or Password doesn't matched.";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
	<h2>Login form</h2>
	<form action="" method="POST">
		<label>Ussername</label>
		<input type="text" name="username"><br><br>
		<label>Password</label>
		<input type="password" name="password"><br><br>
		<input type="submit" name="submit" value="Login">		
	</form>
    
    <a href="register.php">Registration</a>
</body>
</html>