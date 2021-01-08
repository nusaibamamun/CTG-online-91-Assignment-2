<?php
include 'Database.php';
$db = new Database();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>

<body>

    <?php
        //check if id is set
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = $db->fetchUserList($id);   
    }

    
    	//update data
		if(isset($_POST['submit'])){
			$id = $_POST['id'];
			$language = $_POST['language'];
            $book_name = $_POST['book_name'];
            $author = $_POST['author'];
            $summary = $_POST['summary'];
            $rating = $_POST['rating'];
            $category = $_POST['category'];
            $buy_date = $_POST['buy_date'];
			$db->updateList($id, $language, $book_name, $author, $summary, $rating, $category, $buy_date);
			header('location:dashboard.php?msg=1');
		}
    ?>
    <h2>Update your task</h2>
    <form action="" method="POST">
        <?php
			foreach ($data as $data):
        ?>
            <input type="hidden" name="id" value="<?= $data['id'];?>">
            <label for="language">Language of the book:</label><br>
            <input type="text" name="language" value="<?= $data['language'];  ?>" required><br><br>
            <label for="book_name">Name of the book:</label><br>
            <input type="text" name="book_name" value="<?= $data['book_name'];  ?>" required><br><br>
            <label for="author">Name of the author:</label><br>
            <input type="text" name="author" value="<?= $data['author'];  ?>" required><br><br>
            <label for="summary">Summary of the book:</label><br>
            <textarea name="summary" cols="50" rows="10"><?= $data['summary'];  ?></textarea><br><br>
            <label for="rating">Rate the book:</label><br>
            <input type="number" step="0.01" min="0" max="10" name="rating" value="<?= $data['rating'];  ?>" required><br><br>
            <label for="category">Category of the book:</label><br>
            <input type="text" name="category" value="<?= $data['category'];  ?>" required><br><br>
            <label for="buy_date">Buying or borrowing date:</label><br>
            <input type="date" name="buy_date" value="<?= $data['buy_date'];  ?>" required><br><br>
            <input type="submit" name="submit" value="Update my list">
        <?php endforeach;    ?>
    </form>
</body>

</html>