<?php
include 'Database.php';
$db = new Database();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
</head>
<body>
	<?php
	//check if id is set
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$data = $db->fetchUserTask($id);
			
		}

		//update data
		if(isset($_POST['submit'])){
			$id = $_POST['id'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$db->updateTask($id,$title,$description);
			header('location:dashboard.php?msg=1');
		}
	?>
	<h2>Update your data</h2>
	<form action="" method="POST">
		<?php
			foreach ($data as $data):
		?>
		<input type="hidden" name="id" value="<?= $data['id'];?>">
        <label for="title">Write your title here:</label><br>
        <input type="text" name="title" placeholder="Your Name" value="<?= $data['title'];?>"><br><br>
        <label for="description" >Write your description here:</label><br>
        <textarea name="description"  cols="60" rows="10" placeholder="Description of task"><?= $data['description'];?></textarea><br><br>
        <input type="submit" name="submit" value="Update task">
    <?php endforeach;    ?>
    </form>

</body>
</html>