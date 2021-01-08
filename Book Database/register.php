<?php
include 'Database.php';
$db = new Database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>

    <?php
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $db->saveUser($email,$username,$password);
            echo 'Registered!';
        }
    ?>
    <form action="" method="POST">
    <label for="email">Write your email address:</label>
    <input type="email" name="email"><br><br>
    <label for="username">Write your username:</label>
    <input type="text" name="username"><br><br>
    <label for="password">Write your password:</label>
    <input type="password" name="password"><br><br>
    <input type="submit" name="submit" value="Register">
    
    </form>
</body>
</html>