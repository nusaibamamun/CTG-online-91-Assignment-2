<?php 
include	'Database.php';
$db = new Database();

//save data to database
if(isset($_POST['submit'])){
	$language = $_POST['language'];
	$book_name = $_POST['book_name'];
	$author = $_POST['author'];
	$summary = $_POST['summary'];
	$rating = $_POST['rating'];
	$category = $_POST['category'];
	$buy_date = $_POST['buy_date'];
	$db->saveList($language,$book_name,$author,$summary,$rating,$category,$buy_date);
	header('location:dashboard.php');


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<style>
		label {
        display: block;
        width: 300px;
      }
	</style>
</head>
<body>
	<h1>Welcome to your dashboard!</h1>
	<form action="" method="POST">
		<label for="language">Language of the book:</label><br>
		<input type="text" name="language" required><br><br>
		<label for="book_name">Name of the book:</label><br>
		<input type="text" name="book_name" required><br><br>
		<label for="author">Name of the author:</label><br>
		<input type="text" name="author" required><br><br>
		<label for="summary">Summary of the book:</label><br>
		<textarea name="summary" cols="50" rows="10"></textarea><br><br>
		<label for="rating">Rate the book:</label><br>
		<input type="number" step="0.01" min="0" max="10" name="rating" required><br><br>
		<label for="category">Category of the book:</label><br>
		<input type="text" name="category" required><br><br>
		<label for="buy_date">Buying or borrowing date:</label><br>
		<input type="date" name="buy_date" required><br><br>
		<input type="submit" name="submit" value="Add book to my list">
	</form>
</body>
</html>