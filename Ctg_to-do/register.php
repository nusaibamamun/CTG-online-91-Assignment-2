<?php
include 'Database.php';
$db = new Database();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
	<?php
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$usernameCount = $db->checkUsername($username);
		$password = $_POST['password'];
		
		if(strlen($password) > 5){
			if(count($usernameCount)==0){
				$db->userSave($username,$password);
				echo 'Registered!';
			}else{
				echo 'Username is already taken!';
			}
			
		}else{
			echo 'Password must be more than 5 words';
		}
		
	}

	?>
	<form action="" method="POST">
	<label for="username">Your Username</label>
	<input type="text" name="username"><br><br>
	<label for="password">Your Password</label>
	<input type="password" name="password"><br><br>
	<input type="submit" name="submit" value="Register">
	</form>
</body>
</html>